<?php

namespace backend\controllers;

use yii;
use yii\web\Controller;
use backend\models\PasswordForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;

class UserController extends Controller
{
    public $accessRole = '@';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','changepassword'],
                        'allow' => true,
                        'roles' => [$this->accessRole],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    public function actionChangepassword()
    {
        $model = new PasswordForm;
        $modeluser = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();

        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                try
                {
                    $modeluser->password_hash = Yii::$app->security->generatePasswordHash($_POST['PasswordForm']['newpass']);
                    if($modeluser->save())
                    {
                        Yii::$app->getSession()->setFlash(
                            'success','Пароль успешно изменён!'
                        );
                        return $this->redirect(['site/index']);
                    }
                    else
                    {
                        Yii::$app->getSession()->setFlash(
                            'error','Ошибка в изменении пароля!'
                        );
                        return $this->redirect(['site/index']);
                    }
                }
                catch(Exception $e)
                {
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }
            else
            {
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }
        else
        {
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }
}
