<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_payment_income".
 *
 * @property int $id
 * @property int $summa
 * @property int $created
 * @property int $user_id
 * @property string $content
 * @property int $student_id
 * @property int $status
 */
class PaymentIncome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_payment_income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summa', 'created', 'user_id', 'content','payment_method', 'student_id', 'status'], 'required'],
            [['summa', 'created', 'user_id', 'student_id', 'payment_method','status'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public $stat_array = [
        0 => 'Активный',
        1 => 'Заблокированный',
    ];
    public $method = [
        0 => 'Наличный',
        1 => 'Безналичный',
    ];

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summa' => 'Сумма',
            'created' => 'Дата создания',
            'user_id' => 'Пользователь',
            'content' => 'Комментарий',
            'student_id' => 'Студент',
            'status' => 'Статус',
            'payment_method' => 'Способ оплаты',
        ];
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getStudent(){
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }


}
