<?php

namespace app\controllers;

use app\models\Creditcards;
use app\models\UploadImage;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class CreditcardsController extends Controller
{

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
            'query' => Creditcards::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Creditcards();
        $uploadModel = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_LOGO]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadModel->uploadedImage = UploadedFile::getInstance($uploadModel, 'uploadedImage');
            if ($uploadModel->upload('logo-creditcards')) {
                $model->logo = 'http://manage.apiapps.lm23.net' . $uploadModel->getUploadedFilePath();
                $model->save();
            }
            if ($model->save()) {
                return $this->redirect('/creditcards');
            }
        }

        return $this->render('form', ['model' => $model, 'uploadModel' => $uploadModel]);
    }

    public function actionUpdate($id)
    {
        $model = Creditcards::findOne($id);
        $uploadModel = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_LOGO]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedImage = UploadedFile::getInstance($uploadModel, 'uploadedImage');
            if ($uploadModel->upload('logo-creditcards')) {
                $model->logo = 'http://manage.apiapps.lm23.net' . $uploadModel->getUploadedFilePath();
                $model->save();
            }
            return $this->redirect('/creditcards');
        }

        return $this->render('form', ['model' => $model, 'uploadModel' => $uploadModel]);
    }
}