<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Albumes */

$this->title = 'Create Albumes';
$this->params['breadcrumbs'][] = ['label' => 'Albumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="albumes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
