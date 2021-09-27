<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FuturePayment;

/**
 * FuturePaymentSearch represents the model behind the search form of `common\models\FuturePayment`.
 */
class FuturePaymentSearch extends FuturePayment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'summa', 'user_id', 'created', 'course_id', 'status'], 'integer'],
            [['student_id'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FuturePayment::find();

        // add conditions that should always apply here
        $query->joinWith('student');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'summa' => $this->summa,
            'user_id' => $this->user_id,
            'created' => $this->created,
            'course_id' => $this->course_id,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'CONCAT(glc_student.first_name, glc_student.last_name, glc_student.middle_name)', $this->student_id]);

        return $dataProvider;
    }
}
