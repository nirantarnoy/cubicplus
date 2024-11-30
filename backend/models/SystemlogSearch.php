<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Systemlog;

/**
 * SystemlogSearch represents the model behind the search form of `backend\models\Systemlog`.
 */
class SystemlogSearch extends Systemlog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'log_type_id', 'user_id', 'created_at', 'created_by', 'login_act_type'], 'integer'],
            [['trans_date', 'function_name', 'ipaddress', 'message'], 'safe'],
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
        $query = Systemlog::find();

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
           // 'log_type_id' => $this->log_type_id,
          //  'trans_date' => $this->trans_date,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'login_act_type' => $this->login_act_type,
        ]);

        if($this->trans_date != null){
            $exp = explode('-', $this->trans_date);
            $searchDate = date('Y-m-d');
            if($exp != null){
                if(count($exp) > 1){
                    $searchDate = $exp[2].'/'.$exp[1].'/'.$exp[0];
                }
            }
            $query->andFilterWhere(['=', 'date(trans_date)', date('Y-m-d',strtotime($searchDate))]);
        }

        if($this->log_type_id != 0){
            $query->andFilterWhere(['=', 'log_type_id', $this->log_type_id]);
        }

        $query->andFilterWhere(['like', 'function_name', $this->function_name])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
