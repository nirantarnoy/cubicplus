<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Systemlog $model */

$this->title = 'Create Systemlog';
$this->params['breadcrumbs'][] = ['label' => 'Systemlogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemlog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
