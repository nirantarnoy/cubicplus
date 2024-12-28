<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */

$this->title = 'สร้าง ARS';
$this->params['breadcrumbs'][] = ['label' => 'Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ars-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_product' => $model_product,
        'model_line' => null,
        'model_product_line'=>null,
    ]) ?>

</div>
