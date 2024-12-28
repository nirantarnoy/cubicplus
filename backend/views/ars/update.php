<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */

$this->title = 'แก้ไข Ars: ' . $model->ars_no;
$this->params['breadcrumbs'][] = ['label' => 'Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ars_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="ars-update">
    <?= $this->render('_form', [
        'model' => $model,
        'model_product' => $model_product,
        'model_line' => $model_line,
        'model_product_line'=>$model_product_line,
    ]) ?>

</div>
