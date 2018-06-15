<?php
namespace app\models;

use yii\db\ActiveRecord;

class Message extends ActiveRecord{

    public function rules()
    {
        return [
            [['id', 'language', 'translation'], 'required'],
            ['language', 'exist', 'targetClass' => Lang::className(), 'targetAttribute' => 'local'],
            ['id', 'exist', 'targetClass' => SourceMessage::className(), 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('page','Id оригинала'),
            'language' => \Yii::t('page','Язык'),
            'translation' => \Yii::t('page','Перевод'),
            'original' => \Yii::t('page','Оригинал'),
        ];
    }

    /**
     * Оригинал сообщения
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOriginal()
    {
        return $this->hasOne(SourceMessage::className(), ['id' => 'id']);
    }
}