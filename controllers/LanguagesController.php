<?php
namespace app\controllers;

use app\models\Documents;
use app\models\DocumentsFields;
use app\models\Lang;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class LanguagesController extends Controller{

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
            'query' => Lang::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Lang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/languages/');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Lang::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/languages/');
        }

        return $this->render('form', ['model' => $model]);
    }

    /**
     * Получение данных поля, для заполнения по его примеру другого в форме добавления
     * @return null|static
     */
    public function actionCopy()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $field = DocumentsFields::findOne(Yii::$app->request->get('fieldId'));

        return $field;
    }
}