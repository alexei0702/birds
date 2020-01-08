<?php

    namespace app\models;

    use Yii;
    use yii\base\NotSupportedException;
    use yii\behaviors\TimestampBehavior;
    use yii\db\ActiveRecord;
    use yii\web\IdentityInterface;

    /**
     * User model
     *
     * @property integer $id
     * @property string $username
     * @property string $password_hash
     * @property string $email
     * @property string $auth_key
     * @property integer $status
     * @property integer $created_at
     * @property integer $updated_at
     * @property string $password write-only password
     */

    class User extends ActiveRecord implements IdentityInterface
    {
        const STATUS_ADMIN = 2;
        const STATUS_USER = 1;


        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'user';
        }

        /**
         * @inheritdoc
         */
        public function behaviors()
        {
            return [
                TimestampBehavior::className(),
            ];
        }

        public function attributeLabels()
        {
            return [
                'password' => 'Пароль',
            ];
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                ['status', 'default', 'value' => self::STATUS_USER],
                ['status', 'in', 'range' => [self::STATUS_ADMIN, self::STATUS_USER]],
                ['description', 'default', 'value' => ''],
                ['group_name', 'default', 'value' => ''],
            ];
        }

        /**
         * @inheritdoc
         */
        public static function findIdentity($id)
        {
            return static::findOne(['id' => $id]);
        }

        /**
         * @inheritdoc
         */
        public static function findIdentityByAccessToken($token, $type = null)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username)
        {
            return static::findOne(['username' => $username]);
        }

        /**
         * Finds user by password reset token
         *
         * @param string $token password reset token
         * @return static|null
         */
        public static function findByPasswordResetToken($token)
        {
        }

        /**
         * Finds out if password reset token is valid
         *
         * @param string $token password reset token
         * @return bool
         */
        public static function isPasswordResetTokenValid($token)
        {
        }

        /**
         * @inheritdoc
         */
        public function getId()
        {
            return $this->getPrimaryKey();
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
        public function validateAuthKey($authKey)
        {
            return $this->getAuthKey() === $authKey;
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return bool if password provided is valid for current user
         */
        public function validatePassword($password)
        {
            return Yii::$app->security->validatePassword($password, $this->password_hash);
        }

        /**
         * Generates password hash from password and sets it to the model
         *
         * @param string $password
         * @throws \yii\base\Exception
         */
        public function setPassword($password)
        {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        }

        public function getPassword()
        {
            return $this->password_hash;
        }

        /**
         * Generates "remember me" authentication key
         */
        public function generateAuthKey()
        {
            $this->auth_key = Yii::$app->security->generateRandomString();
        }

        /**
         * Generates new password reset token
         */
        public function generatePasswordResetToken()
        {
        }

        /**
         * Removes password reset token
         */
        public function removePasswordResetToken()
        {
        }

        /**
         * Generates username authentication key
         */
        public function generateUsername()
        {
            $this->username = Yii::$app->security->generateRandomString(6) . '_' . time();
        }
    }



