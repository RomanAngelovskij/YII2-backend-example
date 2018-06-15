<?php

/* @var $this yii\web\View */

/* @var $worksheet \app\models\Worksheets */

use yii\helpers\Html;

$this->title = 'Завка №' . $worksheet->id;
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <a href="/worksheets"><i class="<?= !isset($this->params['titleIcon']) ? 'icon-arrow-left52' : $this->params['titleIcon'] ?> position-left"></i></a>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        <!-- Questions -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Анкета</h4>
            </div>

            <div class="panel-body">
                <?php if (empty($worksheet->questions)): ?>
                    Не заполнено
                <?php else: ?>
                    <?php foreach ($worksheet->questions as $questionValue): ?>
                        <div>
                            <span class="text-semibold"><?= $questionValue->question->label ?>:</span> <?= $questionValue->value ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Address -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Адрес</h4>
            </div>

            <div class="panel-body">
                <?php if (empty($worksheet->addressFields)): ?>
                    Не заполнено
                <?php else: ?>
                    <?php foreach ($worksheet->addressFields as $addressField): ?>
                        <div>
                            <span class="text-semibold"><?= $addressField->address->label ?>:</span> <?= $addressField->value ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Documents -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h4 class="panel-title">Документы</h4>
            </div>

            <div class="panel-body">
                <?php if (empty($documents)): ?>
                    Не заполнено
                <?php else: ?>
                    <?php foreach ($worksheet->sample->documents as $docSymbId => $document): ?>
                        <h6><?= $document->name ?></h6>
                        <?php if (!empty($documents[$docSymbId])): ?>
                            <?php foreach ($documents[$docSymbId] as $fieldLabel => $fieldValue): ?>
                                <div>
                                    <span class="text-semibold"><?= $fieldLabel ?>:</span> <?= $fieldValue ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->