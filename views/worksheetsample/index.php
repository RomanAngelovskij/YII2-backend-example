<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Типы заявок';
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
                <a href="/worksheetsample/add" class="btn btn-link btn-float has-text"><i
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
                    'name',
                    [
                        'attribute' => 'country_id',
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return $data->country->name;
                        }
                    ],
                    [
                        'attribute' => 'questionsNumber',
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content' => function ($data) {
                            return count($data->questions);
                        }
                    ],
                    [
                        'attribute' => 'addressNumber',
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content' => function ($data) {
                            return count($data->address);
                        }
                    ],
                    [
                        'attribute' => 'documentsNumber',
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content' => function ($data) {
                            return count($data->documents);
                        }
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => 'Редактировать',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = '/worksheetsample/update?id=' . $model->id;
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