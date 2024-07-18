<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property string $product_code
 * @property string $product_name
 * @property float $product_price
 * @property string $product_image
 * @property string $describe
 * @property int $product_quantity
* @property int $discount
* @property string $discount
* @property string $discount_end_date
 * @property int $discount_start_date
 * @property int $status
 *
 * @property Categories $cate
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public $quantity ;
    public function rules()
    {
        return [
            [['product_code', 'product_name', 'product_price', 'detail','describe', 'product_quantity'], 'required'],
            [['product_price'], 'number'],
            [['detail','describe'], 'string'],
            [['product_quantity', 'cate_id', 'status','quantity','discount'], 'integer'],
            [['discount_end_date','discount_start_date'], 'safe'],
            [['product_code'], 'string', 'max' => 12],
            [['product_name'], 'string', 'max' => 50],
            [['product_image'], 'string', 'max' => 30],
            [['cate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['cate_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Mã sản phẩm',
            'product_code' => 'Mã code sản phẩm',
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm',
            'product_image' => 'Ảnh sản phẩm',
            'detail'=>'Chi tiết',
            'describe' => 'Mô tả',
            'product_quantity' => 'Số lượng sản phẩm',
            'cate_id' => 'Ngành hàng sản phẩm',
            'status' => 'Trạng thái sản phẩm',
        ];
    }

    /**
     * Gets query for [[Cate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCate()
    {
        return $this->hasOne(Categories::class, ['id' => 'cate_id']);
    }
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'cate_id']);
    }
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['product_id' => 'product_id']);
    }
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
    public function getCategoryName()
    {
        $category = Categories::findOne($this->cate_id); // Giả sử bạn có một mối quan hệ đơn giản giữa cate_id và bảng Categories
        return $category ? $category->cate_name : 'Unknown'; // Trả về tên danh mục hoặc một giá trị mặc định nếu không tìm thấy
    }
    public function getShopName()
    {
        $shop = Shop::findOne($this->shop_id); // Giả sử bạn có một mối quan hệ đơn giản giữa cate_id và bảng Categories
        return $shop ? $shop->shop_name : 'Unknown'; // Trả về tên danh mục hoặc một giá trị mặc định nếu không tìm thấy
    }
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->status = '1';
    
            // Lấy user_id của user đăng nhập hiện tại
            $userId = Yii::$app->user->id;
    
            // Tìm shop_id tương ứng từ user_id
            $shopId = Shop::find()->where(['user_id' => $userId])->select('id')->scalar();
    
            // Kiểm tra nếu tìm thấy shop_id
            if ($shopId !== null) {
                $this->shop_id = $shopId;
            } else {
                // Xử lý khi không tìm thấy shop_id (nếu cần)
            }
    
            $this->product_image = '/images/phukien1.jfif';
        }
        return parent::beforeSave($insert);
    }
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttributes::class, ['product_id' => 'product_id']);
    }
    
    
}
