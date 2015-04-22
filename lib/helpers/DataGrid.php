<?php

namespace lib\helpers;
use lib\App;

Class DataGrid {
    // view path for needed files
    public $views_path;

    // model - to get data from
    public $model;

    // array of columns to be displayed
    public $columns = [];

    // rows per page
    public $rows_per_page = 5;

    // number of results found by the query regarding limit
    public $all_rows;

    public $criteria = [];

    private $renderer;

    private $data;

    // key used in request arr to get how many items to be shown per page
    public $limit = 'limit';

    // key used in request arr to get ("page number")
    public $page = 'page';

    public $sort = 'sort';

    public $search = 'search';

    public $update_url;

    public function __construct($params = [])
    {
        $this->loadParams($params);
        $this->getData();
        if (!empty($_POST[$this->search])) {
            App::getComponent('request')->redirect($this->getUrl([$this->page => $this->getPage()], false));
        }
        $this->renderer = App::getComponent('view');
    }

    private function loadParams($params)
    {
        $this->views_path = App::getViewPath().'/data_grid';
        foreach ($params as $id => $value) {
            $this->$id = $value;
        }
    }

    public function render()
    {
        $params['head'] = $this->getHead();
        $params['body'] = $this->getBody();
        $params['pagination'] = $this->getPagination();
        $params['update_url'] = $this->update_url;
        $params['model_name'] = $this->model->getClassName();

        return $this->renderer->render($this->views_path.'/main.php', $params);
    }

    public function getHead()
    {
        foreach ($this->columns as $name => $params) {
            $alias = $name;
            if (is_string($params)){
                $alias = $name = $params;
            }elseif(!empty($params['alias'])){
                $alias = $params['alias'];
            }
            if (!empty($params['not_sortable']) && $params['not_sortable'] == true) {
                $output[] = '<th>'.$alias.'</th>';
            }else{
                $output[] = '<th><a href="'.$this->getUrl([$this->sort => ['by' => $name, 'orientation' => $this->getOpositeSortOrientation($name)]]).'"">'.$alias.'</a></th>';
            }
        }
        return implode("\n", $output);
    }

    public function getBody()
    {
        $output = [];
        foreach ($this->getData() as $key => $data)
        {
            $output[] = '<tr>';
            foreach ($this->columns as $name => $params) {
                if (is_string($params)) $name = $params;
                if (!empty($params['content'])) {
                    if (is_string($params['content'])){
                        $output[] = '<td>'.$params['content'].'</td>';
                    }elseif(is_callable($params['content'])){

                        $output[] = call_user_func_array($params['content'], [$key, $data]);
                    }else{
                        throw new \InvalidArgumentException('content must be string or anonymous function');
                    }
                }else{
                    $output[] = '<td class="grid-editable" data-id="'.$data->id.'" data-name="'.$name.'">'.$data->$name.'</td>';
                }
            }
            $output[] = '</tr>';
        }

        return $this->getSearchableRow().implode("\n", $output);
    }

    public function getSearchableRow()
    {
        $searchables = false;
        $output[] = '<tr>';
        foreach ($this->columns as $name => $params) {
            if (!empty($params['searchable'])){
                $output[] = '<td>
                                <input tupe="text" name="'.$this->search.'['.$name.']" placeholder="Search..." value="'.@$_REQUEST[$this->search][$name].'" />
                                <button class="btn btn-sm btn-info" type="submit">Go</button>
                            </td>'; 
                $searchables = true;
            }else{
                $output[] = '<td></td>';
            }
        }
        $output[] = '</tr>';

        return ($searchables ? implode("\n", $output) : '');
    }

    public function getPagination()
    {
        $params['pages'] = $this->getAvailablePages();
        $params['current_page'] = $this->getPage();
        $params['grid'] = $this;
        return $this->renderer->render($this->views_path.'/pagination.php', $params);
    }

    public function getUrl($params = [], $escaped = true)
    {
        $search = [];
        if (!empty($_REQUEST[$this->search]))
            $search[$this->search] = array_filter($_REQUEST[$this->search], function($value){
                return !empty($value);
            });
        
        $query = array_merge($_GET, $search, $params);

        if (isset($query[$this->page]) && $query[$this->page] > $this->getAvailablePages()) $query[$this->page] = $this->getAvailablePages();
        if (isset($query[$this->page]) && $query[$this->page] < 1) $query[$this->page] = 1;

        $query = http_build_query($query);
        if ($escaped) $query = htmlspecialchars($query);

        return App::getComponent('request')->getBaseUrl().'?'.$query;
    }

    public function getData()
    {
        if (empty($this->data)) {
            if (is_string($this->criteria)) {
                $query[] = $this->criteria;
            }elseif(is_array($this->criteria)){
                foreach ($this->criteria as $key => $value) {
                    $query[] = $this->model->escapeString($key).'=:'.$this->model->escapeString($key);
                    $values[':'.$this->model->escapeString($key)] = $value;
                }
                foreach ($this->getSearch() as $key => $value) {
                    if (!empty($value)) {
                        $query[] = $this->model->escapeString($key)." LIKE '%".$this->model->escapeString($value)."%'";
                    }
                }
            }

            $this->all_rows = $this->model->countAll(implode(" AND ", $query), $values);
            $this->data = $this->model->findAll(implode(" AND ", $query), $values, $this->getSortBy().' '.$this->getSortOrientation(), $this->getLimit(), ($this->all_rows ? $this->getOffset() : 0), true);
            
        }

        return $this->data;
    }

    public function getSearch()
    {
        return (array)@$_REQUEST[$this->search];
    }

    public function getSortBy()
    {
        if (empty($_GET[$this->sort]['by']) || !isset($this->model->$_GET[$this->sort]['by'])) {
            reset($this->columns);
            return key($this->columns);
        }
        return $_GET[$this->sort]['by'];
    }

    public function getSortOrientation()
    {
        if (empty($_GET[$this->sort]['orientation']) || !in_array(strtoupper($_GET[$this->sort]['orientation']), ['ASC', 'DESC'])) {
            return 'ASC';
        }
        return strtoupper($_GET[$this->sort]['orientation']);
    }

    public function getOpositeSortOrientation($name)
    {
        if ($this->getSortBy() != $name || $this->getSortOrientation() == 'DESC')
            return 'ASC';
        return 'DESC';
    }

    public function getAvailablePages()
    {
        return ceil($this->all_rows/$this->getLimit());       
    }

    private function getLimit()
    {
        return (int)(!empty($_GET[$this->limit]) ? $_GET[$this->limit] : $this->rows_per_page);
    }

    private function getPage()
    {
        if (empty($_GET[$this->page]) || $_GET[$this->page] < 1 || !empty($_POST[$this->search])) {
            return 1;
        }elseif($_GET[$this->page] > $this->getAvailablePages()){
            return $this->getAvailablePages();
        }
        return (int)$_GET[$this->page];
    }

    private function getOffset()
    {
        return ($this->getPage()-1)*$this->getLimit();
    }
}