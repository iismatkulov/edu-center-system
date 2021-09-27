<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_student_courses".
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property int $created
 */
class StudentCourses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_student_courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'course_id', 'created'], 'required'],
            [['student_id', 'course_id', 'created'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Студент',
            'course_id' => 'Курс',
            'created' => 'Дата добавления',
        ];
    }
    public function getCourse(){
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
    public function getStudent(){
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

}
