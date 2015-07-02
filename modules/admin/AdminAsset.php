<?php

namespace app\modules\admin;

/**
 * AdminAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AdminAsset extends \yii\web\AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@app/modules/admin/';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /**
     * @inheritdoc
     */
    public $css = [
        'web/backend/css/fullcalendar/fullcalendar.css',
        'web/backend/css/animate-css/animate.min.css',
        'web/backend/css/sweet-alert/sweet-alert.min.css',
        'web/backend/css/app.min.css',
        'web/backend/css/custom.css',
    ];
    public $js = [
        'web/backend/js/flot/jquery.flot.min.js',
        'web/backend/js/flot/jquery.flot.resize.min.js',
        'web/backend/js/flot/plugins/curvedLines.js',
        'web/backend/js/sparklines/jquery.sparkline.min.js',
        'web/backend/js/easypiechart/jquery.easypiechart.min.js',
        'web/backend/js/fullcalendar/lib/moment.min.js',
        'web/backend/js/fullcalendar/fullcalendar.min.js',
        'web/backend/js/simpleWeather/jquery.simpleWeather.min.js',
        'web/backend/js/auto-size/jquery.autosize.min.js',
        'web/backend/js/nicescroll/jquery.nicescroll.min.js',
        'web/backend/js/waves/waves.min.js',
        'web/backend/js/bootstrap-growl/bootstrap-growl.min.js',
        'web/backend/js/sweet-alert/sweet-alert.min.js',
        'web/backend/js/flot-charts/curved-line-chart.js',
        'web/backend/js/flot-charts/line-chart.js',
        'web/backend/js/charts.js',
        'web/backend/js/functions.js',
        'web/backend/js/toolstable.js',
        'web/backend/js/custom.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
