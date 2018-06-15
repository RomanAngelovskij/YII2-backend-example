<?php
namespace app\components\NotificationsWidget;

use app\modules\notifications\models\Notifications;
use yii\base\Exception;
use yii\base\Widget;

class NotificationsWidget extends Widget{

    public $recipientId;

    public function init()
    {
        parent::init();
        if ($this->recipientId === null) {
            throw new Exception('Setup recipient id');
        }


    }

    public function run()
    {
        $notifications = Notifications::find()
            ->where(['user_id' => $this->recipientId, 'is_read' => false])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('top', [
            'notifications' => $notifications,
        ]);
    }
}