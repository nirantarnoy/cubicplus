<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Distributor $model */

$this->title = 'แก้ไขผู้จัดจำหน่าย: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ผู้จัดจำหน่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="distributor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
