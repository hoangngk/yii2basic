<?php

namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use Yii;

/**
 * This is the model class for table "company_users_info".
 *
 * @property integer $id
 * @property string $account_type
 * @property string $cost
 * @property integer $contract_type
 * @property string $term_start
 * @property string $term_end
 * @property integer $status
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 */
class CompanyUsersInfo extends \yii\db\ActiveRecord
{

    const ACCOUNT_TYPE_PROGRAM_MANAGER = 1;
    const ACCOUNT_TYPE_PROJECT_MANAGER = 2;
    const ACCOUNT_TYPE_PROJECT_MEMBER = 3;
    const ACCOUNT_TYPE_ORTHER = 4;

    const CONSTRACT_TYPE_PERMANENT = 1;
    const CONSTRACT_TYPE_CONTRACTED = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_users_info';
    }

    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'              => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contract_type', 'status', 'users_id'], 'integer'],
            [['term_start', 'term_end', 'created_at', 'updated_at'], 'safe'],
            [['account_type', 'cost'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'account_type' => Yii::t('app', 'Account Type'),
            'cost' => Yii::t('app', 'Cost'),
            'contract_type' => Yii::t('app', 'Contract Type'),
            'term_start' => Yii::t('app', 'Term Start'),
            'term_end' => Yii::t('app', 'Term End'),
            'status' => Yii::t('app', 'Status'),
            'users_id' => Yii::t('app', 'Users ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'users_id']);
    }
}
