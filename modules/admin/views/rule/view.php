<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="kv-panel-before">
        <p>
            <?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?php
            echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
                'data-method' => 'post',
            ]);
            ?>
        </p>
    </div>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'className',
        ],
    ]);
    ?>
</div>