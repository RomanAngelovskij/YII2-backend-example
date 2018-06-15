<?php
namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;

class AccessController extends Controller
{
    /**
     * Добавление роли
     *
     * @param $role
     * @param $description
     */
    public function actionAddRole($roleName, $description)
    {
        $role = Yii::$app->authManager->createRole($roleName);
        $role->description = $description;
        Yii::$app->authManager->add($role);

        echo "Role '{$roleName}' created\n";
    }

    public function actionAddUser($username, $password, $roleName)
    {
        $user = new User();

        $user->username = $username;
        $user->password_hash = md5($password . Yii::$app->params['salt']);
        $user->status = User::STATUS_ACTIVE;
        $result = $user->save();

        $userRole = Yii::$app->authManager->getRole($roleName);
        Yii::$app->authManager->assign($userRole, $user->getId());

        echo "{$roleName} role created result: " . $result . "\n";
    }
}
