<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\Route $model
 * @var ActiveForm $form
 */

$this->title = Yii::t('rbac-admin', 'Create Route');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-header">
    <div class="header-section">
		<h1><?= Yii::t('rbac-admin', 'Create Route') ?></h1>
    </div>
</div>

<div class="create">
	<div class="group-content">
		<?php $form = ActiveForm::begin(); ?>

			<?= $form->field($model, 'route') ?>

			<div class="form-group">
				<div class="kv-panel-before">
					<?= Html::submitButton(Yii::t('rbac-admin', 'Create'), ['class' => 'btn btn-primary']) ?>
				</div>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div><!-- create -->
