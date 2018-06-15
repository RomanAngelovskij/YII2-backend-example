<?php
namespace app\controllers;

use app\models\Documents;
use app\models\WorksheetsamplesDocuments;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class DocumentsController extends Controller{

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
        $filter = Yii::$app->request->get();
        $query = Documents::find();

        if (isset($filter['worksheetsampleId']) && !empty((int)$filter['worksheetsampleId'])){
            $query->leftJoin('worksheetsamples_documents wd', 'wd.doc_id = documents.id');
            $query->andWhere(['wd.worksheetsample_id' => $filter['worksheetsampleId']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $filter = Yii::$app->request->get();
        $model = new Documents();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $worksheetsamples = Yii::$app->request->post('Documents')['worksheetsamples'];
            WorksheetsamplesDocuments::deleteAll(['doc_id' => $model->id]);
            if (!empty($worksheetsamples)){
                foreach ($worksheetsamples as $worksheetsampleId){
                    $worksheetsampleDoc = new WorksheetsamplesDocuments();
                    $worksheetsampleDoc->worksheetsample_id = $worksheetsampleId;
                    $worksheetsampleDoc->doc_id = $model->id;
                    $worksheetsampleDoc->save();
                }
            }
            return $this->redirect('/documents?' . http_build_query($filter));
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $filter = Yii::$app->request->get();
        $model = Documents::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $worksheetsamples = Yii::$app->request->post('Documents')['worksheetsamples'];
            WorksheetsamplesDocuments::deleteAll(['doc_id' => $model->id]);
            if (!empty($worksheetsamples)){
                foreach ($worksheetsamples as $worksheetsampleId){
                    $worksheetsampleDoc = new WorksheetsamplesDocuments();
                    $worksheetsampleDoc->worksheetsample_id = $worksheetsampleId;
                    $worksheetsampleDoc->doc_id = $model->id;
                    $worksheetsampleDoc->save();
                }
            }
            return $this->redirect('/documents?' . http_build_query($filter));
        }

        return $this->render('form', ['model' => $model]);
    }
}