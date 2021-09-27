<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use common\models\User;

class PasswordForm extends Model
{
    public $oldpass;
    public $newpass;
    public $repeatnewpass;

    public function rules()
    {
        return [
            [['oldpass','newpass','repeatnewpass'],'required'],
            ['oldpass','findPasswords'],

            // ['newpass','string','min' => 6],
            ['repeatnewpass','compare','compareAttribute'=>'newpass'],

        ];
    }

    public function findPasswords($attribute, $params)
    {
        $user = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
        $password = $user->password_hash;
        if(!Yii::$app->security->validatePassword($this->oldpass, $password))
            $this->addError($attribute,'Old password is incorrect');
    }

    public function attributeLabels()
    {
        return [
            'oldpass'=>'Старый пароль',
            'newpass'=>'Новый пароль',
            'repeatnewpass'=>'Повторите новый пароль',
        ];
    }
}