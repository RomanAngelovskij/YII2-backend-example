<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Lang extends ActiveRecord{

    //Переменная, для хранения текущего объекта языка
    static $current = null;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['local', 'name'], 'required'],
            ['local', 'unique'],
            ['url', 'unique']
        ];
    }

    public function attributeLabels()
    {
        return [
            'local' => 'Локаль',
            'name' => 'Язык',
            'default' => 'Основной',
        ];
    }

    static function getCurrent()
    {
        if( self::$current === null ){
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->local;
    }

    static function getDefaultLang()
    {
        return Lang::find()->where('`default` = :default', [':default' => 1])->one();
    }

    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Lang::find()->where('url = :url', [':url' => $url])->one();
            if ( $language === null ) {
                return null;
            } else {
                return $language;
            }
        }
    }

    public static function getUrlPrefix()
    {
        if (Lang::getCurrent()->default == true){
            return '';
        } else {
            return '/' . Lang::getCurrent()->url;
        }
    }
}