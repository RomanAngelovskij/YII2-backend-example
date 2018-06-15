<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $searchModel \app\models\search\WorksheetSearch */

use yii\helpers\Html;

$this->title = 'Заявки';
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
                <a href="/worksheets" class="btn btn-link btn-float has-text"><i
                            class="icon-filter3 text-primary"></i><span>Сбросить фильтр</span></a>
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
                'filterModel' => $searchModel,
                'summary' => false,
                'columns' => [
                    [
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                    ],
                    [
                        'attribute' => 'status',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function($data){
                            return $data->status->name;
                        },
                        'filter' => \yii\helpers\ArrayHelper::map(\app\models\WorksheetsStatuses::find()->all(), 'id', 'name')
                    ],
                    [
                        'attribute' => 'updated_at',
                        'headerOptions' => ['style' => 'width: 250px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function($data){
                            return date('d.m.Y', $data->updated_at);
                        },
                        'filter' => '<input type="text" class="form-control daterange-worksheets-reg"
                                   value="' . Yii::$app->request->get('WorksheetSearch[startUpdatedAt]', date('01.01.Y')) . ' - ' . Yii::$app->request->get('WorksheetSearch[endUpdatedAt]', date('d.m.Y', strtotime('tomorrow'))) . '">'
                            . Html::hiddenInput('WorksheetSearch[startUpdatedAt]', $searchModel->startUpdatedAt, ['id' => 'worksheetStartUpdatedAt'])
                            . Html::hiddenInput('WorksheetSearch[endUpdatedAt]', $searchModel->endUpdatedAt, ['id' => 'worksheetEndUpdatedAt']),
                    ],
                    [
                        'attribute' => 'country',
                        'headerOptions' => ['style' => 'width: 200px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function($data){
                            return $data->user->profile->countryData->name;
                        },
                        'filter' => \yii\helpers\ArrayHelper::map(\app\models\Countries::find()->all(), 'id', 'name')
                    ],
                    [
                        'attribute' => 'user',
                        'headerOptions' => ['style' => ''],
                        'contentOptions' => ['style' => 'text-align: left'],
                        'content' => function ($data) {
                            return Html::a(
                                $data->user->profile->last_name . ' ' . $data->user->profile->first_name . ' ' . $data->user->profile->second_name,
                                '/users/view?id=' . $data->user_id,
                                [
                                        'target' => '_blank'
                                ]
                                );
                        },
                    ],
                    [
                        'attribute' => 'sum',
                        'headerOptions' => ['style' => 'width: 180px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return $data->min_sum . ' - ' . $data->max_sum . ' ' . $data->user->profile->countryData->currency->symb_id;
                        }
                    ],
                    [
                        'attribute' => 'days',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return $data->days;
                        }
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="icon-file-eye"></span>', $url, [
                                    'title' => 'Заявка',
                                    'target' => '_blank',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'view') {
                                $url = '/worksheets/view?id=' . $model->id;
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