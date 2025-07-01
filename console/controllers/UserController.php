<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

/**
 * Controller para gerenciar usuários via linha de comando.
 */
class UserController extends Controller
{
    /**
     * Cria um novo usuário no sistema.
     * Exemplo de uso: php yii user/create
     */
    public function actionCreate()
    {
        $model = new User();

        // Pede os dados ao usuário no terminal
        $model->username = $this->prompt('Nome de usuário:', ['required' => true]);
        $model->email = $this->prompt('E-mail:', ['required' => true]);
        $password = $this->prompt('Senha:', ['required' => true]);

        $model->setPassword($password);
        $model->generateAuthKey();

        // Tenta salvar o novo usuário
        if ($model->save()) {
            $this->stdout("Usuário '{$model->username}' criado com sucesso!\n");
            return self::EXIT_CODE_NORMAL;
        } else {
            $this->stderr("Não foi possível criar o usuário.\n");
            // Mostra os erros de validação
            foreach ($model->getErrors() as $attribute => $errors) {
                foreach ($errors as $error) {
                    $this->stderr("$attribute: $error\n");
                }
            }
            return self::EXIT_CODE_ERROR;
        }
    }
}
