<?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Painel Administrativo';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <h1 class="display-4">Bem-vindo(a)!</h1>
        <p class="lead">Você está no painel de controle do seu Sistema de Gestão de Estoque.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Gestão de Produtos</h2>
                <p>Adicionar, visualizar, editar e remover os produtos do seu estoque.</p>
                <p><?= Html::a('Gerir Produtos &raquo;', ['/product/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Relatórios</h2>
                <p>Visualizar relatórios de entrada e saída, níveis de estoque e outras informações importantes para o seu negócio.</p>
                <p><?= Html::a('Ver Relatórios &raquo;', ['/report/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
            <div class="col-lg-4">
                <h2>Usuários</h2>
                <p>Gestão dos usuários que tem acesso ao painel administrativo.</p>
                <p><?= Html::a('Gerir Usuários &raquo;', ['/user/index'], ['class' => 'btn btn-outline-secondary']) ?></p>
            </div>
        </div>
    </div>
</div>
