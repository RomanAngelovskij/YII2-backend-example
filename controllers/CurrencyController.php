<?php
namespace app\controllers;

use app\models\CountryCurrency;
use Yii;
use app\models\Currency;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class CurrencyController extends Controller{
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
            'query' => Currency::find()
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Currency();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $countries = Yii::$app->request->post('Currency')['countries'];
            CountryCurrency::deleteAll(['currency_id' => $model->id]);
            if (!empty($countries)){
                foreach ($countries as $countryId){
                    $countryCurrency = new CountryCurrency();
                    $countryCurrency->country_id = $countryId;
                    $countryCurrency->currency_id = $model->id;
                    $countryCurrency->save();
                }
            }
            return $this->redirect('/currency');
        }

        return $this->render('form', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Currency::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $countries = Yii::$app->request->post('Currency')['countries'];
            CountryCurrency::deleteAll(['currency_id' => $model->id]);
            if (!empty($countries)){
                foreach ($countries as $countryId){
                    $countryCurrency = new CountryCurrency();
                    $countryCurrency->country_id = $countryId;
                    $countryCurrency->currency_id = $model->id;
                    $countryCurrency->save();
                }
            }
            return $this->redirect('/currency');
        }

        return $this->render('form', ['model' => $model]);
    }
}