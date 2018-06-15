<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/icons/icomoon/styles.css',
        'css/icons/fontawesome/styles.min.css',
        'css/bootstrap.min.css',
        'css/core.css',
        'css/components.css',
        'css/colors.css',
        'css/fix.css'
    ];
    public $js = [
        'js/core/libraries/bootstrap.min.js',
        'js/core/libraries/jquery_ui/interactions.min.js',
        'js/core/libraries/jquery_ui/widgets.min.js',
        'js/core/libraries/jquery_ui/effects.min.js',
        'js/plugins/extensions/mousewheel.min.js',
        'js/core/libraries/jquery_ui/globalize/globalize.js',
        'js/plugins/loaders/blockui.min.js',
        'js/plugins/ui/nicescroll.min.js',
        'js/plugins/ui/drilldown.js',
        'js/plugins/visualization/d3/d3.min.js',
        'js/plugins/visualization/d3/d3_tooltip.js',
        'js/plugins/forms/styling/switchery.min.js',
        '/js/plugins/forms/styling/switch.min.js',
        '/js/plugins/forms/tags/tagsinput.min.js',
        'js/plugins/forms/styling/uniform.min.js',
        'js/plugins/forms/selects/bootstrap_multiselect.js',
        'js/plugins/ui/moment/moment.min.js',
        '/js/plugins/pickers/daterangepicker.js',
        '/js/plugins/forms/selects/bootstrap_select.min.js',
        '/js/plugins/pickers/anytime.min.js',
        '/js/plugins/editors/summernote/summernote.min.js',
        //'/js/plugins/pickers/pickadate/picker.js',
        //'/js/plugins/pickers/pickadate/picker.date.js',
        //'/js/plugins/pickers/pickadate/legacy.js',
        //'/js/plugins/editors/ckeditor/ckeditor.js',

        '/js/core/libraries/jasny_bootstrap.min.js',

        'js/core/app.min.js',
        'js/binds.js',
        'js/modals.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        //'yii\jui\JuiAsset',
    ];

    public function init()
    {
        $this->js[] = 'js/script.js?' . time();
    }
}
