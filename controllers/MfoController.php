<?php

namespace app\controllers;

use app\models\Mfo;
use app\models\UploadImage;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;

class MfoController extends Controller
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
            'query' => Mfo::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Mfo();
        $uploadModel = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_LOGO]);
        $uploadModelSmall = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_SMALL_LOGO]);

        if ($model->load(Yii::$app->request->post())) {
            $uploadModel->uploadedImage = UploadedFile::getInstance($uploadModel, 'uploadedImage');
            $uploadModelSmall->uploadedImage = UploadedFile::getInstance($uploadModelSmall, 'uploadedSmallImage');

            if (!empty($uploadModel->uploadedImage) && $uploadModel->upload('logo-mfo')){
                $model->logo = 'http://manage.apiapps.lm23.net' . $uploadModel->getUploadedFilePath();
            }

            if (!empty($uploadModelSmall->uploadedImage) && $uploadModelSmall->upload('logo-mfo-small')){
                $model->small_logo = 'http://manage.apiapps.lm23.net' . $uploadModelSmall->getUploadedFilePath();
            }

            if ($model->save()) {
                return $this->redirect('/mfo');
            }
        }

        return $this->render('form', ['model' => $model, 'uploadModel' => $uploadModel, 'uploadModelSmall' => $uploadModelSmall]);
    }

    public function actionUpdate($id)
    {
        $model = Mfo::findOne($id);
        $uploadModel = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_LOGO]);
        $uploadModelSmall = new UploadImage(['scenario' => UploadImage::UPLOAD_MFO_SMALL_LOGO]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedImage = UploadedFile::getInstance($uploadModel, 'uploadedImage');
            $uploadModelSmall->uploadedImage = UploadedFile::getInstance($uploadModelSmall, 'uploadedSmallImage');

            if (!empty($uploadModel->uploadedImage) && $uploadModel->upload('logo-mfo')){
                $model->logo = 'http://manage.apiapps.lm23.net' . $uploadModel->getUploadedFilePath();
            }

            if (!empty($uploadModelSmall->uploadedImage) && $uploadModelSmall->upload('logo-mfo-small')){
                $model->small_logo = 'http://manage.apiapps.lm23.net' . $uploadModelSmall->getUploadedFilePath();
            }

            if ($model->save()) {
                return $this->redirect('/mfo');
            }
        }

        return $this->render('form', ['model' => $model, 'uploadModel' => $uploadModel, 'uploadModelSmall' => $uploadModelSmall]);
    }
}