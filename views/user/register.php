<?php
use lib\helpers\html\Html;
?>
<div class="row">
    <div class="col-md-12 center login-header">
        <h2>PhoneBook App</h2>
    </div>
    <!--/span-->
</div><!--/row-->

<div class="row">
    <div class="well col-md-5 center login-box">
        <div class="alert alert-info">
            Register
        </div>

        <?= Html::beginForm(['html_options' => ['class' => 'form-horizontal']]) ?>
            <fieldset>
                <div class="<?= $model->hasError('username') ? ' has-error' : '' ?>">
                    <?php if ($model->hasError('username')): ?>
                    <label class="control-label"><?= $model->getError('username') ?></label>
                    <?php endif; ?>
                    <div class="input-group input-group-lg<?= $model->hasError('username') ? ' has-error' : '' ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <?= Html::textInput($model, 'username', ['html_options' => ['placeholder' => 'Username', 'class' => 'form-control']]) ?>
                    </div>
                </div>
                <div class="clearfix"></div><br />
                
                <div class="<?= $model->hasError('password') ? ' has-error' : '' ?>">
                    <?php if ($model->hasError('password')): ?>
                    <label class="control-label"><?= $model->getError('password') ?></label>
                    <?php endif; ?>
                    <div class="input-group input-group-lg<?= $model->hasError('password') ? ' has-error' : '' ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <?= Html::passwordInput($model, 'password', ['html_options' => ['placeholder' => 'Password', 'class' => 'form-control']]) ?>
                    </div>
                </div>
                <div class="clearfix"></div><br />

                <div class="<?= $model->hasError('password_repeat') ? ' has-error' : '' ?>">
                    <?php if ($model->hasError('password_repeat')): ?>
                    <label class="control-label"><?= $model->getError('password_repeat') ?></label>
                    <?php endif; ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <?= Html::passwordInput($model, 'password_repeat', ['html_options' => ['placeholder' => 'Repeat Password', 'class' => 'form-control']]) ?>
                    </div>
                </div>
                <div class="clearfix"></div><br />

                <p class=" col-md-5">
                    <button type="submit" class="btn btn-primary">Register</button>
                </p>
                <p class=" col-md-5">
                    <a class="btn btn-primary" href="<?= Html::createLink('user', 'login'); ?>">Login</a>
                </p>
            </fieldset>
        <?= Html::endForm(); ?>
    </div>
    <!--/span-->
</div><!--/row-->