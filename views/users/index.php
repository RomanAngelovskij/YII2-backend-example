<?php

/* @var $this yii\web\View */

/* @var $dataProvider \yii\data\ActiveDataProvider */

/* @var $searchModel \app\models\search\UserSearch */

use yii\helpers\Html;

$this->title = 'Пользователи';
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
                <a href="/users" class="btn btn-link btn-float has-text"><i
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

            <!-- Table -->
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
                        'attribute' => 'created_at',
                        'headerOptions' => ['style' => 'width: 210px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return date('d.m.Y', $data->created_at);
                        },
                        'filter' => '<input type="text" class="form-control daterange-user-reg"
                                   value="' . Yii::$app->request->get('startDate', date('01.01.Y')) . ' - ' . Yii::$app->request->get('finishDate', date('d.m.Y', strtotime('tomorrow'))) . '">'
                            . Html::hiddenInput('UserSearch[startRegDate]', $searchModel->startRegDate, ['id' => 'userStartRegDate'])
                            . Html::hiddenInput('UserSearch[endRegDate]', $searchModel->endRegDate, ['id' => 'userEndRegDate'])
                    ],
                    [
                        'attribute' => 'fio',
                        'content' => function ($data) {
                            if (!empty($data->profile)) {
                                $content = '<div class="text-semibold">' . $data->profile->last_name . ' ' . $data->profile->first_name . ' ' . $data->profile->second_name . '</div>';
                            } else {
                                $content = '<div class="text-semibold">' . $data->username . '</div>';
                            }

                            if ($data->email) {
                                $content .= '<div><em class="fa fa-envelope"></em> <a href="mailto:' . $data->email . '">' . $data->email . '</a></div>';
                            }

                            if ($data->phone) {
                                $content .= '<div><em class="fa fa-phone"></em> +' . $data->phone . '</div>';
                            }

                            if ($data->go_id) {
                                $content .= '<div><em class="fa fa-google"></em> ' . $data->go_id . '</div>';
                            }

                            if ($data->fb_id) {
                                $content .= '<div><em class="fa fa-facebook"></em> <a href="https://facebook.com/' . $data->fb_id . '" target="_blank">' . $data->fb_id . '</a></div>';
                            }

                            if ($data->vk_id) {
                                $content .= '<div><em class="fa fa-vk"></em> <a href="https://vk.com/id' . $data->vk_id . '" target="_blank">' . $data->vk_id . '</a></div>';
                            }

                            if ($data->od_id) {
                                $content .= '<div><em class="fa fa-odnoklassniki"></em> <a href="https://ok.ru/profile/' . $data->od_id . '" target="_blank">' . $data->od_id . '</a></div>';
                            }


                            return $content;
                        }
                    ],
                    [
                        'attribute' => 'register_source',
                        'headerOptions' => ['style' => 'width: 180px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'filter' => ['Telegram' => 'Telegram', 'Android' => 'Android']
                    ],
                    [
                        'attribute' => 'country',
                        'headerOptions' => ['style' => 'width: 180px;'],
                        'contentOptions' => ['style' => 'text-align: right'],
                        'content' => function ($data) {
                            return (empty($data->profile) || empty($data->profile->country)) ? '-' : $data->profile->countryData->name;
                        },
                        'filter' => \yii\helpers\ArrayHelper::map(\app\models\Countries::find()->all(), 'id', 'name'),
                    ],
                    [
                        'attribute' => 'age',
                        'headerOptions' => ['style' => 'width: 120px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content' => function ($data) {
                            return $data->age;
                        },
                        'filter' => $searchModel->ageRange()
                    ],
                    [
                        'attribute' => 'gender',
                        'headerOptions' => ['style' => 'width: 120px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                        'content' => function ($data) {
                            if (empty($data->profile) || empty($data->profile->gender)) {
                                return '';
                            }
                            return $data->profile->gender == 'm' ? 'Муж.' : 'Жен.';
                        },
                        'filter' => ['m' => 'Муж.', 'f' => 'Жен.']
                    ],
                    [
                        'attribute' => 'worksheetsCount',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['style' => 'text-align: center'],
                    ],
                    [
                        'headerOptions' => ['style' => 'width: 50px;'],
                        'contentOptions' => ['style' => 'text-align: center;'],
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return Html::a('<span class="icon-user"></span>', $url, [
                                    'title' => 'Редактировать профиль',
                                    'target' => '_blank',
                                ]);
                            },
                        ],
                        'urlCreator' => function ($action, $model, $key, $index) {
                            if ($action === 'update') {
                                $url = '/users/view?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'worksheets') {
                                $url = '/worksheets/user/?id=' . $model->id;
                                return $url;
                            }
                            if ($action === 'documents') {
                                $url = '/documents/user/?id=' . $model->id;
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