<?php
namespace app\models;

use yii\db\ActiveRecord;


/**
 * Class UserData
 * @package app\models
 *
 * @property string $phone
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 */
class UserData extends ActiveRecord{

    public static function primaryKey()
    {
        return ['user_id'];
    }

    public function rules()
    {
        return [
            [['first_name', 'second_name', 'last_name'], 'safe'],
            [['country'], 'required'],
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
            ['birthday', 'integer'],
            ['gender', 'in', 'range' => ['m', 'f']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'second_name' => 'Отчество',
            'last_name' => 'Фамилия',
            'birthday' => 'Дата рождения',
            'gender' => 'Пол',
        ];
    }

    public function getCountryData()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }
}