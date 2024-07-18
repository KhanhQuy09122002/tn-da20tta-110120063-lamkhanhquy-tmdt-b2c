<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\adminlte\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
         //'css/theme.css',
        
         'AdminLTE-2.4.12/bower_components/bootstrap/dist/css/bootstrap.min.css',        
         'AdminLTE-2.4.12/bower_components/font-awesome/css/font-awesome.min.css',
         'AdminLTE-2.4.12/bower_components/Ionicons/css/ionicons.min.css',
         //'AdminLTE-2.4.12/dist/css/AdminLTE.min.css',
         'js/adminlte-2.18/css/AdminLTE.min.css',
         'AdminLTE-2.4.12/dist/css/skins/_all-skins.min.css',
         'AdminLTE-2.4.12/bower_components/morris.js/morris.css',
         'AdminLTE-2.4.12/bower_components/jvectormap/jquery-jvectormap.css',
         'AdminLTE-2.4.12/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
         'AdminLTE-2.4.12/bower_components/bootstrap-daterangepicker/daterangepicker.css',
         'AdminLTE-2.4.12/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
         'https://www.responsivefilemanager.com/fancybox/jquery.fancybox-1.3.4.css', 
        
        'css/customadmin.css',
        'css/custom.css',
        'js/fancybox-master/dist/jquery.fancybox.min.css'
    ];
    public $js = [
        /*  'AdminLTE-2.4.12/bower_components/jquery/dist/jquery.min.js',*/
         'AdminLTE-2.4.12/bower_components/jquery-ui/jquery-ui.min.js', 
      //'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
         //'AdminLTE-2.4.12/bower_components/bootstrap/dist/js/bootstrap.min.js',
         'AdminLTE-2.4.12/bower_components/raphael/raphael.min.js',
         'AdminLTE-2.4.12/bower_components/morris.js/morris.min.js',
         'AdminLTE-2.4.12/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
         'AdminLTE-2.4.12/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
         'AdminLTE-2.4.12/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
         'AdminLTE-2.4.12/bower_components/jquery-knob/dist/jquery.knob.min.js',
         'AdminLTE-2.4.12/bower_components/moment/min/moment.min.js',
         'AdminLTE-2.4.12/bower_components/bootstrap-daterangepicker/daterangepicker.js',
         'AdminLTE-2.4.12/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
         'AdminLTE-2.4.12/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
         'AdminLTE-2.4.12/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
         'AdminLTE-2.4.12/bower_components/fastclick/lib/fastclick.js',
         'AdminLTE-2.4.12/dist/js/adminlte.min.js',
         //'AdminLTE-2.4.12/dist/js/pages/dashboard.js',
         //'AdminLTE-2.4.12/dist/js/demo.js',
         'AdminLTE-2.4.12/dist/js/custom.js',
        'js/ajaxcrud.js',
        'js/ModalRemote.js',
        'js/fancybox-master/dist/jquery.fancybox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
