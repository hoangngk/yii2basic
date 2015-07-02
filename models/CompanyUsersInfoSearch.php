<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompanyUsersInfo;

/**
 * CompanyUsersInfoSearch represents the model behind the search form about `app\models\CompanyUsersInfo`.
 */
class CompanyUsersInfoSearch extends CompanyUsersInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contract_type', 'status', 'users_id'], 'integer'],
            [['account_type', 'cost', 'term_start', 'term_end', 'created_at', 'updated_at'], 'safe'],
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
        $query = CompanyUsersInfo::find();

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
            'contract_type' => $this->contract_type,
            'term_start' => $this->term_start,
            'term_end' => $this->term_end,
            'status' => $this->status,
            'users_id' => $this->users_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'account_type', $this->account_type])
            ->andFilterWhere(['like', 'cost', $this->cost]);

        return $dataProvider;
    }
}
