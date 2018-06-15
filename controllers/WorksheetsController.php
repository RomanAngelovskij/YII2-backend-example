<?php
namespace app\controllers;

use Yii;
use app\models\search\WorksheetSearch;
use app\models\Worksheets;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class WorksheetsController extends Controller{

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
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new WorksheetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $worksheet = Worksheets::findOne($id);

        $documents = [];
        if (!empty($worksheet->documents)){
            foreach ($worksheet->documents as $documentValue){
                $documents[$documentValue->document->symb_id][$documentValue->field->label] = $documentValue->value;
            }
        }

        return $this->render('view', [
            'worksheet' => $worksheet,
            'documents' => $documents
        ]);
    }
}