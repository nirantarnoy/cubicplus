<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Distributor $model */

$this->title = 'สร้างผู้จัดจำหน่าย';
$this->params['breadcrumbs'][] = ['label' => 'ผู้จัดจำหน่าย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distributor-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
