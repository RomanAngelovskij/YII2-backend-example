<?php
namespace app\controllers;

use app\models\WorksheetsamplesAddresses;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

class AddressesController extends Controller{

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
        $query = WorksheetsamplesAddresses::find();

        if (isset($filter['worksheetsampleId']) && !empty((int)$filter['worksheetsampleId'])){
            $query->andWhere(['worksheetsample_id' => $filter['worksheetsampleId']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['order_position' => SORT_ASC]]
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $filter = Yii::$app->request->get();
        $model = new WorksheetsamplesAddresses();
        if (isset($filter['worksheetsampleId']) && !empty((int)$filter['worksheetsampleId'])){
            $model->worksheetsample_id = $filter['worksheetsampleId'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/addresses?' . http_build_query($filter));
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $filter = Yii::$app->request->get();
        $model = WorksheetsamplesAddresses::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/addresses?' . http_build_query($filter));
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
        $field = WorksheetsamplesAddresses::findOne(Yii::$app->request->get('fieldId'));

        return $field;
    }

    public function actionSort()
    {
        $order = Yii::$app->request->post('Order');
        foreach ($order as $orderPosition => $id){
            $item = WorksheetsamplesAddresses::findOne(['id' => $id]);
            $item->order_position = $orderPosition;
            $item->save();
        }
        echo json_encode($order);
    }
}