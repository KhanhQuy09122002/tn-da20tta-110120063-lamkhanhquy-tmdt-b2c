<?php

namespace app\controllers;
use Yii;
use app\models\ShopOrders;
use app\models\ShopOrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\shop;
use yii\data\ActiveDataProvider;
use app\models\ShopOrderDetails;
use app\models\Orders;
/**
 * ShopOrdersController implements the CRUD actions for ShopOrders model.
 */
class ShopOrdersController extends Controller
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
     * Lists all ShopOrders models.
     *
     * @return string
     */
    public function actionIndex($status = null)
{
    $this->layout = 'bussi_layout';
    
    // Lấy shop_id của người dùng hiện tại
    $userId = Yii::$app->user->id;
    $shop = Shop::find()->where(['user_id' => $userId])->one(); // Truy vấn shop dựa trên user_id
    // Tạo query để lấy danh sách đơn hàng của shop cụ thể
    $query = ShopOrders::find()->where(['shop_id' => $shop]);
    
    // Lọc theo trạng thái nếu được chỉ định
    if ($status !== null) {
        $query->andWhere(['status' => $status]);
    }

    // Tạo DataProvider để cung cấp dữ liệu cho GridView
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    // Khởi tạo một instance của ShopOrdersSearch để sử dụng làm $searchModel
    $searchModel = new ShopOrdersSearch();

    // Truyền dữ liệu xuống view 'index'
    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}

    /**
     * Displays a single ShopOrders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'bussi_layout';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShopOrders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = 'bussi_layout';
        $model = new ShopOrders();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ShopOrders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'bussi_layout';
        $model = $this->findModel($id);
    
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            // Lấy order_id từ model hiện tại
            $orderId = $model->order_id;
    
            // Tìm Orders liên quan đến ShopOrders hiện tại
            $order = Orders::findOne($orderId);
    
            if ($order) {
                // Tìm tất cả các ShopOrders liên quan đến Orders này
                $shopOrders = ShopOrders::findAll(['order_id' => $orderId]);
    
                // Kiểm tra trạng thái của tất cả các ShopOrders
                $allApproved = true;
                foreach ($shopOrders as $shopOrder) {
                    if ($shopOrder->status != 3) {
                        $allApproved = false;
                        break;
                    }
                }
    
                if ($allApproved) {
                    $order->status = 3;
                    $order->save(false); 
                }
            }
    
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    

    /**
     * Deletes an existing ShopOrders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ShopOrders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ShopOrders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopOrders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    // Trong ShopOrdersController
public function actionShopOrderDetails($id)
{
    $orderDetails = ShopOrderDetails::find()->where(['shop_order_id' => $id])->all();

    return $this->renderPartial('_order_details', [
        'orderDetails' => $orderDetails,
    ]);
}

}
