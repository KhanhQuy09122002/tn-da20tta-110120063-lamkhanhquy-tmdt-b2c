<?php

namespace app\controllers;
use yii\data\ArrayDataProvider;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Account;
use app\models\Categories;
use yii\data\Pagination;
use app\models\Products;
use app\models\Comments;
use app\models\Shop;
use app\models\Orders;
use yii\web\NotFoundHttpException;
use app\models\Voucher;
use yii\base\Exception;
use app\models\ShopOrders;
use app\models\ShopOrderDetails;
use app\models\Follow;
use app\models\OrderDetail;
use app\models\ProductAttributes;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
         // Lấy dữ liệu sản phẩm từ cơ sở dữ liệu
         $products = Products::find()->all();
         $followedShops = Follow::find()->where(['user_id' => Yii::$app->user->id])->select('shop_id')->column();
         $productsForYou = Products::find()->where(['shop_id' => $followedShops])->all();

         // Lấy dữ liệu sản phẩm với phân trang
         $query = Products::find();
     
         $pagination = new Pagination([
             'defaultPageSize' => 16, // Số sản phẩm hiển thị trên mỗi trang
             'totalCount' => $query->count(),
         ]);
   
 
         $products = $query->offset($pagination->offset)
             ->limit($pagination->limit)
             ->all();
     //test
     //test
     $categories = Categories::find()->where(['p_id' => null])->all();

     // Lọc sản phẩm theo danh mục được chọn nếu có
     $categoryId = Yii::$app->request->get('category');
     $productsQuery = Products::find();
     if ($categoryId) {
         $productsQuery->andWhere(['cate_id' => $categoryId]);
     }
     
     $product = $productsQuery->all(); // Lấy danh sách sản phẩm
      
    
         return $this->render('index', [
             'products' => $products, // Truyền danh sách sản phẩm vào view
             'pagination' => $pagination,
             'categories' => $categories,
             'product' =>$product,
             'followedShops'=>$followedShops,
             'productsForYou'=>$productsForYou,
         ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
      $this->layout='login2_layout';
      if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        $user = Yii::$app->user->getIdentity();
        Yii::$app->session->set('latestLoginId', Yii::$app->user->id);

        $role = $user->role;

        if ($role == 0) {
         
           
            return $this->redirect(['/site/home']);
            
        }
        if ($role == 3) {
         
           
            return $this->redirect(['/site/bussi']);
            
        }
         else 
        {
          
            return $this->goHome();
        }
    }

    $model->password = '';
    return $this->render('login', [
        'model' => $model,
    ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionRegister()
  {
   $this->layout='login_layout';

      //$this->layout = 0;
      $post = Yii::$app->request->post();
      $user = new Account();
      if ($user->idLogged()) {
          return $this->goHome();
          
      }
     
      if(isset($post['register']) && $post['register'] == 1){
          $this->layout = 0;
          $users = new Account();
          $users->beforeSaveUser($post['Users']);
          $users->validate();
          $users->save();
          Yii::$app->session->setFlash('success', 'Đăng ký thành công!');
          return $this->redirect('login');
          
      }
      return $this->render('register');
  }

  public function actionDetail($id)
  {
      // Tìm sản phẩm dựa trên ID
      $product = Products::findOne($id);
      $newComment = new Comments();
       
      // Truy vấn bình luận
      $query = Comments::find()->where(['product_id' => $id])->orderBy(['created_at' => SORT_DESC]);
      
      $pagination = new Pagination([
          'defaultPageSize' => 5, // Số lượng bình luận hiển thị trên mỗi trang
          'totalCount' => $query->count(),
      ]);
       
      $comments = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();
  
     // Lấy các thuộc tính sản phẩm của sản phẩm này
     $productAttributes = $product->productAttributes;
                       
      
      return $this->render('detail', [
          'product' => $product,
          'newComment' => $newComment,
          'comments' => $comments,
          'pagination' => $pagination,
          'productAttributes' => $productAttributes, // Truyền biến productAttributes vào view
      ]);
  }

  
public function actionHome()
{
    $this->layout = 'main2';
   return $this->render('home');
}
public function actionSearch($search)
    {
        $this->layout = 'main';
        $products = Products::find()
            ->where(['like', 'product_name', $search])
            ->all();

        // Hiển thị kết quả trên trang xem.php
        return $this->render('xem', [
            'products' => $products,
        ]);
    }
   
public function actionShop()
{
 $this->layout='login_layout';

    //$this->layout = 0;
    $post = Yii::$app->request->post();
    $user = new Account();
    if ($user->idLogged()) {
        return $this->goHome();
        
    }
   
    if(isset($post['register']) && $post['register'] == 1){
        $this->layout = 0;
        $users = new Account();
        $users->beforeSaveUser($post['Users']);
        $users->validate();
        $users->save();
        Yii::$app->session->setFlash('success', 'Đăng ký thành công!');
        return $this->redirect('login');
        
    }
    return $this->render('shop');
}
public function actionUpdateuser()
{
    $currentUser = Yii::$app->user->identity; // Lấy thông tin người dùng hiện tại

    if ($currentUser !== null) {
        // Tìm và sửa thông tin của người dùng hiện tại
        $model = Account::findOne($currentUser->id);

        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('Không tìm thấy người dùng.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Thông tin người dùng đã được cập nhật thành công.');
            return $this->redirect(['site/index']); // Chuyển hướng về trang chủ hoặc trang cần thiết khác
        }
    } else {
        throw new \yii\web\ForbiddenHttpException('Bạn phải đăng nhập để thực hiện thao tác này.');
    }

    return $this->render('updateuser', [
        'model' => $model,
        'currentUser' => $currentUser,
    ]);
}
public function actionMess()
{
    $this->layout = 'doanhnghiep';
   return $this->render('mess');
}
public function actionThankYou()
{
    $this->layout = 'doanhnghiep';
   return $this->render('thank-you');
}
public function actionBussi()
{
    $this->layout = 'bussi_layout';
    $userId = Yii::$app->user->id;
    $shop = Shop::findOne(['user_id' => $userId]);

    return $this->render('bussi', [
        'shop' => $shop,
    ]);
  
}
public function actionDoanhnghiep()
{
    $this->layout = 'doanhnghiep';
  

    $userId = Yii::$app->user->id; // Lấy ID của user đăng nhập hiện tại
    $shop = Shop::find()->where(['user_id' => $userId])->one(); // Truy vấn shop dựa trên user_id
 
    return $this->render('doanhnghiep', [
        'shop' => $shop,
    ]);
}


public function actionChatbot()
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    $data = Yii::$app->request->post();

    Yii::info('Received data: ' . json_encode($data), __METHOD__);  // Log dữ liệu nhận được

    if (isset($data['message'])) {
        $message = $data['message'];
        Yii::info('Message received: ' . $message, __METHOD__);  // Log giá trị của message
        $response = $this->processChatMessage($message);
        return ['response' => $response];
    }

    return ['response' => 'No message received'];
}

    protected function processChatMessage($message)
    {
        // Logic trả lời của chatbot
        if (stripos($message, 'hello') !== false) {
            return 'Hi! How can I help you today?';
        }

        return 'Sorry, I didn\'t understand that.';
    }
public function beforeAction($action)
{
    if ($action->id === 'chatbot') {
        $this->enableCsrfValidation = false;
    }
    return parent::beforeAction($action);
}


public function actionAddToCart($product_id, $quantity = 1)
{
    // Lấy thông tin sản phẩm từ database
    $product = Products::findOne($product_id);

    // Kiểm tra nếu sản phẩm không tồn tại
    if (!$product) {
        throw new NotFoundHttpException('Sản phẩm không tồn tại.');
    }

    // Kiểm tra nếu sản phẩm có giảm giá
    $discountedPrice = $product->product_price;
    if ($product->discount) {
        $discountedPrice = $product->product_price * (1 - $product->discount / 100);
    }

    // Khởi tạo session nếu chưa tồn tại
    $session = Yii::$app->session;
    $session->open();

    // Kiểm tra xem giỏ hàng có tồn tại không, nếu không thì khởi tạo một mảng trống
    if (!$session->has('cart')) {
        $session->set('cart', []);
    }

    // Lấy danh sách sản phẩm hiện có trong giỏ hàng
    $cart = $session->get('cart');

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    if (isset($cart[$product_id])) {
        // Nếu đã tồn tại, cộng thêm số lượng mới vào số lượng hiện tại
        $cart[$product_id]['quantity'] += $quantity;
    } else {
        // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
        $cart[$product_id] = [
            'product_id' => $product->product_id,
            'product_name' => $product->product_name,
            'price' => $discountedPrice, // Sử dụng giá sau khi giảm giá nếu có
            'quantity' => $quantity,
        ];
    }

    // Lưu lại giỏ hàng vào session
    $session->set('cart', $cart);

    // Đóng session
    $session->close();

    // Chuyển hướng đến trang giỏ hàng
    return $this->redirect(['site/view-cart']);
}


// Action để hiển thị trang giỏ hàng
public function actionViewCart()
{
    // Lấy giỏ hàng từ session
    $session = Yii::$app->session;
    $session->open();

    $cart = $session->get('cart', []);

    // Đóng session
    $session->close();

    // Render view giỏ hàng và truyền dữ liệu giỏ hàng vào view
    return $this->render('view-cart', [
        'cart' => $cart,
    ]);
}

public function actionUpdateCart()
{
    // Kiểm tra xem yêu cầu có phải là POST không
    if (Yii::$app->request->isPost) {
        $cart = Yii::$app->session->get('cart', []);
        $updatedQuantities = Yii::$app->request->post('quantity', []);

        $errors = [];
        foreach ($updatedQuantities as $productId => $quantity) {
            // Đảm bảo số lượng là số dương
            $quantity = max(1, (int)$quantity);

            // Lấy sản phẩm từ cơ sở dữ liệu
            $product = Products::findOne($productId);
            if ($product) {
                // Kiểm tra nếu số lượng cập nhật vượt quá số lượng sản phẩm hiện có
                if ($quantity > $product->product_quantity) {
                    $errors[] = "Số lượng sản phẩm '{$product->product_name}' bạn mua vượt quá số lượng hiện có của shop (Shop hiện tại còn lại {$product->product_quantity} sản phẩm).";
                } else {
                    // Cập nhật số lượng trong giỏ hàng
                    if (isset($cart[$productId])) {
                        $cart[$productId]['quantity'] = $quantity;
                    }
                }
            } else {
                $errors[] = "Sản phẩm với ID {$productId} không tồn tại.";
            }
        }

        // Nếu có lỗi, lưu lỗi vào session và chuyển hướng về trang giỏ hàng
        if (!empty($errors)) {
            Yii::$app->session->setFlash('cartErrors', $errors);
            return $this->redirect(['site/view-cart']);
        }

        // Lưu lại giỏ hàng trong session
        Yii::$app->session->set('cart', $cart);

        // Chuyển hướng về trang giỏ hàng
        return $this->redirect(['site/view-cart']);
    }

    // Nếu không phải POST, chuyển hướng về trang chủ
    return $this->redirect(['site/index']);
}


public function actionRemoveFromCart($product_id)
{
    // Lấy giỏ hàng từ session
    $cart = Yii::$app->session->get('cart', []);

    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    if (isset($cart[$product_id])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($cart[$product_id]);

        // Cập nhật lại giỏ hàng trong session
        Yii::$app->session->set('cart', $cart);
    }

    // Chuyển hướng về trang giỏ hàng
    return $this->redirect(['site/view-cart']);
}

public function actionBuy()
{
    // Lấy thông tin người dùng hiện tại (User)
    $user = Yii::$app->user->identity;

    // Lấy giỏ hàng từ session
    $session = Yii::$app->session;
    $session->open();

    $cart = $session->get('cart', []);

    // Tính tổng tiền của giỏ hàng
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Kiểm tra xem có áp dụng mã giảm giá hay không
    $voucherApplied = $session->get('voucher_applied', false);
    $voucherCode = $session->get('voucher_code', '');
// Xóa session voucher_applied khi cần thiết
Yii::$app->session->remove('voucher_applied');

    // Đóng session
    $session->close();

    // Render view mua hàng và truyền dữ liệu cần thiết vào view
    return $this->render('buy', [
        'user' => $user,
        'cart' => $cart,
        'total' => $total,
        'voucherApplied' => $voucherApplied,
        'voucherCode' => $voucherCode,
    ]);
}

public function actionConfirmBuy()
{
    $request = Yii::$app->request;
    $user = Yii::$app->user->identity;
    $session = Yii::$app->session;
    $session->open();
    $cart = $session->get('cart', []);
    
    $total = 0;
    foreach ($cart as $item) {
       $total += $item['price'] * $item['quantity'];
    }
    $session->close();

    $transaction = Yii::$app->db->beginTransaction();
    try {
        // Tạo đơn hàng chung
        $order = new Orders();
        $order->user_id = $user->id;
        $order->order_date = date('Y-m-d H:i:s');
        $order->total = $total;
        $paymentMethod = $request->post('payment_method');
        $order->payment_method = $paymentMethod;
        $order->status = 1;
        if (!$order->save()) {
            throw new Exception('Failed to save order.');
        }


        // Biến để lưu trữ shop_order_id hiện tại
        $currentShopOrderId = null;

        foreach ($cart as $productId => $item) {
            // Lấy thông tin sản phẩm và shop của sản phẩm
            $product = Products::findOne($productId);
            if ($product !== null) {

                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $productId;
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->price = $item['price'] * $item['quantity'];
                $orderDetail->save();
                // Nếu là sản phẩm đầu tiên của shop, tạo đơn hàng shop mới
                if ($currentShopOrderId === null || $currentShopOrderId !== $product->shop_id) {
                    $shopOrder = new ShopOrders();
                    $shopOrder->shop_id = $product->shop_id;
                    $shopOrder->order_id = $order->id;
                    $shopOrder->payment = $paymentMethod;
                    $shopOrder->total = 0; // Sẽ tính lại sau khi gom nhóm sản phẩm
                    $shopOrder->status = 1;
                    if (!$shopOrder->save()) {
                        throw new Exception('Failed to save shop order.');
                    }
                    $currentShopOrderId = $product->shop_id;
                }
                

                // Lưu chi tiết đơn hàng shop
                $shopOrderDetail = new ShopOrderDetails();
                $shopOrderDetail->shop_order_id = $shopOrder->id;
                $shopOrderDetail->product_name = $item['product_name'];
                $shopOrderDetail->quantity = $item['quantity'];
                $shopOrderDetail->price = $item['price'];
                if (!$shopOrderDetail->save()) {
                    throw new Exception('Failed to save shop order detail.');
                }

                // Cập nhật tổng tiền của đơn hàng shop
                $shopOrder->total += $item['price'] * $item['quantity'];
                if (!$shopOrder->save()) {
                    throw new Exception('Failed to update shop order total.');
                }

                // Giảm số lượng sản phẩm trong kho
                $product->product_quantity -= $item['quantity'];
                if ($product->product_quantity < 0) {
                    $product->product_quantity = 0;
                }
                if (!$product->save()) {
                    throw new Exception('Failed to update product quantity.');
                }
            }
        }

        $transaction->commit();
        $session->remove('cart');
        return $this->redirect(['site/thank-you']);
    } catch (Exception $e) {
        $transaction->rollBack();
        throw $e;
    }
}

public function actionApplyDiscount()
{
    Yii::$app->response->format = Response::FORMAT_JSON;
    
    $discountCode = Yii::$app->request->post('discount_code');
    $voucher = Voucher::findOne(['voucher_code' => $discountCode, 'status' => 1]);

    
    if ($voucher !== null && $voucher->isValid()) {
        $session = Yii::$app->session;
        $session->open();
        $cart = $session->get('cart', []);
        $total = 0;
        
        // Tính lại tổng tiền với mã giảm giá
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        $newTotal = $voucher->applyDiscount($total);
        $session->set('total_discounted', $newTotal);
        $session->close();
        
        return ['success' => true, 'newTotal' => $newTotal];
    } else {
        return ['success' => false];
    }
}
public function actionVoucher()
{
    $vouchers = Voucher::find()->all();

    return $this->render('voucher', [
        'vouchers' => $vouchers,
    ]);
}
public function actionApplyVoucher()
{
    $user = Yii::$app->user->identity;
    $request = Yii::$app->request;
    $session = Yii::$app->session;
    $session->open();
    $cart = $session->get('cart', []);
    $total = 0;

    // Tính lại tổng tiền của giỏ hàng
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Xử lý mã giảm giá
    $voucherCode = $request->post('voucher_code');
    $discount = 0;
    if ($voucherCode) {
        $voucher = Voucher::find()->where(['voucher_code' => $voucherCode, 'status' => 1])->one();
        if ($voucher) {
            $discount = ($total * $voucher->discount_percentage) / 100;
            $session->set('discount', $discount);
            $session->set('voucher_code', $voucherCode);
 // Đánh dấu là đã áp dụng mã giảm giá
 $session->set('voucher_applied', true);
            // Áp dụng giảm giá vào tổng tiền
            $total -= $discount;
            if ($total < 0) {
                $total = 0; // Đảm bảo không âm số tiền
            }
        } else {
            Yii::$app->session->setFlash('cartErrors', ['Mã giảm giá không hợp lệ hoặc đã hết hạn.']);
        }
    }

    $session->set('total', $total); // Lưu lại tổng tiền sau khi áp dụng mã giảm giá
    $session->close();
    return $this->render('buy', [
        'user' => $user,
        'cart' => $cart,
        'total' => $total,
    ]);
}

public function actionCategory($id)
{
    $category = Categories::findOne($id);
    if (!$category) {
        throw new NotFoundHttpException('The requested category does not exist.');
    }

    // Lấy danh mục cha của danh mục hiện tại
    $parentCategory = $category->getParent()->one();

    // Lấy danh sách danh mục con của danh mục hiện tại
    $categories = Categories::find()->where(['p_id' => $id])->all();

    // Lấy danh sách ID của danh mục hiện tại và các danh mục con
    $cateIds = [$id];
    foreach ($categories as $cate) {
        $cateIds[] = $cate->id;
    }

    // Tạo truy vấn để lấy sản phẩm của danh mục hiện tại và các danh mục con
    $query = Products::find()->where(['cate_id' => $cateIds]);
    $sort = Yii::$app->request->get('sort');
    switch ($sort) {
        case 'price-asc':
            $query->orderBy(['product_price' => SORT_ASC]);
            break;
        case 'price-desc':
            $query->orderBy(['product_price' => SORT_DESC]);
            break;
        case 'bestseller':
            // Giả sử bạn có cột `sold_quantity` để sắp xếp theo số lượng đã bán
            $query->orderBy(['sold_quantity' => SORT_DESC]);
            break;
        case 'newest':
            $query->orderBy(['created_at' => SORT_DESC]);
            break;
        default:
        $query->orderBy(['product_name' => SORT_ASC]);
            break;
    }

    // Tạo đối tượng phân trang
    $pagination = new Pagination([
        'defaultPageSize' => 4, // Số lượng sản phẩm trên mỗi trang
        'totalCount' => $query->count(),
    ]);

    // Áp dụng phân trang vào truy vấn sản phẩm
    $products = $query->offset($pagination->offset)
                      ->limit($pagination->limit)
                      ->all();

    return $this->render('category', [
        'category' => $category,
        'categories' => $categories,
        'products' => $products,
        'parentCategory' => $parentCategory,
        'pagination' => $pagination, // Truyền đối tượng phân trang vào view
        'sort'=>$sort,
    ]);
}

public function actionSta()
{
    $this->layout = 'main2';

    // Tính toán doanh thu của sàn
    $totalRevenue = Orders::find()
        ->where(['status' => 3])
        ->sum('total');
    $platformRevenue = $totalRevenue * 0.04;
    
    // Phí hoàn lại cho các shop
    $shopOrders = ShopOrders::find()
        ->joinWith('order') // Join với bảng Orders
        ->with('shop')
        ->where(['orders.status' => 3]) // Lọc Orders có status = 3
        ->andWhere(['shop_orders.status' => 3]) // Lọc ShopOrders có status = 3
        ->all();
    
    $refunds = [];
    foreach ($shopOrders as $shopOrder) {
        $refunds[] = [
            'shop_name' => $shopOrder->shop->shop_name,
            'refund_fee' => $shopOrder->total * 0.94, // Tính phí hoàn lại
            'status' => $shopOrder->status == 3 ? 'Đã duyệt' : 'Chưa duyệt',
        ];
    }
    
    $dataProvider = new \yii\data\ArrayDataProvider([
        'allModels' => $refunds,
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    
    return $this->render('sta', [
        'platformRevenue' => $platformRevenue,
        'dataProvider' => $dataProvider,
    ]);
    
}
// Trong SiteController hoặc controller tương ứng

public function actionStabs()
{
    $this->layout = 'bussi_layout';

    // Sản phẩm sắp hết hàng (product_quantity < 10)
    $lowStockProducts = Products::find()
        ->where(['<', 'product_quantity', 10])
        ->all();

    // Doanh thu của shop (shop revenue)
    $shopRevenue = ShopOrders::find()
        ->joinWith('order')
        ->where(['shop_orders.status' => 3, 'orders.status' => 3])
        ->sum('shop_orders.total * 0.96'); // Chỉ rõ cột total từ bảng shop_orders

    return $this->render('stabs', [
        'lowStockProducts' => $lowStockProducts,
        'shopRevenue' => $shopRevenue,
    ]);
}



}
