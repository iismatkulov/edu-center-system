<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_student".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $address
 * @property int $birth_date
 * @property string $main_phone_number
 * @property string $study_place
 * @property string $mother_fullname
 * @property string $mother_phone_number
 * @property string $father_fullname
 * @property string $father_phone_number
 * @property int $created_at
 * @property int $updated_at
 * @property int $status
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name', 'middle_name', 'address', 'birth_date', 'main_phone_number', 'study_place', 'mother_fullname', 'mother_phone_number', 'father_fullname', 'father_phone_number', 'created_at', 'updated_at', 'status'], 'required'],
            [['user_id', 'birth_date', 'created_at', 'updated_at', 'status'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'address', 'main_phone_number', 'study_place', 'mother_fullname', 'mother_phone_number', 'father_fullname', 'father_phone_number'], 'string', 'max' => 256],
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
            'user_id' => 'Создатель',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'address' => 'Адрес',
            'birth_date' => 'Дата рождения',
            'main_phone_number' => 'Номер телефона',
            'study_place' => 'Место учёбы',
            'mother_fullname' => 'Ф.И.О. Мамы',
            'mother_phone_number' => 'Номер телефона Мамы',
            'father_fullname' => 'Ф.И.О. Папы',
            'father_phone_number' => 'Номер телефона Папы',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'status' => 'Статус студента',
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getPayment(){
        return $this->hasOne(FuturePayment::className(), ['student_id' => 'id']);
    }
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name.' '.$this->middle_name;
    }
}
