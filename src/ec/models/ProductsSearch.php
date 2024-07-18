<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public $shop_id;
    public function rules()
    {
        return [
            [['product_id', 'shop_id'], 'integer'],
            [['product_code', 'product_name', 'product_price', 'product_image'], 'safe'],
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
        $query = Products::find();

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
            'product_id' => $this->product_id,
            'shop_id' => $this->shop_id,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
              ->andFilterWhere(['like', 'product_name', $this->product_name])
              ->andFilterWhere(['like', 'product_price', $this->product_price])
              ->andFilterWhere(['like', 'product_image', $this->product_image]);

        return $dataProvider;
    }
}
