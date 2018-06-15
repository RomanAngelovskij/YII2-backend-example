<?php

/* @var $model \app\models\Mfo */

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->isNewRecord ? 'Добавление МФО' : 'Редактирование МФО: ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <a href="/mfo"><i class="<?= !isset($this->params['titleIcon']) ? 'icon-arrow-left52' : $this->params['titleIcon'] ?> position-left"></i></a>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>

        <div class="heading-elements">

            <div class="heading-btn-group">
                <a href="/mfo/add" class="btn btn-link btn-float has-text"><i
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
                        'id' => 'worksheetsample-form',
                        'enableClientValidation' => false,
                    ]); ?>

                    <div class="col-md-6">
                        <?= $form->field($model, 'name')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'autofocus' => true,
                                'placeholder' => $model->getAttributeLabel('name'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'legal_name')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('legal_name'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-2">
                        <?= $form->field($model, 'percent')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('percent'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-2">
                        <?= $form->field($model, 'amount')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('amount'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-2">
                        <?= $form->field($model, 'duration')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('duration'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'probability')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('probability'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'rating')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('rating'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'link')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('link'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($uploadModel, 'uploadedImage')->fileInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('uploadedImage'),
                            ])->label('Логотип');
                        ?>

                        <?= $form->field($model, 'logo')->hiddenInput()->label(false); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($uploadModelSmall, 'uploadedSmallImage')->fileInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('uploadedSmallImage'),
                            ])->label('Круглый логотип');
                        ?>

                        <?= $form->field($model, 'small_logo')->hiddenInput()->label(false); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'country_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map(\app\models\Countries::find()->all(), 'id', 'name'),
                            [
                                'class' => 'form-field form-control',
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textarea(
                            [
                                'class' => 'form-control html-editor'
                            ]
                        ) ?>
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

<?= $this->registerJs('
var customHtmlEditorOptions = {height: 200};
', \yii\web\View::POS_BEGIN);
?>