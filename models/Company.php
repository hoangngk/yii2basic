<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $email
 * @property string $fax
 * @property string $phone
 * @property string $logo
 * @property integer $status
 * @property integer $users_id
 * @property string $created_at
 * @property string $updated_at
 */
class Company extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'alias',
                'ensureUnique' => true
            ],
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
            [['name', 'email', 'address1', 'users_id'], 'required'],
            [['email'], 'email'],
            [['email', 'name'], 'unique'],
            [['status', 'users_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'alias', 'address1', 'address2', 'email', 'fax', 'phone', 'logo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'email' => Yii::t('app', 'Email'),
            'fax' => Yii::t('app', 'Fax'),
            'phone' => Yii::t('app', 'Phone'),
            'logo' => Yii::t('app', 'Logo'),
            'status' => Yii::t('app', 'Status'),
            'users_id' => Yii::t('app', 'Users ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * set something before save db
     * @param  mixed $insert
     * @return mixed
     */
    public function beforeSave($insert) 
    {
        // save logo
        $image = UploadedFile::getInstance($this, 'logo');
        if (isset($image))
        {
            $ext = end((explode(".", $image->name)));
            // generate a unique file name
            $this->logo = Yii::$app->security->generateRandomString().".{$ext}";
            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            if (!is_dir(Yii::$app->params['uploadLogoPath'])) {
                mkdir(Yii::$app->params['uploadLogoPath']);
            }
            $path = Yii::$app->params['uploadLogoPath'] . $this->logo;
            $image->saveAs($path);
        }
        // in the editing case, if company doesn't change logo, then set it with old logo
        else if (!empty($this->oldAttributes) && !empty($this->oldAttributes['logo']))
        {
            $this->logo = $this->oldAttributes['logo'];
        }

        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        $path = Yii::$app->params['uploadLogoPath'] . $this->logo;
        if (file_exists($path)) {
            unlink($path);
        }
        return parent::beforeDelete();
    }
}
