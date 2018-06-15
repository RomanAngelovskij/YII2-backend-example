<?php
namespace app\models;

use yii\db\ActiveRecord;

class Worksheetsample extends ActiveRecord{

    public static function tableName()
    {
        return 'worksheetsamples';
    }

    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            ['name', 'unique'],
            ['country_id', 'exist', 'targetClass' => Countries::className(), 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'country_id' => 'Страна',
            'questionsNumber' => 'Кол-во вопросов',
            'addressNumber' => 'Поля адреса',
            'documentsNumber' => 'Кол-во документов'
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['id' => 'doc_id'])
            ->viaTable('worksheetsamples_documents', ['worksheetsample_id' => 'id'])
            ->indexBy('symb_id');
    }

    public function getQuestions()
    {
        return $this->hasMany(WorksheetsamplesQuestions::className(), ['worksheetsample_id' => 'id'])
            ->indexBy('name');
    }

    public function getAddress()
    {
        return $this->hasMany(WorksheetsamplesAddresses::className(), ['worksheetsample_id' => 'id'])
            ->indexBy('name');;
    }
}