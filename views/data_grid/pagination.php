<ul class="pagination pagination-centered">
    <li><a href="<?= $grid->getUrl([$grid->page => $current_page-1]) ?>">Prev</a></li>
    <?php for ($i=1; $i <= $pages; $i++): ?>
        <li<?= ($current_page == $i ? ' class="active"' : '') ?>>
            <a href="<?= $grid->getUrl([$grid->page => $i]) ?>"><?= $i; ?></a>
        </li>
    <?php endfor; ?>
    <li><a href="<?= $grid->getUrl([$grid->page => $current_page+1]) ?>">Next</a></li>
</ul>