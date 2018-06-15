<?php
namespace app\controllers;

use app\models\AuthLog;
use app\models\search\UserSearch;
use app\models\User;
use app\models\Worksheets;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class UsersController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $user = User::findOne($id);

        if ($user->load(Yii::$app->request->post()) && $user->profile->load(Yii::$app->request->post())){
            $user->profile->birthday = strtotime($user->profile->birthday);
            $user->save();
            $user->profile->save();
        }

        $worksheetsDataProvider = new ActiveDataProvider([
            'query' => Worksheets::find()->where(['user_id' => $user->id]),
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]]
        ]);

        $user->profile->birthday = date('d.m.Y', $user->profile->birthday);
        return $this->render('view', [
            'user' => $user,
            'profile' => $user->profile,
            'worksheetsDataProvider' => $worksheetsDataProvider,
        ]);
    }
}