<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Кредитные карты';
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
                <a href="/creditcards/add" class="btn btn-link btn-float has-text"><i
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
                        'attribute' => 'logo',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'contentOptions' => ['style' => 'text-align: center;'],
                        'content' => function($data){
                            return '<img src="' . $data->logo . '" style="max-width: 140px;">';
                        }
                    ],
                    [
                        'attribute' => 'legal_name',
                        'contentOptions' => ['style' => 'text-align: left;'],
                        'content' => function($data){
                            return $data->legal_name . '<br>' . '<a href="' . $data->link . '" target="_blank">' . $data->link . '</a>';
                        }
                    ],
                    [
                        'attribute' => 'country_id',
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return $data->country->name;
                        }
                    ],
                    [
                        'attribute' => 'percent',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: right;'],
                        'content' => function($data){
                            return number_format($data->percent, 2) . '%';
                        }
                    ],
                    [
                        'attribute' => 'amount',
                        'headerOptions' => ['style' => 'width: 120px;'],
                        'contentOptions' => ['style' => 'text-align: right;'],
                        'content' => function($data){
                            return $data->amount . ' ' . $data->country->currency->symb_id;
                        }
                    ],
                    [
                        'attribute' => 'duration',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: right;'],
                        'content' => function($data){
                            return $data->duration;
                        }
                    ],
                    [
                        'attribute' => 'probability',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: right;'],
                        'content' => function($data){
                            return $data->probability . '%';
                        }
                    ],
                    [
                        'attribute' => 'rating',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: right;'],
                        'content' => function($data){
                            return $data->rating;
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
                                $url = '/creditcards/update?id=' . $model->id;
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