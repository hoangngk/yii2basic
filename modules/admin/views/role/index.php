<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var mdm\admin\models\AuthItemSearch $searchModel
 */
$this->title = Yii::t('rbac-admin', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
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
        'export' => false,
        'layout'=>"",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
            ],
            [
                'attribute' => 'description',
                'label' => Yii::t('rbac-admin', 'Description'),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'buttons'   =>  [
                    'view' => function ($url) {
                        return Html::a('<span class="md glyphicon glyphicon-eye-open"></span>', $url, ['class'=>'btn btn-success btn-icon', 'title'=>'View']);
                    },
                    'update' => function ($url) {
                        return Html::a('<span class="md md-edit"></span>', $url, ['class'=>'btn btn-primary btn-icon', 'title'=>'Update']);
                    },
                    'delete' => function ($url) {
                        return Html::a('<span class="md md-delete"></span>', $url, [
                            'class'=>'btn btn-icon btn-danger deleteConfirmation',
                            'data-confirm'=>'Are you sure you want to delete this item?',
                            'title'=>'Delete',
                            'data-method'=>'post',
                            'data-pjax'=>1,
                        ]);
                    },
                ],
            ],

        ],
        'panel' => [
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create', ['create'], ['class' => 'btn btn-success']),
            'footer' => false
        ],
    ]);
    Pjax::end();
    ?>
</div>
