<?php
namespace app\controllers;

use Yii;
use app\models\Worksheetsample;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class WorksheetsampleController extends Controller{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Worksheetsample::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Worksheetsample();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/worksheetsample');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Worksheetsample::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/worksheetsample');
        }

        return $this->render('form', ['model' => $model]);
    }
}