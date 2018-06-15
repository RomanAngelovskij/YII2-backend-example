<?php

/* @var $this yii\web\View */

$this->title = 'Главная';
\app\assets\ChartsAssets::register($this);
?>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
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

        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Users stat -->
            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Регистрации за 30 дней</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-users4 position-left text-slate"></i> <?=$totalUsers?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-user position-left text-slate"></i> <?= number_format($totalUsers/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                            <div id="users-month-stat"></div>
                    </div>
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>

            <!-- Users Telegram stat -->
            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Регистрации за 30 дней в Telegram</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-users4 position-left text-slate"></i> <?=$totalUsersTelegram?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-user position-left text-slate"></i> <?= number_format($totalUsersTelegram/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="users-telegram-month-stat"></div>
                    </div>
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>

            <!-- Users Android stat -->
            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Регистрации за 30 дней в Android</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-users4 position-left text-slate"></i> <?=$totalUsersAndroid?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-user position-left text-slate"></i> <?= number_format($totalUsersAndroid/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="users-android-month-stat"></div>
                    </div>
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>

            <!-- Worksheets stat -->
            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Заявки за 30 дней</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-files-empty2 position-left text-slate"></i> <?= $totalWorksheets ?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-file-empty2 position-left text-slate"></i> <?= number_format($totalWorksheets/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="worksheets-month-stat"></div>
                    </div>
                    <!--div class="content-group-sm" id="app_sales"></div-->
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Заявки за 30 дней из Telegram</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-files-empty2 position-left text-slate"></i> <?= $totalWorksheetsTelegram ?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-file-empty2 position-left text-slate"></i> <?= number_format($totalWorksheetsTelegram/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="worksheets-telegram-month-stat"></div>
                    </div>
                    <!--div class="content-group-sm" id="app_sales"></div-->
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Заявки за 30 дней из Android</h6>
                    </div>

                    <div class="container-fluid">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-files-empty2 position-left text-slate"></i> <?= $totalWorksheetsAndroid ?></h5>
                                    <span class="text-muted text-size-small">Кол-во</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h5 class="text-semibold no-margin"><i class="icon-file-empty2 position-left text-slate"></i> <?= number_format($totalWorksheetsAndroid/30, 2) ?></h5>
                                    <span class="text-muted text-size-small">Среднее</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div id="worksheets-android-month-stat"></div>
                    </div>
                    <!--div class="content-group-sm" id="app_sales"></div-->
                    <div id="monthly-sales-stats"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->registerJs('
    var usersStatDataset = ' . $usersStatDataset . ';
    var usersStatTelegramDataset = ' . $usersStatTelegramDataset . ';
    var usersStatAndroidDataset = ' . $usersStatAndroidDataset . ';
    
    var worksheetsStatDataset = ' . $worksheetsStatDataset . ';
    var worksheetsStatTelegramDataset = ' . $worksheetsStatTelegramDataset . ';
    var worksheetsStatAndroidDataset = ' . $worksheetsStatAndroidDataset . ';
    
    dailyStat(usersStatDataset, "#users-month-stat", 150, "#29B6F6");
    dailyStat(usersStatTelegramDataset, "#users-telegram-month-stat", 150, "#29B6F6");
    dailyStat(usersStatAndroidDataset, "#users-android-month-stat", 150, "#29B6F6");
    
    dailyStat(worksheetsStatDataset, "#worksheets-month-stat", 150, "#f69829");
    dailyStat(worksheetsStatTelegramDataset, "#worksheets-telegram-month-stat", 150, "#f69829");
    dailyStat(worksheetsStatAndroidDataset, "#worksheets-android-month-stat", 150, "#f69829");
', \yii\web\View::POS_READY);
?>