<?php
namespace app\models;

use yii\db\ActiveRecord;

class SourceMessage extends ActiveRecord{

    public $formMessages;

    public function rules()
    {
        return [
            [['formMessages'], 'safe'],
            [['category', 'message'], 'required'],
            ['category', 'exist', 'targetClass' => MessageCategories::className(), 'targetAttribute' => 'category'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'formMessages' => \Yii::t('page','Варианты перевода'),
            'message' => \Yii::t('page','Оригинал'),
            'category' => \Yii::t('page','Категория'),
            'messages' => \Yii::t('page','Варианты перевода'),
        ];
    }

    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['id' => 'id']);
    }
}