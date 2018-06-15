<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Перевод';
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
                <a href="/translate/add" class="btn btn-link btn-float has-text"><i
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
                    'id',
                    'category',
                    'message',
                    [
                        'attribute' => 'messages',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content'=>function($data){
                            foreach ($data->messages as $message){
                                return $data->message != $message->translation ? '<em class="glyphicon glyphicon-plus"></em>' : '<em class="glyphicon glyphicon-minus"></em>';
                            }
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                    ],
                ],
            ]); ?>
            <!-- /main content -->
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->