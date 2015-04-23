<form <?php foreach ($params['html_options'] as $option_name => $option_value) { echo $option_name.'="'.$option_value.'"'; } ?>>
<input type="hidden" name="csrf" value="<?= $csrf ?>" />