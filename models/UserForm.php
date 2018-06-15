<?php
namespace app\models;

use yii\base\Model;

class UserForm extends Model{

    public $firstName;

    public $secondName;

    public $lastName;

    public $birthday;

    public $country;

    public $gender;

    public $email;

    public $phone;

    public $goId;

    public $odId;

    public $vkId;

    public $fbId;

    public function rules()
    {
        return [
            ['country', 'exist', 'targetClass' => Countries::className(), 'targetAttribute' => 'id'],
            ['email', 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'firstName' => 'Имя',
            'secondName' => 'Отчество',
            'lastName' => 'Фамилия',
            'birthday' => 'Дата рождения',
            'country' => 'Страна',
            'gender' => 'Пол',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'goId' => 'Google Id',
            'odId' => 'Одноклассники Id',
            'vkId' => 'ВКонтакте Id',
            'fbId' => 'Facebook Id',
        ];
    }
}