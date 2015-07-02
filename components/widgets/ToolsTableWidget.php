<?php
namespace app\components\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\models\User;
use app\models\Activity;


class ToolsTableWidget extends Widget
{
	public $model;
	// ajax url
	public $ajaxUrl;
	// browers will redirect by the url if ajax finish
	public $redirect;

	public $field = 'status';

	public function init() 
	{
		parent::init();
	}
	
	public function run() 
	{
		return $this->render('toolstable/index', [
				'model'    => $this->model,
				'ajaxUrl'  => $this->ajaxUrl,
				'redirect' => $this->redirect,
				'field'    => $this->field
			]);
	}
}