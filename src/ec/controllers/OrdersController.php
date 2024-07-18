<?php

namespace app\controllers;

use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii;
/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
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
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex($status=null)
    {
        $this-> layout='main2';
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      

         // Nếu có trạng thái được chọn, áp dụng điều kiện lọc
         if ($status !== null) {
            $searchModel->status = $status;
        }
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this-> layout='main2';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this-> layout='main2';
        $model = new Orders();

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
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this-> layout='main2';
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCancelOrder($id)
{
    Yii::info('Cancel order action called with ID: ' . $id);

    // Tìm đơn hàng theo ID
    $order = Orders::findOne($id);

    // Kiểm tra xem đơn hàng có tồn tại không
    if ($order) {
        // Cập nhật trạng thái đơn hàng thành 2 (Hủy)
        $order->status = 2;

        // Lưu thay đổi vào cơ sở dữ liệu
        if ($order->save()) {
            Yii::info('Order status updated to cancelled for order ID: ' . $id);

            // Cộng lại số lượng sản phẩm vào cơ sở dữ liệu
            foreach ($order->orderDetails as $detail) {
                $product = $detail->product;
                $product->product_quantity += $detail->quantity;
                Yii::info('Product quantity updated for product ID: ' . $product->product_id . '. New quantity: ' . $product->product_quantity);
                // Lưu thay đổi vào cơ sở dữ liệu
                $product->save();
            }

            // Điều hướng người dùng đến trang hiển thị đơn hàng hoặc trang danh sách đơn hàng
            Yii::$app->session->setFlash('success', 'Hủy đơn hàng thành công!');
            return $this->redirect(['updateod', 'id' => $order->id]);
        } else {
            // Xử lý lỗi khi lưu trạng thái đơn hàng
            Yii::error('Failed to update order status.');
        }
    }

    // Xử lý trường hợp đơn hàng không tồn tại
    Yii::warning('Order not found.');

    // Điều hướng người dùng đến trang danh sách đơn hàng hoặc trang khác tùy bạn
    return $this->redirect(['site/index']);
}   
public function actionUpdateod($status = null)
{
    // Kiểm tra đăng nhập
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    // Lấy ID người dùng đăng nhập
    $userId = Yii::$app->user->id;

    // Tạo truy vấn lấy danh sách đơn hàng của người dùng
    $query = Orders::find()->where(['user_id' => $userId]);

    // Nếu có trạng thái đơn hàng thì thêm điều kiện vào truy vấn
    if ($status !== null) {
        $query->andWhere(['status' => $status]);
    }
    // Tạo đối tượng phân trang
    $pagination = new Pagination([
        'defaultPageSize' => 2, // Số lượng sản phẩm trên mỗi trang
        'totalCount' => $query->count(),
    ]);

    // Áp dụng phân trang vào truy vấn sản phẩm
    $orders = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();
    // Lấy danh sách đơn hàng
   // $orders = $query->all();

    // Hiển thị trang với thông tin đơn hàng
    return $this->render('updateod', [
        'orders' => $orders,
        'status' => $status, // Truyền biến status để sử dụng trong view
        'pagination' => $pagination,
    ]);
}
}
