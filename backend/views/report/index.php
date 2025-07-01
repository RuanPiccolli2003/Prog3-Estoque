<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $totalProducts */
/** @var int $totalItems */
/** @var float $totalValue */

$this->title = 'Relatório de Estoque Atual';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p class="lead">Visão geral das quantidades e valores dos produtos em estoque.</p>

    <!-- Cartões de Resumo -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Tipos de Produtos</h5>
                    <p class="card-text fs-4 fw-bold"><?= $totalProducts ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total de Itens no Estoque</h5>
                    <p class="card-text fs-4 fw-bold"><?= Yii::$app->formatter->asInteger($totalItems) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Valor Total do Estoque</h5>
                    <p class="card-text fs-4 fw-bold"><?= Yii::$app->formatter->asCurrency($totalValue) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grelha de Detalhes -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'sku',
            'name',
            'quantity:integer', // Formata como inteiro
            'price:currency',   // Formata como moeda (R$)
            [
                'attribute' => 'total_value',
                'label' => 'Valor em Estoque (R$)',
                'format' => 'currency',
                'value' => function ($model) {
                    return $model->quantity * $model->price;
                },
            ],
        ],
    ]); ?>

</div>
