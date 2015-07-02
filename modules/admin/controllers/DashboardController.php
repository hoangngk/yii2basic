<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}