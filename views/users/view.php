<?php

/* @var $this yii\web\View */

/* @var $profile \app\models\UserData */

use yii\helpers\Html;

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <a href="/users"><i class="<?= !isset($this->params['titleIcon']) ? 'icon-arrow-left52' : $this->params['titleIcon'] ?> position-left"></i></a>
                <span class="text-semibold"><?= $this->title ?></span>
            </h4>
        </div>

        <div class="heading-elements">

        </div>
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default sidebar-separate">
            <div class="sidebar-content">

                <!-- User details -->
                <div class="content-group">
                    <div class="panel-body bg-indigo-400 border-radius-top text-center"
                         style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                        <div class="content-group-sm">
                            <h6 class="text-semibold no-margin-bottom">
                                <?= !empty($user->profile)
                                    ? $user->profile->last_name . ' ' . $user->profile->first_name . ' ' . $user->profile->second_name
                                    : $user->username;
                                ?>
                            </h6>

                            <span class="display-block"><?= $user->register_source ?></span>
                        </div>

                        <a href="#" class="display-inline-block content-group-sm">
                            <img src="/images/placeholder.jpg" class="img-circle img-responsive" alt=""
                                 style="width: 110px; height: 110px;">
                        </a>

                        <div class="caption text-center">
                            <ul class="icons-list mt-15">
                                <?php
                                $socials = [];

                                if ($user->email) {
                                    $socials[] = '<li><a href="mailto:' . $user->email . '" data-popup="tooltip" title="" data-original-title="E-mail" target="_blank"><i class="fa fa-envelope"></i></a></li>';
                                }

                                if ($user->go_id) {
                                    $socials[] = '<li><a href="#" data-popup="tooltip" title="" data-original-title="Google"><i class="fa fa-google" target="_blank"></i></a></li>';
                                }

                                if ($user->fb_id) {
                                    $socials[] = '<li><a href="https://facebook.com/' . $user->fb_id . '" data-popup="tooltip" title="" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                                }

                                if ($user->vk_id) {
                                    $socials[] = '<li><a href="https://vk.com/id' . $user->vk_id . '" data-popup="tooltip" title="" data-original-title="ВКонтакте" target="_blank"><i class="fa fa-vk"></i></a></li>';
                                }

                                if ($user->od_id) {
                                    $socials[] = '<li><a href="https://ok.ru/profile/' . $user->od_id . '" data-popup="tooltip" title="" data-original-title="Одноклассники" target="_blank"><i class="fa fa-odnoklassniki"></i></a></li>';
                                }

                                echo implode(' ', $socials);
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="panel no-border-top no-border-radius-top">
                        <ul class="navigation">
                            <li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i>
                                    Профиль</a></li>
                            <li><a href="#worksheets" data-toggle="tab"><i class="icon-file-empty2"></i> Заявки</a></li>
                            <li><a href="#tech-data" data-toggle="tab"><i class="icon-gear"></i> Тех. данные</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /user details -->

            </div>
        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Tab content -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="profile">
                    <!-- Profile info -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Профиль</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?php $form = \yii\bootstrap\ActiveForm::begin([
                                'id' => 'user-profile-form',
                                'enableClientValidation' => false,
                            ]); ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'last_name')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                                'placeholder' => $profile->getAttributeLabel('last_name'),
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'first_name')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                                'placeholder' => $profile->getAttributeLabel('first_name'),
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'second_name')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                                'placeholder' => $profile->getAttributeLabel('second_name'),
                                            ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'birthday')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                                'placeholder' => $profile->getAttributeLabel('birthday'),
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'country')->dropDownList(
                                            \yii\helpers\ArrayHelper::map(\app\models\Countries::find()->all(), 'id', 'name'),
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?= $form->field($profile, 'gender')->dropDownList(
                                            ['m' => 'Мужской', 'f' => 'Женский']);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <hr>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($user, 'phone')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($user, 'email')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <?= $form->field($user, 'fb_id')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($user, 'vk_id')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($user, 'go_id')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                    <div class="col-md-3">
                                        <?= $form->field($user, 'od_id')->textInput(
                                            [
                                                'class' => 'form-field form-control',
                                            ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <?= Html::submitButton('<i class="icon-checkmark"></i> Сохранить', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                            </div>
                            <?php \yii\bootstrap\ActiveForm::end(); ?>
                        </div>
                    </div>
                    <!-- /profile info -->
                </div>

                <div class="tab-pane fade" id="worksheets">

                    <!-- Worksheets -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Заявки</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="chart-container">
                                <?= \yii\grid\GridView::widget([
                                    'dataProvider' => $worksheetsDataProvider,
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
                                            }
                                        ],
                                        [
                                            'attribute' => 'country',
                                            'headerOptions' => ['style' => 'width: 150px;'],
                                            'contentOptions' => ['style' => 'text-align: right'],
                                            'content' => function($data){
                                                return date('d.m.Y', $data->created_at);
                                            }
                                        ],
                                        [
                                            'attribute' => 'country',
                                            'headerOptions' => ['style' => 'width: 200px;'],
                                            'contentOptions' => ['style' => 'text-align: right'],
                                            'content' => function($data){
                                                return $data->user->profile->countryData->name;
                                            }
                                        ],
                                        [
                                            'attribute' => 'user',
                                            'headerOptions' => ['style' => ''],
                                            'contentOptions' => ['style' => 'text-align: left'],
                                            'content' => function ($data) {
                                                return Html::a(
                                                    $data->user->profile->last_name . ' ' . $data->user->profile->first_name . ' ' . $data->user->profile->second_name,
                                                    '/users/view?id=' . $data->user_id
                                                );
                                            }
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
                                                        'title' => 'Детали',
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
                            </div>
                        </div>
                    </div>
                    <!-- /available hours -->
                </div>

                <div class="tab-pane fade" id="tech-data">

                    <!-- Tech data -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Технические данные</h6>
                            <div class="heading-elements">

                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="col-md-3">Клиент</div><div class="col-md-9"><?= $user->register_source ?></div>
                            <div class="col-md-3">Дата регистрации</div><div class="col-md-9"><?= date('d.m.Y в H:i', $user->created_at) ?></div>
                            <div class="col-md-3">Device ID:</div><div class="col-md-9"><?= !empty($user->deviceId) ? $user->deviceId : '-' ?></div>
                            <div class="col-md-3"></div><div class="col-md-9"></div>
                        </div>
                    </div>
                    <!-- /orders history -->

                </div>
            </div>
            <!-- /tab content -->

        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->

</div>
<!-- /page container -->