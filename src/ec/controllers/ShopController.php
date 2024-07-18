<?php

namespace app\controllers;
use Yii;
use app\models\Shop;
use app\models\ShopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Users;
use app\models\Follow;
use app\models\Products;
use yii\web\Uploadedfile;
use yii\web\Response;

/**
 * ShopController implements the CRUD actions for Shop model.
 */
class ShopController extends Controller
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
     * Lists all Shop models.
     *
     * @return string
     */
    public function actionIndex($status = null)
    {
        $this->layout = 'main2';
        $searchModel = new ShopSearch();
        
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
     * Displays a single Shop model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout='main2';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionVshop()
    {
        $this->layout = 'bussi_layout';
        $userId = Yii::$app->user->id; // Lấy ID của user đăng nhập hiện tại
        $shop = Shop::find()->where(['user_id' => $userId])->one(); // Truy vấn shop dựa trên user_id
    
        // Kiểm tra xem có shop nào tương ứng với user không
        if ($shop) {
            return $this->render('vshop', [
                'model' => $shop, // Sử dụng 'model' để phù hợp với tên biến trong view
            ]);
        } else {
            // Xử lý khi không tìm thấy shop
            return $this->redirect(['shop/index']); // Redirect đến trang shop/index hoặc trang khác nếu không tìm thấy shop
        }
    }
    


    /**
     * Creates a new Shop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Thiết lập layout sử dụng cho trang này là 'login2_layout'
        $this->layout = 'login2_layout';
    
        // Tạo một đối tượng model mới của class Shop
        $model = new Shop();
    
        // Kiểm tra nếu request là POST (tức là dữ liệu được gửi từ một form)
        if ($this->request->isPost) {
            // Load dữ liệu từ POST request vào model và kiểm tra nếu dữ liệu hợp lệ và lưu lại
            if ($model->load($this->request->post()) && $model->save()) {
                // Lấy file được upload từ form và gán vào thuộc tính 'file' của model (nếu có)
                $model->file = UploadedFile::getInstance($model, 'file');
                
                // Nếu có file được upload
                if ($model->file) {
                    // Đặt đường dẫn tới thư mục lưu trữ file upload
                    $uploadPath = Yii::getAlias('@webroot/images/');
                    
                    // Kiểm tra nếu thư mục lưu trữ chưa tồn tại thì tạo mới
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0777, true);
                    }
                    
                    // Tạo tên file duy nhất bằng cách kết hợp thời gian hiện tại và tên gốc của file
                    $fileName = time() . '_' . $model->file->baseName . '.' . $model->file->extension;
                    
                    // Đường dẫn đầy đủ tới file
                    $filePath = $uploadPath . $fileName;
                    
                    // Lưu file vào đường dẫn xác định
                    if ($model->file->saveAs($filePath)) {
                        // Gán đường dẫn của file được lưu vào thuộc tính 'shop_image' của model
                        $model->logo_shop = '/images/' . $fileName;
                        $model->business_license = '/images/' . $fileName;
                        // Lưu model mà không kiểm tra lại validation (lưu thay đổi về đường dẫn ảnh)
                        $model->save(false);
                    }
                   
                }
                
                // Chuyển hướng tới trang /site/mess sau khi tạo thành công
                return $this->redirect(['/site/mess']); 
            }
        } else {
            // Nếu không phải là POST request, load giá trị mặc định cho model
            $model->loadDefaultValues();
        }
    
        // Render view 'create' và truyền đối tượng model vào view
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    

    /**
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'main2';
        $model = $this->findModel($id);
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            if ($model->status == '2') {
                // Tìm đối tượng User dựa trên user_id của shop đó
                $user = Users::findOne($model->user_id);
                if ($user) {
                    // Đặt status của user thành 3
                    $user->role = 3;
                    // Lưu đối tượng user
                    if ($user->save()) {
                        Yii::$app->session->setFlash('success', 'Shop đã được duyệt và vai trò của User đã được cập nhật.');
                        
                        // Gửi email xác thực đến email của shop
                        Yii::$app->mailer->compose()
                            ->setTo($model->email) // Địa chỉ email của shop
                            ->setFrom(['khanhankhanhquy123@gmail.com' => 'Sellifly']) // Địa chỉ email gửi đi
                            ->setSubject('Thông báo đăng ký shop thành công')
                            ->setTextBody('Shop của bạn đã được duyệt, vui lòng truy cập Sellifly.vn để tiến hành kinh doanh trên sàn. Sellifly trân trọng cảm ơn !')
                            ->setHtmlBody('Shop của bạn đã được duyệt, vui lòng truy cập Sellifly.vn để tiến hành kinh doanh trên sàn. Sellifly trân trọng cảm ơn !</b>')
                            ->send();
                    } else {
                        // Ghi lại lỗi nếu lưu đối tượng User thất bại
                        $errors = implode(', ', $user->getErrorSummary(true));
                        Yii::$app->session->setFlash('error', "Shop đã được duyệt nhưng không thể cập nhật trạng thái của User: $errors");
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Không tìm thấy User tương ứng.');
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    /**
     * Deletes an existing Shop model.
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
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shop::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionViews($id)
    {
        $shop = Shop::findOne($id);
        $isFollowing = !Yii::$app->user->isGuest && $shop->isFollowing(Yii::$app->user->id);
        if ($shop === null) {
            throw new \yii\web\NotFoundHttpException('Shop không tồn tại.');
        }

        return $this->render('views', [
            'shop' => $shop,
            'isFollowing' => $isFollowing,
        ]);
    }
    public function actionUpdt($id)
    {
        $this->layout = 'bussi_layout';
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['vshop', 'id' => $model->id]);
        }

        return $this->render('updt', [
            'model' => $model,
        ]);
    }

    public function actionDelete1($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    public function actionFollow()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->user->id;
        $shopId = Yii::$app->request->post('id');

        if ($userId && $shopId) {
            $follow = new Follow();

            $follow->user_id = $userId;
            $follow->shop_id = $shopId;
            $follow->status= 1;
            $follow ->save();
            if ($follow->save()) {
                return ['status' => 'success'];
            } else {
                Yii::error('Follow save error: ' . json_encode($follow->errors));
                return ['status' => 'error', 'message' => 'Unable to save follow'];
            }
        } else {
            Yii::error('Invalid user or shop ID');
            return ['status' => 'error', 'message' => 'Invalid user or shop ID'];
        }
    }

    public function actionUnfollow()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $userId = Yii::$app->user->id;
        $shopId = Yii::$app->request->post('id');

        if ($userId && $shopId) {
            $follow = Follow::findOne(['user_id' => $userId, 'shop_id' => $shopId]);
            if ($follow && $follow->delete()) {
                return ['status' => 'success'];
            } else {
                Yii::error('Unfollow delete error: ' . json_encode($follow->errors));
                return ['status' => 'error', 'message' => 'Unable to delete follow'];
            }
        } else {
            Yii::error('Invalid user or shop ID');
            return ['status' => 'error', 'message' => 'Invalid user or shop ID'];
        }
    }

    public function actionDelay()
{
    $userId = Yii::$app->user->id;
    
    // Tìm shop của người dùng hiện tại
    $shop = Shop::findOne(['user_id' => $userId]);

    if ($shop) {
        // Cập nhật trạng thái của shop
        $shop->status = 0;
        $shop->save();

        // Cập nhật trạng thái của các sản phẩm thuộc shop
        Products::updateAll(['status' => 2], ['shop_id' => $shop->id]);
        
        // Thông báo cho người dùng
        Yii::$app->session->setFlash('success', 'Shop và các sản phẩm đã được tạm dừng.');
    } else {
        Yii::$app->session->setFlash('error', 'Không tìm thấy shop của bạn.');
    }

    return $this->redirect(['site/bussi']); // Điều hướng tới trang danh sách shop hoặc trang mong muốn
}

}
