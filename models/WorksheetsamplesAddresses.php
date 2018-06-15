<?php
namespace app\models;

use yii\db\ActiveRecord;

class WorksheetsamplesAddresses extends ActiveRecord{

    public static function tableName()
    {
        return 'worksheetsamples_addresses';
    }

    public function rules()
    {
        return [
            [['worksheetsample_id', 'name', 'type', 'label', 'sample'], 'required'],
            ['worksheetsample_id', 'exist', 'targetClass' => Worksheetsample::className(), 'targetAttribute' => 'id'],
            ['name', 'match', 'pattern' => '/^[a-z_\-\d]+$/i'],
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
            'worksheetsample_id' => 'Тип заявки',
            'name' => 'Название поля (eng)',
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
            'order_position' => 'Порядок сортировки',
        ];
    }

    public function getWorksheetsample()
    {
        return $this->hasOne(Worksheetsample::className(), ['id' => 'worksheetsample_id']);
    }

    public static function getListForDropdown()
    {
        $result = ['' => ''];
        $fields = self::find()->where(['deleted' => false])->all();
        foreach ($fields as $field){
            $result[$field->id] = $field->worksheetsample->name . ' / ' . $field->label;
        }

        return $result;
    }
}