<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_sms_report".
 *
 * @property int $id
 * @property int $created
 * @property int $method
 * @property int $count
 */
class SmsReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_sms_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'method', 'count'], 'required'],
            [['created', 'method', 'count'], 'integer'],
        ];
    }
    public $arr = [
        0 => 'Задолженность',
        1 => 'Оплаты на сегодня',
        2 => 'Оплаты через 2 дня',
        3 => 'Просроченные',
        4 => 'Тест',
    ];
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Дата создания',
            'method' => 'Тип',
            'count' => 'Количество',
        ];
    }
}
