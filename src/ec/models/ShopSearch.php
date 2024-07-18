<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shop;

/**
 * ShopSearch represents the model behind the search form of `app\models\Shop`.
 */
class ShopSearch extends Shop
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'business_type', 'sm_id', 'user_id', 'status'], 'integer'],
            [['shop_name', 'logo_shop', 'des_shop', 'address_shop', 'email', 'phone', 'tax_id', 'business_license'], 'safe'],
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
        $query = Shop::find();

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
            'business_type' => $this->business_type,
            'sm_id' => $this->sm_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'shop_name', $this->shop_name])
            ->andFilterWhere(['like', 'logo_shop', $this->logo_shop])
            ->andFilterWhere(['like', 'des_shop', $this->des_shop])
            ->andFilterWhere(['like', 'address_shop', $this->address_shop])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'tax_id', $this->tax_id])
            ->andFilterWhere(['like', 'business_license', $this->business_license]);

        return $dataProvider;
    }
}
