<?php
 namespace frontend\controllers;

 use common\models\PaymentIncome;
 use common\models\search\PaymentIncomeSearch;
 use common\models\search\StudentSearch;
 use common\models\StudentCourses;
 use Yii;
 use common\models\Student;
 use yii\web\Controller;
 use yii\web\NotFoundHttpException;

 class StudentController extends Controller{

     public function actionIndex(){
         $searchModel = new StudentSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->query->orderBy(['last_name' => SORT_ASC]);
         if(Yii::$app->request->post()){
             $search = Yii::$app->request->post('search');
             $dataProvider->query->andFilterWhere([
                 'or',
                 ['like', 'first_name', $search],
                 ['like', 'last_name', $search],
                 ['like', 'middle_name', $search]
             ]);
         }

         return $this->render('index', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }

     public function actionRegister()
     {
        $model = new Student();
        if($model->load(Yii::$app->request->post())){
            $model->birth_date = strtotime($model->birth_date);
            $model->user_id = 1;
            $model->created_at = strtotime($model->created_at);
            $model->updated_at = time();
            $model->status = 0;

            if($model->save(false)){
                if(Yii::$app->request->post('course_payday')){
                    $new = new \common\models\StudentPayday();
                    $day = Yii::$app->request->post('course_payday');
                    $date = date($day.'-M-Y');
                    $new->next_payday = strtotime($date);
                    $new->first_pay = strtotime($date);
                    $new->created = time();
                    $new->student_id = $model->id;
                    $new->course_id = 0;
                    $new->summa = Yii::$app->request->post('course_summa');
                    if($new->save(false)){
                        $rec = new \common\models\FuturePayment();
                        $rec->summa = $new->summa;
                        $rec->created = time();
                        $rec->pay_date = $new->next_payday;
                        $rec->status = 0;
                        $rec->user_id = Yii::$app->user->id;
                        $rec->student_id = $model->id;
                        $rec->course_id = 0;
                        $rec->save(false);
                    }
                }

                if(Yii::$app->request->post('course1')){
                    $course = new StudentCourses();
                    $course->created = time();
                    $course->course_id = Yii::$app->request->post('course1');
                    $course->student_id = $model->id;
                    $course->save();
                    if(Yii::$app->request->post('course2')){
                        $course1 = new StudentCourses();

                        $course1->created = time();
                        $course1->course_id = Yii::$app->request->post('course2');
                        $course1->student_id = $model->id;
                        $course1->save();
                        if(Yii::$app->request->post('course3')){
                            $course2 = new StudentCourses();

                            $course2->created = time();
                            $course2->course_id = Yii::$app->request->post('course3');
                            $course2->student_id = $model->id;
                            $course2->save();
                            if(Yii::$app->request->post('course4')){
                                $course3 = new StudentCourses();

                                $course3->created = time();
                                $course3->course_id = Yii::$app->request->post('course4');
                                $course3->student_id = $model->id;
                                $course3->save();
                            }
                        }
                    }
                }

                Yii::$app->getSession()->setFlash('success', 'Студент зарегистрирован!');
                return $this->redirect(['student/view','id' => $model->id]);
            }

        }
         return $this->render('register',[
             'model' => $model,
         ]);
     }

     public function actionView($id){
         $pay = PaymentIncome::find()->where(['student_id' => $id])->limit(5)->all();
         $all = \common\models\StudentCourses::find()->where(['student_id' => $id])->all();
         $payday = \common\models\FuturePayment::find()->where(['student_id' => $id])->orderBy(['id' => SORT_DESC])->one();
         $course = new StudentCourses();

         if($course->load(Yii::$app->request->post())){
             $course->created = time();
             $course->student_id = $id;
             if($course->save()){
                 Yii::$app->getSession()->setFlash('success','Студент успешно добавлен в курс!');
                 return $this->refresh();
             }
         }

         return $this->render('view', [
             'model' => $this->findModel($id),
             'course' => $course,
             'all' => $all,
             'pay' => $pay,
             'payday' => $payday,
         ]);
     }

     public function actionPay($id){
         $new = new \common\models\StudentPayday();
         $payday = \common\models\FuturePayment::find()->where(['student_id' => $id])->orderBy(['id' => SORT_DESC])->one();

         if(Yii::$app->request->post('course_pay')){
             if(empty($payday)){
                 $day = Yii::$app->request->post('course_payday');
                 $date = date($day.'-M-Y');
                 $new->next_payday = strtotime($date);
                 $new->first_pay = strtotime($date);
                 $new->created = time();
                 $new->student_id = $id;
                 $new->course_id = Yii::$app->request->post('course_pay');
                 $new->summa = Yii::$app->request->post('course_summa');
                 if($new->save()){
                     $rec = new \common\models\FuturePayment();
                     $rec->summa = $new->summa;
                     $rec->created = time();
                     $rec->pay_date = $new->next_payday;
                     $rec->status = 0;
                     $rec->user_id = Yii::$app->user->id;
                     $rec->student_id = $id;
                     $rec->course_id = $new->course_id;
                     $rec->save();
                 }
                 return $this->redirect(['student/view','id' => $id]);

             }else{
                 $day = Yii::$app->request->post('course_payday');
                 $date = date($day.'-M-Y');
                 $payday->summa = Yii::$app->request->post('course_summa');
                 $payday->pay_date = strtotime($date);
                 $payday->update(false);
                 return $this->redirect(['student/view','id' => $id]);
             }
         }


     }

     public function actionStatus($status, $id)
     {
         $model = $this::findModel($id);
         if(!is_null($status)){
             $model->status = $status;
             $model->update();
         }
         return $this->render('view', [
             'model' => $model
         ]);
     }

     public function actionPayments($id){

         $searchModel = new PaymentIncomeSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->query->where(['student_id' => $id]);
         return $this->render('payments',[
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }

     public function actionUpdate($id)
     {
         $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post())) {

             $model->updated_at = time();
             $model->save();
             return $this->redirect(['view', 'id' => $model->id]);
         }

         return $this->render('update', [
             'model' => $model,
         ]);
     }

     public function actionDelete($id)
     {
         $model = $this->findModel($id);
         $course = StudentCourses::find()->where(['student_id' => $model->id])->all();
         foreach($course as $item){
             $item->delete();
         }
         $payment = \common\models\FuturePayment::find()->where(['student_id' => $model->id])->all();
         foreach($payment as $item){
             $item->delete();
         }
         $payday = \common\models\StudentPayday::find()->where(['student_id' => $model->id])->all();
         foreach($payday as $item){
             $item->delete();
         }
         $model->delete();

         if(Yii::$app->request->get('page')){
             return $this->redirect(['index','page' => Yii::$app->request->get('page')]);
         }else{
             return $this->redirect(['index']);
         }
     }
     public function actionCoursedelete($id)
     {
         $student = Yii::$app->request->get('student');
         $course = StudentCourses::find()->where(['id' => $id])->one();


         $course->delete();

         return $this->redirect(['view','id' => $student]);
     }



     protected function findModel($id)
     {
         if (($model = Student::findOne($id)) !== null) {
             return $model;
         }

         throw new NotFoundHttpException('The requested page does not exist.');
     }

 }