<?php
namespace app\models;

use yii\db\ActiveRecord;

class Faq extends ActiveRecord{

    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'question' => 'Вопрос',
            'answer' => 'Ответ',
        ];
    }
}