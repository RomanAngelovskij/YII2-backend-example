<?php

/* @var $model \app\models\Worksheetsample */

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->isNewRecord ? 'Добавление страны' : 'Редактирование страны: ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <a href="/countries"><i class="<?= !isset($this->params['titleIcon']) ? 'icon-arrow-left52' : $this->params['titleIcon'] ?> position-left"></i></a>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>

        <div class="heading-elements">

            <div class="heading-btn-group">
                <a href="/countries/add" class="btn btn-link btn-float has-text"><i
                            class="icon-add text-primary"></i><span>Добавить</span></a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-flat">
                <div class="panel-body">

                    <!-- Main content -->
                    <?php if ($model->hasErrors()): ?>
                        <div class="alert alert-danger alert-styled-left alert-arrow-left alert-component">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                        class="sr-only">Close</span>
                            </button>
                            <h6 class="alert-heading text-semibold">Ошибки:</h6>
                            <?php
                            $errors = $model->getErrors();
                            foreach ($errors as $error):
                                ?>
                                <li> <?= $error[0] ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>


                    <?php $form = ActiveForm::begin([
                        'id' => 'countries-form',
                        'enableClientValidation' => false,
                    ]); ?>

                    <div class="col-md-16">
                        <?= $form->field($model, 'id')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'autofocus' => true,
                                'placeholder' => $model->getAttributeLabel('id'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-16">
                        <?= $form->field($model, 'name')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'autofocus' => true,
                                'placeholder' => $model->getAttributeLabel('name'),
                            ]);
                        ?>
                    </div>

                    <?= Html::submitButton('<b><i class="icon-checkmark"></i></b>Сохранить', ['class' => 'btn btn-success btn-labeled', 'name' => 'save-button']) ?>

                    <?php ActiveForm::end(); ?>
                    <!-- /main content -->

                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->