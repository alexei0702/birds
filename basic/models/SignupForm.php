<?php
    namespace app\models;

    use yii\base\Model;
    use app\models\User;

    /**
     * Signup form
     */
    class SignupForm extends Model
    {
        public $username;
        public $email;
        public $password;
        public $description;
        public $group;
        public $status;


        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Логин уже занят.'],
                ['username', 'string', 'min' => 2, 'max' => 255],

                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Данный e-mail уже используется.'],

                ['password', 'required'],
                ['password', 'string', 'min' => 6],

                ['description', 'string', 'max' => 255],
                ['group', 'string', 'max' => 255],
                ['status', 'in', 'range' => [User::STATUS_ADMIN, User::STATUS_USER]]
            ];
        }

        public function attributeLabels() {
            return [
                'username' => 'Логин',
                'email' => 'E-mail',
                'password' => 'Пароль',
                'description' => 'Описание',
                'group' => 'Группа',
                'status' => 'Роль',
            ];
        }

        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         * @throws \yii\base\Exception
         */
        public function signup()
        {
            if (!$this->validate()) {
                return null;
            }

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->description = $this->description;
            $user->group_name = $this->group;
            $user->status = $this->status;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            return $user->save() ? $user : null;
        }
    }
