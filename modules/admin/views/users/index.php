<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use app\components\widgets\ToolsTableWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="content-header">
        <div class="header-section">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <?php  
        Pjax::begin([
            'enablePushState'=>false,
        ]);
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'checbox-list-item'
            ],
            'columns'      => [
                [
                    'header' => '<input type="checkbox" name="choose-all" class="checkbox-choose-all"/>',
                    'format' => 'raw',
                    'value'  => function ($model) {
                        return Html::checkbox('checkbox-item-data', false, $options = [
                                'data-post' => $model->id,
                                'class' => 'checkbox-item'
                            ]);
                    }
                ],
                ['class' => 'yii\grid\SerialColumn'],
                'username',
                'lastname',
                'firstname',
                'email:email',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => Yii::t('app', 'Action'),
                    'buttons' => [
                        'view' => function ($url) {
                            return Html::a('<span class="md glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-success btn-icon', 
                                    'title' => Yii::t('app', 'View')
                                ]);
                        },
                        'update' => function ($url) {
                            return Html::a('<span class="md md-edit"></span>', $url, [
                                    'class' => 'btn btn-primary btn-icon', 
                                    'title' => Yii::t('app', 'Update')
                                ]);
                        },
                        'delete' => function ($url) {
                            return Html::a('<span class="md md-delete"></span>', $url, [
                                'class'        => 'btn btn-icon btn-danger deleteConfirmation',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'title'        => Yii::t('app', 'Delete'),
                                'data-method'  => 'post',
                                'data-pjax'    => 1,
                            ]);
                        },
                    ]],
                ],
            'toolbar' => [
                '{export}'
            ],
            'exportConfig' => [
                'csv' => true,
            ],
            'panel' => [
                'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>'. Yii::t('app', 'Create'), [
                    'create'], ['class' => 'btn btn-success']) 
                    . ToolsTableWidget::widget([
                            'model'    => 'User', 
                            'redirect' => '/admin/users', 
                            'field'    => 'active'
                        ]
                    ),
            ],
        ]); 
        Pjax::end();
    ?>

</div>
