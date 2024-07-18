<?php

namespace app\controllers;
use app\models\Comments;
use yii;
class CommentsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate()
    {
        $model = new Comments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Nếu lưu thành công, chuyển hướng về trang chi tiết sản phẩm
            return $this->redirect(['/site/detail', 'id' => $model->product_id]);
        }

        // Nếu không thành công, ghi lại các lỗi xác thực
        Yii::error('Comment save failed: ' . json_encode($model->errors));

        // Chuyển hướng lại trang chi tiết sản phẩm kèm theo thông báo lỗi
        Yii::$app->session->setFlash('error', 'Bình luận không được lưu. Vui lòng thử lại.');
        return $this->redirect(['/site/detail', 'id' => $model->product_id]);
    }
}
