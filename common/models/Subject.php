<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "glc_subject".
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'glc_subject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type_id' => 'Тип предмета',
        ];
    }
    public function getType(){
        return $this->hasOne(CourseType::className(), ['id' => 'type_id']);
    }

}
