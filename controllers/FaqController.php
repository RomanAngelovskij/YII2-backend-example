<?php
namespace app\controllers;

use app\models\Faq;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class FaqController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $filter = Yii::$app->request->get();
        $query = Faq::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Faq();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/faq');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $filter = Yii::$app->request->get();
        $model = Faq::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/faq');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        Faq::deleteAll(['id' => $id]);

        return $this->redirect('/faq');
    }
}