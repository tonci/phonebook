<?php
    use lib\helpers\html\Html;
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-plus"></i> Add Contact</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
            <?= Html::beginForm() ?>
                <div class="form-group col-md-3 <?= $model->hasError('full_name') ? ' has-error' : '' ?>">
                    <?= Html::textInput($model, 'full_name', ['html_options' => ['placeholder' => 'Full name', 'class' => 'form-control']]) ?><br />
                    <?php if ($model->hasError('full_name')): ?>
                    <label class="control-label"><?= $model->getError('full_name') ?></label>
                    <?php endif; ?>
                </div>

                <div class="form-group col-md-3 <?= $model->hasError('email') ? ' has-error' : '' ?>">
                    <?= Html::textInput($model, 'email', ['html_options' => ['placeholder' => 'Email', 'class' => 'form-control']]) ?><br />
                    <?php if ($model->hasError('email')): ?>
                    <label class="control-label"><?= $model->getError('email') ?></label>
                    <?php endif; ?>
                </div>

                <div class="form-group col-md-3 <?= $model->hasError('phone') ? ' has-error' : '' ?>">
                    <?= Html::textInput($model, 'phone', ['html_options' => ['placeholder' => 'Phone', 'class' => 'form-control']]) ?><br />
                    <?php if ($model->hasError('phone')): ?>
                    <label class="control-label"><?= $model->getError('phone') ?></label>
                    <?php endif; ?>
                </div>

                <button class="btn btn-success" type="submit">Submit</button>
                
                <div class="clearfix"></div>
            <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Contacts</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>

            </div>
            
            
            <?= $grid; ?>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->