<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'FAQ';
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
                <a href="/faq/add" class="btn btn-link btn-float has-text"><i
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
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                    ],
                    [
                        'attribute' => 'question',
                        'content' => function($data){
                            return mb_substr(strip_tags($data->question), 0, 350);
                        }
                    ],
                    [
                        'attribute' => 'answer',
                        'content' => function($data){
                            return mb_substr(strip_tags($data->answer), 0, 350);
                        }
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 100px; text-align: center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete} {update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => 'Редактировать',
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-trash"></span>',
                                    '/faq/delete?id=' . $model->id, [
                                    'title' => 'delete',
                                    'data' => [
                                        'confirm' => 'Удалить?',
                                    ]
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = '/faq/update?id=' . $model->id;
                                return $url;
                            }
                        }
                    ],
                ],
            ]); ?>
            <!-- /main content -->
        </div>
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->