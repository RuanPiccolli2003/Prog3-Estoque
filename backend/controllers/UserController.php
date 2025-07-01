<?php

namespace backend\controllers;

use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * UserController implementa as ações CRUD para o model User.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todos os models User.
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Exibe um único user.
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Cria um novo model User.
     * Se a criação for bem-sucedida, o navegador será redirecionado para a página 'view'.
     */
    public function actionCreate()
    {
        $model = new User();


        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // pega senha do POST
                $password = $this->request->post('User')['password'] ?? '';
                if(!empty($password)){
                    $model->setPassword($password);
                    $model->generateAuthKey();
                    if($model->save()){
                        Yii::$app->session->setFlash('success', 'Usuário criado com sucesso.');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                     $model->addError('password', 'Senha não pode ser vazia.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Atualiza um model user existente.
     * A senha só é atualizada se for preenchida.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $password = $this->request->post('User')['password'] ?? '';
            // Só atualiza a senha se uma nova for fornecida
            if (!empty($password)) {
                $model->setPassword($password);
            }
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Usuário atualizado com sucesso.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Exclui um user existente.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Usuário excluído com sucesso.');
        return $this->redirect(['index']);
    }

    /**
     * Encontra o model user com base em sua chave primária.
     * Se o modelo não for encontrado, uma exceção HTTP 404 será lançada.
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A página solicitada não existe.');
    }
}
