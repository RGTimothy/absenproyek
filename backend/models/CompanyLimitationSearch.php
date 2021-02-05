<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyLimitation;

/**
 * backend\models\CompanyLimitationSearch represents the model behind the search form about `backend\models\CompanyLimitation`.
 */
 class CompanyLimitationSearch extends CompanyLimitation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'max_user', 'max_project', 'max_unrestricted_project', 'max_grade', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['max_subscription_time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = CompanyLimitation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'company_id' => $this->company_id,
            'max_user' => $this->max_user,
            'max_project' => $this->max_project,
            'max_unrestricted_project' => $this->max_unrestricted_project,
            'max_grade' => $this->max_grade,
            'max_subscription_time' => $this->max_subscription_time,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        return $dataProvider;
    }
}
