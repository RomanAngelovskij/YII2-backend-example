<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class DocumentsFields extends ActiveRecord{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['doc_id', 'symb_id', 'type', 'label', 'sample'], 'required'],
            ['doc_id', 'exist', 'targetClass' => Documents::className(), 'targetAttribute' => 'id'],
            ['symb_id', 'match', 'pattern' => '/^[a-z_\-\d]+$/i'],
            ['min', 'integer'],
            ['min', 'default', 'value' => 0],
            ['max', 'integer'],
            ['max', 'default', 'value' => 0],
            ['maxlength', 'integer'],
            ['maxlength', 'default', 'value' => 0],
            ['type', 'in', 'range' => ['text', 'date', 'email', 'num', 'tel', 'url']],
            ['label', 'string', 'max' => 50],
            ['description', 'string'],
            ['regexp_rule', 'safe'],
            ['sample', 'string', 'max' => 250],
            ['placeholder', 'string', 'max' => 100],
            ['input_mask', 'string'],
            //['input_mask', 'validateMask']
        ];
    }

    public function attributeLabels()
    {
        return [
            'doc_id' => 'Документ',
            'symb_id' => 'Название поля (eng)',
            'min' => 'Минимальное значение, если число',
            'max' => 'Максимальное значение, если число',
            'maxlength' => 'Максимальная длина',
            'type' => 'Тип поля',
            'input_mask' => 'Маска',
            'regexp_rule' => 'Регулярное выражение',
            'label' => 'Название',
            'description' => 'Описание',
            'sample' => 'Пример',
            'placeholder' => 'Placeholder',
        ];
    }

    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'doc_id']);
    }

    public function validateMask($attribute, $value){
        if (!empty($this->{$attribute})){
            preg_match_all('/\[(\d)\]/i', $this->{$attribute}, $match);
        }
    }

    public static function getListForDropdown()
    {
        $result = ['' => ''];
        $fields = self::find()->where(['deleted' => false])->all();
        foreach ($fields as $field){
            $result[$field->id] = $field->document->country->name . ' / ' . $field->document->name . ' / ' . $field->label;
        }

        return $result;
    }
}