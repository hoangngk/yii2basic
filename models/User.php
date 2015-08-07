<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $username
 * @property string $lastname
 * @property string $firstname
 * @property string $email
 * @property string $password
 * @property string $token
 * @property string $auth_key
 * @property integer $active
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    
    public $fullname;
    public $repassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
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
            [['username', 'email', 'password'], 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'lastname', 'firstname', 'email', 'password', 'token', 'auth_key'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app', 'ID'),
            'username'   => Yii::t('app', 'Username'),
            'lastname'   => Yii::t('app', 'Lastname'),
            'firstname'  => Yii::t('app', 'Firstname'),
            'email'      => Yii::t('app', 'Email'),
            'password'   => Yii::t('app', 'Password'),
            'token'      => Yii::t('app', 'Token'),
            'auth_key'   => Yii::t('app', 'Auth Key'),
            'active'     => Yii::t('app', 'Active'),
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
         // encode password
        if ($this->isNewRecord || $this->password != $this->oldAttributes['password'])
            $this->setPassword($this->password);
        // making token
        $this->setToken();
        // set auth_key 
        $this->setAuthKey();

        // save avatar
        $image = UploadedFile::getInstance($this, 'avatar');
        if (isset($image))
        {
            $ext = end((explode(".", $image->name)));
            // generate a unique file name
            $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";
            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            if (!is_dir(Yii::$app->params['uploadAvatarPath'])) {
                mkdir(Yii::$app->params['uploadAvatarPath']);
            }
            $path = Yii::$app->params['uploadAvatarPath'] . $this->avatar;
            $image->saveAs($path);
        }
        // in the editing case, if user doesn't change avatar, then set it with old avatar
        else if (!empty($this->oldAttributes) && !empty($this->oldAttributes['avatar']))
        {
            $this->avatar = $this->oldAttributes['avatar'];
        }

        return parent::beforeSave($insert);
    }

    public function beforeDelete()
    {
        $path = Yii::$app->params['uploadAvatarPath'] . $this->avatar;
        if (file_exists($path)) {
            unlink($path);
        }
        return parent::beforeDelete();
    }

    public function afterFind()
    {
        $this->repassword = $this->password;
        $this->fullname = $this->getFullName();
        return parent::afterFind();
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = \Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    /**
     * generates token 
     */
    public function setToken()
    {
        $this->token = Yii::$app->security->generateRandomString();
    }

    /**
     * generates auth_key
     */
    public function setAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) 
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * set full name of particular user
     * @param  integer $id
     * @return string
     */
    public function getFullName() 
    {
        return $this->firstname . ' ' . $this->lastname;
    }

}
