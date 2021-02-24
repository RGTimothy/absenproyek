<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CompanyProjectAttendanceSummary;

/**
 * backend\models\CompanyProjectAttendanceSummarySearch represents the model behind the search form about `backend\models\CompanyProjectAttendanceSummary`.
 */
 class CompanyProjectAttendanceSummarySearch extends CompanyProjectAttendanceSummary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'company_role_id', 'work_duration', 'overtime_duration_1', 'overtime_duration_2', 'overtime_duration_3', 'total_allowance', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['projects', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = CompanyProjectAttendanceSummary::find();

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
            'user_id' => $this->user_id,
            'company_role_id' => $this->company_role_id,
            'work_duration' => $this->work_duration,
            'overtime_duration_1' => $this->overtime_duration_1,
            'overtime_duration_2' => $this->overtime_duration_2,
            'overtime_duration_3' => $this->overtime_duration_3,
            'total_allowance' => $this->total_allowance,
            // 'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'projects', $this->projects]);
        // $query->andFilterWhere(['like', 'created_at', $this->created_at]);

        //change query builder's logic because the filter now using date range picker
        $rangeDate = explode(' - ', $this->created_at);
        $startDate = $rangeDate[0];
        $endDate = $rangeDate[1];
        $query->andFilterWhere(['>=', 'DATE(created_at)', $startDate]);
        $query->andFilterWhere(['<=', 'DATE(created_at)', $endDate]);

        return $dataProvider;
    }
}
