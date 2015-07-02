<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\AuthItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="auth-item-form">
	<div class="group-content">
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

	    <?= $form->field($model, 'className')->textInput() ?>

	    <div class="form-group">
	    	<div class="kv-panel-before">
		        <?php
		        echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), [
		            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
		        ?>
	        </div>
	    </div>

	<?php ActiveForm::end(); ?>
	</div>
</div>
