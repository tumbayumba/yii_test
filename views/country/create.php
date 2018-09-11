<?php

use yii\helpers\Html;
use app\components\HelloWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Country */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="country-create">
    
    <?= HelloWidget::widget(['message' => 'Good morning']) ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
