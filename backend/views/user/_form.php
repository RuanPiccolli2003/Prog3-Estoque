<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */

// Cria um campo 'password' virtual para o formulário
$model->password_hash = ''; // Renomeia o campo no form para evitar confusão.
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?php 
                // O campo da senha terá um nome diferente para o POST
                echo $form->field($model, 'password_hash', [
                    'inputOptions' => [
                        'name' => 'User[password]',
                        'class' => 'form-control'
                     ]
                ])
                ->passwordInput()
                ->label('Senha')
                ->hint($model->isNewRecord ? '' : 'Deixe em branco para não alterar a senha atual.');
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList([
                User::STATUS_ACTIVE => 'Ativo',
                User::STATUS_INACTIVE => 'Inativo',
            ], ['prompt' => 'Selecione um status']) ?>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
