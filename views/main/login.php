<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="login-container">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">Вход в аккаунт
                <small class="display-block">Введите имя пользователя и пароль</small>
            </h5>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <?= $form->field($model, 'username', [
                'options' => [
                    'tag' => null,
                ],
            ])->textInput([
                'autofocus' => true,
                'placeholder' => $model->getAttributeLabel('username'),
            ])->label(false) ?>
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <?= $form->field($model, 'password', [
                'options' => [
                    'tag' => null,
                ],
            ])->passwordInput([
                'placeholder' => $model->getAttributeLabel('password'),
            ])->label(false) ?>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Войти <i
                        class="icon-circle-right2 position-right"></i></button>
        </div>

        <div class="text-center">
            <?= Html::a('Регистрация', ['signup']) ?>
        </div>
        <div class="text-center">
            <?= Html::a('Восстановить пароль', ['request-password-reset']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?= Html::a('Регистрация', ['signup']) ?>.
                </div>

                <div style="color:#999;margin:1em 0">
                    <?= Html::a('Восстановить пароль', ['request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div-->
