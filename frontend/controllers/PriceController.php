<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class PriceController extends Controller
{

    public function actionSelect($id){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return \common\models\Course::findOne($id);
    }


}

?>