<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_report_detail".
 *
 * @property int $id
 * @property int $report_id
 * @property int $created
 * @property string $phone
 * @property string $message
 */
class ReportDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_report_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['report_id', 'created', 'phone', 'message'], 'required'],
            [['report_id', 'created'], 'integer'],
            [['phone', 'message'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_id' => 'Report ID',
            'created' => 'Дата добавления',
            'phone' => 'Номер отправителя',
            'message' => 'Текст сообщения',
        ];
    }
}
