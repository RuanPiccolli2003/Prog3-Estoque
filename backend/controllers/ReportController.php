<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * Controller para a geração de relatórios.
 */
class ReportController extends Controller
{
    /**
     * Define as regras de acesso. Apenas utilizadores logados podem ver os relatórios.
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'], // Ações deste controller
                        'allow' => true,
                        'roles' => ['@'], // '@' significa utilizador autenticado
                    ],
                ],
            ],
        ];
    }

    /**
     * Ação principal que exibe o relatório de estoque.
     * @return string
     */
    public function actionIndex()
    {
        // 1. Prepara o provedor de dados para a grade de produtos
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'pagination' => [
                'pageSize' => 20, // Define quantos produtos aparecem por página
            ],
            'sort' => ['defaultOrder' => ['name' => SORT_ASC]] // Ordena por nome
        ]);

        // 2. Calcula os totais para os cartões de resumo
        $totalProducts = Product::find()->count();
        $totalItems = Product::find()->sum('quantity') ?? 0; // Soma de todas as quantidades
        // Cria uma expressão para multiplicar preço e quantidade de cada linha antes de somar
        $totalValue = Product::find()->sum(new Expression('quantity * price')) ?? 0;

        // 3. Renderiza a view, passando os dados calculados
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'totalProducts' => $totalProducts,
            'totalItems' => $totalItems,
            'totalValue' => $totalValue,
        ]);
    }
}
