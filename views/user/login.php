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
            Please login with your Username and Password.
        </div>
        <?= Html::beginForm(['html_options' => ['class' => 'form-horizontal']]) ?>
            <fieldset>
                <div class="<?= $model->hasError('username') ? ' has-error' : '' ?>">
                        <?php if ($model->hasError('username')): ?>
                        <label class="control-label"><?= $model->getError('username') ?></label>
                        <?php endif; ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <?= Html::textInput($model, 'username', ['html_options' => ['placeholder' => 'Username', 'class' => 'form-control']]) ?>
                    </div>
                </div>
                <div class="clearfix"></div><br>

                <div class="<?= $model->hasError('password') ? ' has-error' : '' ?>">
                    <?php if ($model->hasError('password')): ?>
                    <label class="control-label"><?= $model->getError('password') ?></label>
                    <?php endif; ?>
                    <div class="input-group input-group-lg<?= $model->hasError('password') ? ' has-error' : '' ?>">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <?= Html::passwordInput($model, 'password', ['html_options' => ['placeholder' => 'Password', 'class' => 'form-control']]) ?>
                    </div>
                </div>
                <div class="clearfix"></div>

                <?php /*
                <div class="input-prepend">
                    <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                </div>
                <div class="clearfix"></div>
                */ ?>

                <p class=" col-md-5">
                    <button type="submit" class="btn btn-primary">Login</button>
                </p>
                <p class=" col-md-5">
                    <a class="btn btn-primary" href="<?= Html::createLink('user', 'register'); ?>">Register</a>
                </p>

            </fieldset>
        <?= Html::endForm(); ?>
    </div>
    <!--/span-->
</div><!--/row-->