<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyProjectAttendance;

/**
 * CompanyProjectAttendanceSearch represents the model behind the search form of `backend\models\CompanyProjectAttendance`.
 */
class CompanyProjectAttendanceSearch extends CompanyProjectAttendance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_project_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['status', 'image', 'image_filename', 'image_filetype', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = CompanyProjectAttendance::find();

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
            'company_project_id' => $this->company_project_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_filename', $this->image_filename])
            ->andFilterWhere(['like', 'image_filetype', $this->image_filetype]);

        return $dataProvider;
    }
}
