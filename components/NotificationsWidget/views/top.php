<?php
/* @var $notifications \app\modules\notifications\models\Notifications */

\app\components\NotificationsWidget\NotificationsAsset::register($this);
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown">
        <i class="icon-bubbles4"></i>
        <span class="visible-xs-inline-block position-right">Messages</span>
        <span class="badge bg-warning-400" id="notifications-count"><?= count($notifications) == 0 ? '' : count($notifications) ?></span>
    </a>

    <div class="dropdown-menu dropdown-content width-350">
        <div class="dropdown-content-heading">
            Уведомления
        </div>

        <?php if (!empty($notifications)): ?>
        <ul class="media-list dropdown-content-body">
            <?php foreach ($notifications as $notification):?>
                <li class="media notification-item" data-id="<?= $notification->id ?>">
                    <div class="media-left">
                        <img src="/images/placeholder.jpg" class="img-circle img-sm" alt="">
                        <span class="badge bg-danger-400 media-badge"></span>
                    </div>

                    <div class="media-body">
                        <span class="media-heading">
                            <span class="text-semibold"><?= $notification->sender->name ?></span>
                            <span class="media-annotation pull-right"><?= date('d.m.Y', $notification->created_at) == date('d.m.Y') ? date('H:i', $notification->created_at) : date('d.m.Y H:i', $notification->created_at)?></span>
                        </span>

                        <span class="text-muted">
                            <?php if (isset($notification->data['url'])): ?>
                                <a href="<?=$notification->data['url']?>"><?= $notification->shortMessage ?></a>
                            <?php else: ?>
                                <?= $notification->shortMessage ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif ?>
    </div>
</li>