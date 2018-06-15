<?php
namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Creditcards extends ActiveRecord{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['country_id', 'name', 'legal_name', 'percent', 'amount', 'duration', 'probability', 'rating', 'description', 'link', 'logo'], 'required'],
            ['country_id', 'exist', 'targetClass' => Countries::className(), 'targetAttribute' => 'id'],
            ['percent', 'double'],
            ['amount', 'integer'],
            ['duration', 'integer'],
            ['probability', 'integer'],
            ['rating', 'integer'],
            ['link', 'url'],
            ['logo', 'url'],
            ['small_logo', 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'country_id' => 'Страна',
            'name' => 'Название',
            'legal_name' => 'Юр. лицо',
            'percent' => '% ставка',
            'amount' => 'Максимальная сумма',
            'duration' => 'Максимальный срок, дней',
            'probability' => 'Вероятность одобрения, %',
            'rating' => 'Рейтинг',
            'description' => 'Описание',
            'link' => 'Ссылка',
            'logo' => 'Логотип',
            'small_logo' => 'Уменьшеный логотип',
        ];
    }

    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }
}