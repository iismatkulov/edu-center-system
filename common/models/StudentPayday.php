<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_student_payday".
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property int $created
 * @property int $summa
 * @property int $next_payday
 */
class StudentPayday extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_student_payday';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id', 'summa', 'first_pay','created'], 'required'],
            [['student_id', 'course_id', 'summa', 'first_pay','created'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'course_id' => 'Course ID',
            'summa' => 'Summa',
            'next_payday' => 'Next Payday',
        ];
    }
}
