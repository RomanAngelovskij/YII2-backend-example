<?php
namespace app\controllers;

use app\models\Documents;
use app\models\DocumentsFields;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class FieldsController extends Controller{

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

    public function actionIndex($id)
    {
        $filter = Yii::$app->request->get();
        $document = Documents::findOne($id);
        $query = DocumentsFields::find()->where(['doc_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', ['document' => $document, 'dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $docId = Yii::$app->request->get('documentId');
        $model = new DocumentsFields();
        $model->doc_id = $docId;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/fields/' . $model->doc_id);
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = DocumentsFields::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/fields/' . $model->doc_id);
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