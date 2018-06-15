<?php
namespace app\models;

use yii\base\Model;

class UploadImage extends Model
{

    const UPLOAD_MFO_LOGO = 'uploadMfoLogo';

    const UPLOAD_MFO_SMALL_LOGO = 'uploadMfoSmallLogo';

    public $uploadedImage;

    public $uploadedSmallImage;


    /**
     * Путь к успешно загруженному изображению
     * @var
     */
    private $_uploadedFilePath;

    public function scenarios()
    {
        return [
            self::UPLOAD_MFO_LOGO => ['uploadedImage'],
            self::UPLOAD_MFO_SMALL_LOGO => ['uploadedSmallImage'],
        ];
    }

    public function rules()
    {
        return [
            //[['uploadedImage'], 'required', 'on' => self::UPLOAD_MFO_LOGO],
            //[['uploadedSmallImage'], 'required', 'on' => self::UPLOAD_MFO_SMALL_LOGO],
            //['uploadedImage', 'image', 'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'svg'], 'maxWidth' => 300, 'maxHeight' => 200],
            ['uploadedImage', 'file', 'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'svg']],
            ['uploadedSmallImage', 'file', 'extensions' => ['jpg', 'jpeg', 'gif', 'png', 'svg']]
        ];
    }

    public function getUploadedFilePath()
    {
        return $this->_uploadedFilePath;
    }

    public function upload($folder = 'data', $filename = '')
    {
        if ($this->validate()) {
            if (!file_exists('files')){
                mkdir('files');
            }

            if (!file_exists('files/' . $folder)){
                mkdir('files/' . $folder);
            }
            $filename = empty($filename) ? $this->uploadedImage->baseName : $filename;
            $this->uploadedImage->saveAs('files/' . $folder .'/' . $filename . '.' . $this->uploadedImage->extension);
            $this->_uploadedFilePath = '/files/' . $folder . '/' . $filename . '.' . $this->uploadedImage->extension;
            return true;
        } else {
            return false;
        }
    }
}