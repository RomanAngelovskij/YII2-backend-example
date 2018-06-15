<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class MainController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect('/login');
        }
        /*
         * Статистика пользователей
         */
        $totalUsersTelegram = $totalUsersAndroid = $totalUsers = 0;
        $usersStatDataset = [];
        $usersStat = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->from('user')
            ->groupBy(["FROM_UNIXTIME(created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        $usersStatTelegram = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->where(['register_source' => 'Telegram'])
            ->from('user')
            ->groupBy(["FROM_UNIXTIME(created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        $usersStatAndroid = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->where(['register_source' => 'Android'])
            ->from('user')
            ->groupBy(["FROM_UNIXTIME(created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        /*
         * Статистика заявок
         */
        $totalWorksheetsTelegram = $totalWorksheetsAndroid = $totalWorksheets = 0;
        $worksheetsStatDataset = [];
        $worksheetsStat = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->from('worksheets')
            ->groupBy(["FROM_UNIXTIME(created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        $worksheetsStatTelegram = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(worksheets.created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->from('worksheets')
            ->leftJoin('user u', 'u.id = worksheets.user_id')
            ->where(['register_source' => 'Telegram'])
            ->groupBy(["FROM_UNIXTIME(worksheets.created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        $worksheetsStatAndroid = (new \yii\db\Query())
            ->select(["FROM_UNIXTIME(worksheets.created_at, '%d.%m.%Y') `date`", "COUNT(*) `cnt`"])
            ->from('worksheets')
            ->leftJoin('user u', 'u.id = worksheets.user_id')
            ->where(['register_source' => 'Android'])
            ->groupBy(["FROM_UNIXTIME(worksheets.created_at, '%Y %D %M')"])
            ->indexBy('date')
            ->all();

        $statStart = strtotime('-30 days');
        $today = strtotime('today')+86400;
        for ($d = $statStart; $d <= $today; $d += 86400){
            /*
             * Общее кол-во регистраций
             */
            $users = isset($usersStat[date('d.m.Y', $d)]) ? $usersStat[date('d.m.Y', $d)]['cnt'] : 0;
            $totalUsers += $users;
            $usersStatDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $users,
            ];

            /*
             * Ренистрации через телеграм
             */
            $usersTelegram = isset($usersStatTelegram[date('d.m.Y', $d)]) ? $usersStatTelegram[date('d.m.Y', $d)]['cnt'] : 0;
            $totalUsersTelegram += $usersTelegram;
            $usersStatTelegramDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $usersTelegram,
            ];

            /*
             * Регистрации через Android
             */
            $usersAndroid = isset($usersStatAndroid[date('d.m.Y', $d)]) ? $usersStatAndroid[date('d.m.Y', $d)]['cnt'] : 0;
            $totalUsersAndroid += $usersAndroid;
            $usersStatAndroidDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $usersAndroid,
            ];

            /*
             * Общее кол-во заявок
             */
            $worksheets = isset($worksheetsStat[date('d.m.Y', $d)]) ? $worksheetsStat[date('d.m.Y', $d)]['cnt'] : 0;
            $totalWorksheets += $worksheets;
            $worksheetsStatDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $worksheets,
            ];

            $worksheetsTelegram = isset($worksheetsStatTelegram[date('d.m.Y', $d)]) ? $worksheetsStatTelegram[date('d.m.Y', $d)]['cnt'] : 0;
            $totalWorksheetsTelegram += $worksheetsTelegram;
            $worksheetsStatTelegramDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $worksheetsTelegram,
            ];

            $worksheetsAndroid = isset($worksheetsStatAndroid[date('d.m.Y', $d)]) ? $worksheetsStatAndroid[date('d.m.Y', $d)]['cnt'] : 0;
            $totalWorksheetsAndroid += $worksheetsAndroid;
            $worksheetsStatAbdroidDataset[] = [
                'date' => date('m/d/y', $d),
                'cnt' => $worksheetsAndroid,
            ];
        }

        return $this->render('index', [
            'usersStatDataset' => json_encode($usersStatDataset),
            'usersStatTelegramDataset' => json_encode($usersStatTelegramDataset),
            'usersStatAndroidDataset' => json_encode($usersStatAndroidDataset),
            'totalUsers' => $totalUsers,
            'totalUsersTelegram' => $totalUsersTelegram,
            'totalUsersAndroid' => $totalUsersAndroid,
            'worksheetsStatDataset' => json_encode($worksheetsStatDataset),
            'worksheetsStatTelegramDataset' => json_encode($worksheetsStatTelegramDataset),
            'worksheetsStatAndroidDataset' => json_encode($worksheetsStatAbdroidDataset),
            'totalWorksheets' => $totalWorksheets,
            'totalWorksheetsTelegram' => $totalWorksheetsTelegram,
            'totalWorksheetsAndroid' => $totalWorksheetsAndroid,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
