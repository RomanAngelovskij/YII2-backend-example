<?php
namespace app\controllers;

use app\models\Lang;
use app\models\Message;
use app\models\SourceMessage;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TranslateController extends Controller {

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
            'query' => SourceMessage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Добавление перевода
     *
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new SourceMessage();
        $languages = Lang::find()->where(['default' => 0])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            foreach ($model->formMessages as $language => $message){
                $messgeModel = new Message();
                $messgeModel->id = $model->id;
                $messgeModel->language = $language;
                $messgeModel->translation = $message;
                $messgeModel->save();
            }

            return $this->redirect('/translate');
        }

        return $this->render('form', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = SourceMessage::findOne($id);
        $languages = Lang::find()->where(['default' => 0])->all();

        if (empty($model)){
            throw new NotFoundHttpException('Такого перевода не существует');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect('/translate');
        }

        return $this->render('form', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Locations::findOne($id);

        if (!empty($model->datacenters)){
            throw new ForbiddenHttpException('Эта локация используется в датацентрах, сначала отключите ее в них.');
        }

        $model->delete();

        return $this->redirect('/admin/locations');
    }
}