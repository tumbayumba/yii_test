<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php $this->beginBlock('block1'); ?>
    ...содержимое блока 1...
    <?php $this->endBlock(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
