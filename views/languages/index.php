<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Языки';
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
                <a href="/languages/add" class="btn btn-link btn-float has-text"><i
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
        <div class="panel panel-white">

            <!-- Main content -->
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'local',
                        'headerOptions' => ['style' => 'width: 120px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                    ],
                    'name',
                    [
                        'attribute' => 'default',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content'=>function($data){
                            return $data->default ? '<em class="icon-checkmark4"></em>' : '';
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'template' => '{update}',
                    ],
                ],
            ]); ?>
            <!-- /main content -->
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->