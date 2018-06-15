<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use app\models\OrdersStatuses;

\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/">API Leadmafia</a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav navbar-right">
            <? if (Yii::$app->user->isGuest): ?>
                <li>
                    <a href="/login">
                        <i class="icon-user-tie"></i> <span class="visible-xs-inline-block position-right"> Вход</span>
                    </a>
                </li>
            <?php else: ?>

                <?php /*echo \app\components\NotificationsWidget\NotificationsWidget::widget(['recipientId' => Yii::$app->user->id])*/ ?>

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><?= Yii::$app->user->identity->username ?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="/profile"><i class="icon-user-plus"></i> Профиль</a></li>

                        <li class="divider"></li>
                        <li><a href="/logout"><i class="icon-switch2"></i> Выход</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<?php if (!Yii::$app->user->isGuest): ?>
    <!-- Second navbar -->
    <div class="navbar navbar-default" id="navbar-second">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i
                            class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/"><i class="icon-home position-left"></i> Главная</a>
                </li>

                <li class="active">
                    <a href="/users"><i class="icon-users4 position-left"></i> Пользователи</a>
                </li>

                <li class="active">
                    <a href="/worksheets"><i class="icon-files-empty2 position-left"></i> Заявки</a>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-question4 position-left"></i> Вопросы анкеты <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">
                        <?php
                        $worksheetsamples = \app\models\Worksheetsample::find()->all();
                        foreach ($worksheetsamples as $worksheetsample):
                            ?>
                            <li>
                                <a href="/questions/?worksheetsampleId=<?= $worksheetsample->id ?>"><?= $worksheetsample->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-address-book position-left"></i> Адресные данные <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">
                        <?php
                        $worksheetsamples = \app\models\Worksheetsample::find()->all();
                        foreach ($worksheetsamples as $worksheetsample):
                            ?>
                            <li>
                                <a href="/addresses/?worksheetsampleId=<?= $worksheetsample->id ?>"><?= $worksheetsample->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-book3 position-left"></i> Документы <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">
                        <?php
                        $worksheetsamples = \app\models\Worksheetsample::find()->all();
                        foreach ($worksheetsamples as $worksheetsample):
                        ?>
                        <li>
                            <a href="/documents/?worksheetsampleId=<?= $worksheetsample->id ?>"><?= $worksheetsample->name ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-notebook position-left"></i> Справочники <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">
                        <li>
                            <a href="/countries"><i class="icon-earth position-left"></i> Страны</a>
                        </li>
                        <li>
                            <a href="/languages"><i class="fa fa-comments position-left"></i> Языки</a>
                        </li>
                        <li>
                            <a href="/currency/"><i class="icon-coin-dollar position-left"></i> Валюты</a>
                        </li>
                        <li>
                            <a href="/mfo/"><i class="icon-percent position-left"></i> МФО</a>
                        </li>
                        <li>
                            <a href="/creditcards/"><i class="icon-credit-card2 position-left"></i> Кредитки</a>
                        </li>
                        <li>
                            <a href="/worksheetsample"><i class="icon-files-empty position-left"></i> Типы заявок</a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-quill2 position-left"></i> Контент <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu width-250">
                        <li>
                            <a href="/faq"><i class="icon-question7 position-left"></i> FAQ</a>
                        </li>
                        <li>
                            <a href="/translate"><i class="fa fa-language position-left"></i> Перевод</a>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
    </div>
    <!-- /second navbar -->
<?php endif; ?>

<?php
/*
NavBar::begin([
    'brandLabel' => 'King Servers CDN',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/login']];
} else {
    $domainsItems = [];
    $disabledDomains = 0;
    $domainsLabel = 'Мои домены';
    if (!empty($this->params['userDomains'])){
        $disabledDomains = 0;
        foreach ($this->params['userDomains'] as $domain){
            if ($domain->active == false){
                $disabledDomains++;
            }

            $statusClass = $domain->active == true ? 'active-bullet' : 'inactive-bullet';
            $domainsItems[] = [
                'label' => $domain->domain,
                'url' => '/domains/edit/' . $domain->id,
                'linkOptions' => [
                    'class' => $statusClass,
                ]
            ];
        }
        $domainsItems[] = '<li class="divider"></li>';
    }

    if ($disabledDomains > 0){
        $domainsLabel .= ' <span class="label label-danger">' . $disabledDomains . '</span>';
    }

    $domainsItems[] = [
        'label' => 'Добавить домен',
        'url' => '/domains/new'
    ];
    $menuItems[] = [
        'label' => $domainsLabel,
        'items' => $domainsItems,
        'encode' => false,
    ];

    $paymentsLabel = 'Оплата';
    $newInvoices = Yii::$app->user->getIdentity()->newInvoices;
    if (!empty($newInvoices)) {
        $paymentsLabel .= ' <span class="label label-info">' . count($newInvoices) . '</span>';
    }

    $menuItems[] = [
        'encode' => false,
        'label' => $paymentsLabel,
        'items' => [
            [
                'label' => 'Счета',
                'url' => '/invoices/'
            ],
            [
                'label' => 'Транзакции',
                'url' => '/transactions/'
            ]
        ]
    ];

    $menuItems[] = '<li>'
        . Html::beginForm(['/logout'], 'post')
        . Html::submitButton(
            'Выход (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link']
        )
        . Html::endForm()
        . '</li>';

    $menuItems[] = ['label' => '$' . number_format($this->params['userBalance'], 2), 'url' => 'balance'];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
*/
?>



<?= $content ?>


<!-- Footer -->
<div class="footer text-muted">
    API Leadmafia &copy; <?= date('Y') ?>
</div>
<!-- /footer -->

<div id="common-modal" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">


        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
