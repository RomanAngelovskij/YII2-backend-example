<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\Html;

$this->title = 'Документы';
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
                        'attribute' => 'fields',
                        'headerOptions' => ['style' => 'width: 550px;'],
                        'contentOptions' => ['style' => 'text-align: left'],
                        'content' => function ($data) {
                            $fields = [];
                            $fields[] = 'Всего: ' . Html::a(count($data->fields), '/fields/' . $data->id);
                            if (!empty($data->fields)){
                                foreach($data->fields as $field){
                                    $fields[] = '- ' . Html::a($field->label, '/fields/update?id=' . $field->id);
                                }
                            }
                            return implode('<br>', $fields);
                        }
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 60px;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => 'Редактировать запись',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = '/documents/update?id=' . $model->id;
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