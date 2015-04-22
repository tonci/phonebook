<?php
    use lib\helpers\html\Html;
?>
<div class="box-content">
<?= Html::beginForm(['html_options' => ['class' => 'form-horizontal']]) ?>
    <table class="table table-bordered table-striped table-condensed" data-model="<?= $model_name; ?>" data-updateurl="<?= $update_url; ?>">
        <thead>
        <tr>
            <?= $head; ?>
        </tr>
        </thead>
        <tbody>
            <?= $body; ?>
        </tbody>
    </table>
    <?= $pagination; ?>
<?= Html::endForm(); ?>
</div>

<?php /*
<div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($contacts as $key => $contact): ?>
                        
                    <tr>
                        <td><?= $contact->full_name; ?></td>
                        <td class="center"><?= $contact->email; ?></td>
                        <td class="center"><?= $contact->phone; ?></td>
                        <td class="center">
                            <a class="btn btn-success" href="#">
                                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                View
                            </a>
                            <a class="btn btn-info" href="#">
                                <i class="glyphicon glyphicon-edit icon-white"></i>
                                Edit
                            </a>
                            <a class="btn btn-danger" href="#">
                                <i class="glyphicon glyphicon-trash icon-white"></i>
                                Delete
                            </a>
                        </td>
                    </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            */ ?>