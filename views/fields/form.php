<?php

/* @var $model \app\models\Documents */

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->isNewRecord ? 'Добавление поля в документ' : 'Редактирование поля в документе "' . $model->document->name . '"';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>

        <div class="heading-elements">

            <div class="heading-btn-group">
                <a href="/documents/add" class="btn btn-link btn-float has-text"><i
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

                    <?php if ($model->isNewRecord): ?>
                        <div class="panel panel-flat border-top-info border-bottom-info">
                            <div class="panel-heading">
                                <h6 class="panel-title">Копировать из</h6>
                            </div>

                            <div class="panel-body">
                                <div style="display: inline-block; width: 97%; float: left; margin-right: 5px;">
                                    <?= Html::dropDownList('copy-from', null,
                                        \app\models\DocumentsFields::getListForDropdown(),
                                        ['class' => 'form-control']) ?>
                                </div>
                                <div style="display: inline-block;">
                                    <button class="btn btn-info copy-template"><em class="icon-copy3"></em></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $form = ActiveForm::begin([
                        'id' => 'document-field-form',
                        'enableClientValidation' => false,
                    ]); ?>

                    <div class="col-md-12">
                        <?= $form->field($model, 'doc_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map(\app\models\Documents::find()->all(), 'id', 'name'),
                            [
                                'class' => 'form-field form-control',
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'label')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'autofocus' => true,
                                'placeholder' => $model->getAttributeLabel('label'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'symb_id')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('symb_id'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'type')->dropDownList(
                            ['text' => 'text', 'date' => 'date', 'email' => 'email', 'num' => 'num', 'tel' => 'tel', 'url' => 'url'],
                            [
                                'class' => 'form-field form-control',
                            ]);
                        ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'min')->textInput(
                            [
                                'type' => 'number',
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('min'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'max')->textInput(
                            [
                                'type' => 'number',
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('max'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'maxlength')->textInput(
                            [
                                'type' => 'number',
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('maxlength'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'input_mask')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('input_mask'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'regexp_rule')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('regexp_rule'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textarea(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('description'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'sample')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('sample'),
                            ]);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'placeholder')->textInput(
                            [
                                'class' => 'form-field form-control',
                                'placeholder' => $model->getAttributeLabel('placeholder'),
                            ]);
                        ?>
                    </div>


                    <?= Html::submitButton('<b><i class="icon-checkmark"></i></b>Сохранить', ['class' => 'btn btn-success btn-labeled', 'name' => 'save-button']) ?>

                    <?php ActiveForm::end(); ?>
                    <div class="clearfix"></div>
                    <!-- /main content -->
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<?= $this->registerJs('
    $(".copy-template").on("click", function(){
        var templateId = $("[name=copy-from]").val();
        $.ajax({
            url: "/fields/copy",
            type: "get",
            dataType: "json",
            cache: false,
            data: {fieldId: templateId},
            success: function(response){
                $.each(response, function(indx, value){
                    var field = $("[name=\'DocumentsFields\[" + indx + "\]\']");
                    if($(field).length > 0 && indx != "doc_id"){
                        $(field).val(value);
                    }
                })
            }
        })
    })
', \yii\web\View::POS_READY) ?>