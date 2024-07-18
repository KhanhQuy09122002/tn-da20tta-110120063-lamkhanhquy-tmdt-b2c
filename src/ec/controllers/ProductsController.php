<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Categories;
use yii\web\Response;
use app\models\ProductAttributes;
use app\models\Model;
use Yii;
/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout='bussi_layout';
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $product_id Product ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id)
    {
        $this->layout='bussi_layout';
        return $this->render('view', [
            'model' => $this->findModel($product_id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout='bussi_layout';
        $model = new Products();
        $attributes = [new ProductAttributes()];
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $attributes = Model::createMultiple(ProductAttributes::classname());
            Model::loadMultiple($attributes, Yii::$app->request->post());
    
            foreach ($attributes as $attribute) {
                $attribute->product_id = $model->product_id;
                $attribute->save();
            }
    
            return $this->redirect(['view', 'id' => $model->product_id]);
        }
    
        return $this->render('create', [
            'model' => $model,
            'attributes' => (empty($attributes)) ? [new ProductAttributes()] : $attributes
        ]);
    }
    

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $product_id Product ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id)
    {
        $this->layout='bussi_layout';
        $model = $this->findModel($product_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $product_id Product ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id)
    {
        $this->layout='bussi_layout';
        $this->findModel($product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $product_id Product ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id)
    {
        if (($model = Products::findOne(['product_id' => $product_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetCategoryByProductName($productName)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $category = Categories::find()
            ->joinWith('products') // Giả sử có quan hệ giữa sản phẩm và danh mục
            ->where(['like', 'products.product_name', $productName])
            ->one();
        
        if ($category) {
            return ['id' => $category->id, 'cate_name' => $category->cate_name];
        }

        return null;
    }
}
