<?php
namespace app\components\NotificationsWidget;

use yii\web\AssetBundle;

class NotificationsAsset extends AssetBundle{

    public $sourcePath = '@app/components/NotificationsWidget/assets';

    public $js = [
        'notifications.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}