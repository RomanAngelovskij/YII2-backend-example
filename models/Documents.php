<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Documents extends ActiveRecord{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return 'documents';
    }

    public function rules()
    {
        return [
            [['country_id', 'symb_id', 'name'], 'required'],
            ['country_id', 'exist', 'targetClass' => Countries::className(), 'targetAttribute' => 'id'],
            ['symb_id', 'match', 'pattern' => '/^[a-z_\-\d]+$/i'],
            ['symb_id', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'country_id' => 'Страна',
            'symb_id' => 'Название документа (eng)',
            'name' => 'Название',
            'fields' => 'Поля',
            'worksheetsamples' => 'Типы заявок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getFields()
    {
        return $this->hasMany(DocumentsFields::className(), ['doc_id' => 'id'])
            ->indexBy('symb_id');
    }

    public function getWorksheetsamples()
    {
        return $this->hasMany(Worksheetsample::className(), ['id' => 'worksheetsample_id'])
            ->viaTable('worksheetsamples_documents', ['doc_id' => 'id']);
    }
}