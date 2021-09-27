<?php

namespace frontend\controllers;

use common\models\Course;
use common\models\search\CourseSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentincomeController implements the CRUD actions for PaymentIncome model.
 */
class CourseController extends Controller
{
    public function actionIndex(){
        if(Yii::$app->request->post()){
            $type = Yii::$app->request->post('type_id');
            $subject = Yii::$app->request->post('subject');
            $teacher = Yii::$app->request->post('teacher');
            $model = Course::find()->where(['subject_id' => $subject])->andWhere(['teacher_id' => $teacher])->orderBy(['start_time' => SORT_ASC])->all();
            $arr0 = [];
            foreach ($model as $item){
                $arr = array_push($arr0,$item->id);
            }
            $course = \common\models\StudentCourses::find()->where(['in','course_id',$arr0])->all();
        }else{
            $model = Course::find()->where(['id' => 0])->all();
            $course = \common\models\StudentCourses::find()->where(['id' => 0])->all();

        }

        return $this->render('index',[
            'model' => $model,
            'course' => $course
        ]);
    }
    public function actionType() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id =  $parents[0];
                $connection = Yii::$app->db;
                $sql = 'SELECT sub.id as id, sub.name as name from glc_subject sub where sub.type_id = '.$cat_id.' order by sub.id Desc';
                $out = $connection->createCommand($sql)->queryAll();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }
    public function actionCourse() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $sub_id =  $parents[1];
                $connection = Yii::$app->db;
                $sql = 'SELECT id as id, fullname as name FROM glc_teacher';
                $out = $connection->createCommand($sql)->queryAll();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    public function actionView($id){

        $model = Course::findOne($id);
        $all = \common\models\StudentCourses::find()->where(['course_id' => $id])->all();
        return $this->render('view',[
            'model' => $model,
            'all' => $all,
        ]);
    }
}
