<?php
use lib\helpers\html\Html;
?>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-wrench"></i> Password Change</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
            <?php if (isset($success)): ?>
            <div class="alert alert-info">
                Password has beed changed successfully.
            </div> 
            <?php endif; ?>
            <?= Html::beginForm(['html_options' => ['class' => 'form-horizontal']]) ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="<?= $model->hasError('password') ? ' has-error' : '' ?>">
                            <?php if ($model->hasError('password')): ?>
                            <label class="control-label"><?= $model->getError('password') ?></label>
                            <?php endif; ?>
                            <div class="input-group input-group-lg<?= $model->hasError('password') ? ' has-error' : '' ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <?= Html::passwordInput($model, 'password', ['html_options' => ['placeholder' => 'Password', 'class' => 'form-control']]) ?>
                            </div>
                        </div>
                        <div class="clearfix"></div><br>

                        <div class="<?= $model->hasError('new_password') ? ' has-error' : '' ?>">
                            <?php if ($model->hasError('new_password')): ?>
                            <label class="control-label"><?= $model->getError('new_password') ?></label>
                            <?php endif; ?>
                            <div class="input-group input-group-lg<?= $model->hasError('new_password') ? ' has-error' : '' ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <?= Html::passwordInput($model, 'new_password', ['html_options' => ['placeholder' => 'New Password', 'class' => 'form-control']]) ?>
                            </div>
                        </div>
                        <div class="clearfix"></div><br>

                        <div class="<?= $model->hasError('password_repeat') ? ' has-error' : '' ?>">
                            <?php if ($model->hasError('password_repeat')): ?>
                            <label class="control-label"><?= $model->getError('password_repeat') ?></label>
                            <?php endif; ?>
                            <div class="input-group input-group-lg<?= $model->hasError('password_repeat') ? ' has-error' : '' ?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <?= Html::passwordInput($model, 'password_repeat', ['html_options' => ['placeholder' => 'Repeat New Password ', 'class' => 'form-control']]) ?>
                            </div>
                        </div>
                        <div class="clearfix"></div><br>
                        
                        <button type="submit" class="btn btn-primary right">Change Password</button>
                        
                    </div>
                </div>
            <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>

