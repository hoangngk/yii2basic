<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Company;
use app\models\Group;

class QtTableController extends Controller
{

    public function actionIndex($action = '')
    {
        $post = Yii::$app->request->post();
        if (!empty($post) && !empty($post['model'])) {
            switch ($action) {
                case 'active':
                    $model = $this->_getModel($post['model']);
                    $this->_active($post, $model);
                    break;
                
                case 'inactive':
                    $model = $this->_getModel($post['model']);
                    $this->_inactive($post, $model);
                    break;
                case 'delete':
                    $model = $this->_getModel($post['model']);
                    $this->_delete($post, $model);
                    break;

                default:
                   
                    break;
            }
        }
        // return $this->redirect('/admin');
    }
    /**
     * active action
     * @param  array $data  posted value
     * @param  string $model
     */
    private function _active($data, $model)
    {
        $field = $data['field'];
        $objs = $model::find()
                    ->where([
                        'id' => $data['item'], 
                        $field => $model::STATUS_INACTIVE
                    ])
                    ->all();
        // change status or active (if user model) field to 'active'
        if (!empty($objs)) {
            foreach ($objs as $key => $obj) {
                $obj->{$field} = 1;
                if (!$obj->save()) {
                     echo json_encode(['data' => '', 'message' => 'Something is wrong']);
                    return;
                }
            }
        }
        echo json_encode(['data' => '', 'message' => '']);
        return;
    }
    /**
     * inactive action
     * @param  array $data  posted value
     * @param  string $model
     */
    private function _inactive($data, $model)
    {
        $field = $data['field'];
        $objs = $model::find()
                    ->where([
                        'id' => $data['item'], 
                        $field => $model::STATUS_ACTIVE
                    ])
                    ->all();
        // change status or active (if user model) field to 'active'
        if (!empty($objs)) {
            foreach ($objs as $key => $obj) {
                $obj->{$field} = 0;
                if (!$obj->save()) {
                    echo json_encode(['data' => '', 'message' => 'Something is wrong']);
                    return;
                }
            }
        }
        echo json_encode(['data' => '', 'message' => '']);
        return;
    }
    /**
     * delete action
     * @param  array $data  posted value
     * @param  string $model
     */
    private function _delete($data, $model)
    {
        $model::deleteAll(['id' => $data['item']]);
        echo json_encode(['data' => '', 'message' => '']);
        return;
    }

    private function _getModel($name)
    {
        $model = NULL;
        switch (ucfirst($name)) {
            case 'User':
                $model = new User();
                break;
            case 'Company':
                $model = new Company();
                break;
            case 'Group':
                $model = new Group();
                break;

            default:
                break;
        }

        return $model;
    }
}
