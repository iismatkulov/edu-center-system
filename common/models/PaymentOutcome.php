<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_payment_outcome".
 *
 * @property int $id
 * @property int $summa
 * @property int $created
 * @property int $outlay_item
 * @property int $user_id
 * @property string $content
 * @property int $status
 */
class PaymentOutcome extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_payment_outcome';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summa', 'created', 'outlay_item', 'payment_method', 'user_id', 'content', 'status'], 'required'],
            [['summa', 'created', 'outlay_item', 'payment_method', 'user_id', 'status'], 'integer'],
            [['content'], 'string'],
        ];
    }
    public $stat_array = [
        0 => 'Активный',
        1 => 'Заблокированный',
    ];

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summa' => 'Сумма',
            'created' => 'Дата создания',
            'outlay_item' => 'Расход',
            'user_id' => 'Пользователь',
            'content' => 'Комментарий',
            'status' => 'Статус',
            'payment_method' => 'Способ оплаты',
        ];
    }
    public $method = [
        0 => 'Наличный',
        1 => 'Безналичный',
    ];

    public function getUser(){
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getOutlay(){
        return $this->hasOne(OutlayItem::className(), ['id' => 'outlay_item']);
    }

}
