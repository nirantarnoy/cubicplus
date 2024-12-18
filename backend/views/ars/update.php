<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */

$this->title = 'Update Ars: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ars-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
