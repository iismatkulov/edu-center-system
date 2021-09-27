<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_outlay_item".
 *
 * @property int $id
 * @property int $outlay_id
 * @property int $name
 */
class OutlayItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_outlay_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['outlay_id', 'name'], 'required'],
            [['outlay_id'], 'integer'],
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'outlay_id' => 'Категория расхода',
            'name' => 'Название',
        ];
    }
}
