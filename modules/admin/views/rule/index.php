<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var mdm\admin\models\AuthItemSearch $searchModel
 */
$this->title = Yii::t('rbac-admin', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
    <div class="content-header">
        <div class="header-section">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
<div class="kv-panel-before">

    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>
    <?php
    Pjax::begin([
        'enablePushState'=>false,
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => Yii::t('rbac-admin', 'Name'),
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
    ]);
    Pjax::end();
    ?>

</div>
