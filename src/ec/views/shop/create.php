<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Shop $model */


?>
<div class="shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
