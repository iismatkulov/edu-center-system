<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Student;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'birth_date', 'created_at', 'updated_at', 'status'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'address', 'main_phone_number', 'study_place', 'mother_fullname', 'mother_phone_number', 'father_fullname', 'father_phone_number'], 'safe'],
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
        $query = Student::find();

        // add conditions that should always apply here

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
            'user_id' => $this->user_id,
            'birth_date' => $this->birth_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'main_phone_number', $this->main_phone_number])
            ->andFilterWhere(['like', 'study_place', $this->study_place])
            ->andFilterWhere(['like', 'mother_fullname', $this->mother_fullname])
            ->andFilterWhere(['like', 'mother_phone_number', $this->mother_phone_number])
            ->andFilterWhere(['like', 'father_fullname', $this->father_fullname])
            ->andFilterWhere(['like', 'father_phone_number', $this->father_phone_number]);

        return $dataProvider;
    }
}
