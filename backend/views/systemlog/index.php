<?php

use backend\models\Systemlog;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\SystemlogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'System logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systemlog-index">

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'emptyText' => 'No System Logs',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute'=>'log_type_id',
                    'value'=>function($model){
                       return \backend\helpers\LogType::getTypeById($model->log_type_id);
                    }
            ],
            'trans_date',
            'ipaddress',
            'function_name',
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                    return \backend\models\User::findName($model->user_id);
                }
            ],
            //'ipaddress',
            //'message',
            //'created_at',
            //'created_by',
            //'login_act_type',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Systemlog $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
//            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
