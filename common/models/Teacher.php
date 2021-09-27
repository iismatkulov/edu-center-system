<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_teacher".
 *
 * @property int $id
 * @property string $fullname
 * @property string $phone_number
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'phone_number'], 'required'],
            [['fullname', 'phone_number'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Ф.И.О. Учителя',
            'phone_number' => 'Номер телефона',
        ];
    }
}
