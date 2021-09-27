<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_course".
 *
 * @property int $id
 * @property string $subject_id
 * @property string $lang
 * @property string $teacher_id
 * @property string $start_time
 * @property int $summa
 * @property int $status
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'lang', 'teacher_id', 'start_time', 'summa', 'status'], 'required'],
            [['summa', 'subject_id', 'teacher_id', 'status'], 'integer'],
            [['lang', 'start_time'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $stat_array = [
        0 => 'Активный',
        1 => 'Деактивированный',
    ];

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => 'Название',
            'lang' => 'Язык преподавания',
            'teacher_id' => 'Ф.И.О. Учителя',
            'start_time' => 'Время начала',
            'summa' => 'Цена',
            'status' => 'Статус',
        ];
    }
    public function getSubject(){
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
    public function getTeacher(){
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
    public function getName(){
        return $this->subject->name.' ('.$this->teacher->fullname.') - '.$this->start_time;
    }

}
