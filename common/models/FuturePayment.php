<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_future_payment".
 *
 * @property int $id
 * @property int $summa
 * @property int $user_id
 * @property int $created
 * @property int $student_id
 * @property int $course_id
 * @property int $status
 */
class FuturePayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_future_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summa', 'user_id', 'created', 'student_id', 'course_id', 'status', 'pay_date'], 'required'],
            [['summa', 'user_id', 'created', 'student_id', 'course_id', 'status', 'pay_date'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summa' => 'Сумма',
            'user_id' => 'Пользователь',
            'created' => 'Дата создания',
            'student_id' => 'Студент',
            'course_id' => 'Курс',
            'status' => 'Статус',
            'pay_date' => 'День оплаты',
        ];
    }
    public $stat_array = [
        0 => 'Полная оплата',
        1 => 'Частичная',
        2 => 'Долг',
    ];

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getStudent(){
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
    public function getCourse(){
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

}
