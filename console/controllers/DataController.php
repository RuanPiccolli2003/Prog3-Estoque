<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Product;
use yii\helpers\Console;

/**
 * Controller para popular a base de dados.
 */
class DataController extends Controller
{
    /**
     * Adiciona uma lista de peças para a base de dados.
     * Exemplo de uso: php yii data/seed-products
     */
    public function actionSeedProducts()
    {
        $products = [
            ['name' => 'Pastilhas de Freio Dianteiro (Kit)', 'sku' => 'FR-PAD-001', 'description' => 'Kit com 4 pastilhas de freio para eixos dianteiros. Compatível com modelos populares.', 'quantity' => 45, 'price' => 125.50],
            ['name' => 'Filtro de Óleo do Motor', 'sku' => 'OIL-FLT-015', 'description' => 'Filtro de óleo blindado de alta performance.', 'quantity' => 80, 'price' => 29.90],
            ['name' => 'Amortecedor Dianteiro (Unidade)', 'sku' => 'SUS-SHK-D01', 'description' => 'Amortecedor a gás para suspensão dianteira. Venda por unidade.', 'quantity' => 22, 'price' => 280.00],
            ['name' => 'Vela de Ignição Iridium', 'sku' => 'IGN-PLG-IR', 'description' => 'Vela de ignição com ponta de Iridium para maior durabilidade.', 'quantity' => 150, 'price' => 45.00],
            ['name' => 'Bateria Automotiva 60Ah', 'sku' => 'BAT-60-AH', 'description' => 'Bateria selada de 60 Amperes-hora. 18 meses de garantia.', 'quantity' => 15, 'price' => 450.80],
            ['name' => 'Pneu Aro 15 195/65R15', 'sku' => 'PNU-195-65-15', 'description' => 'Pneu radial para carros de passeio. Índice de velocidade H.', 'quantity' => 40, 'price' => 380.00],
            ['name' => 'Correia Dentada', 'sku' => 'ENG-BLT-101', 'description' => 'Correia sincronizadora do motor para linha 1.6.', 'quantity' => 35, 'price' => 85.75],
            ['name' => 'Bomba d\'Água', 'sku' => 'COL-PMP-005', 'description' => 'Bomba d\'água do sistema de arrefecimento.', 'quantity' => 18, 'price' => 199.99],
            ['name' => 'Kit de Embreagem Completo', 'sku' => 'TRN-CLT-K02', 'description' => 'Inclui platô, disco e rolamento.', 'quantity' => 12, 'price' => 620.00],
            ['name' => 'Farol Dianteiro Direito (Halógeno)', 'sku' => 'LGT-HDL-R03', 'description' => 'Farol com máscara cromada, lado do passageiro.', 'quantity' => 9, 'price' => 310.50],
        ];

        $this->stdout("Iniciando a inserção de peças automotivas de exemplo...\n", Console::FG_YELLOW);

        $count = 0;
        foreach ($products as $productData) {
            $existingProduct = Product::findOne(['sku' => $productData['sku']]);
            if ($existingProduct) {
                $this->stdout("  - Produto com SKU '{$productData['sku']}' já existe. Ignorando.\n", Console::FG_GREY);
                continue;
            }

            $product = new Product();
            $product->attributes = $productData;

            if ($product->save()) {
                $this->stdout("  + Produto '{$product->name}' criado com sucesso.\n", Console::FG_GREEN);
                $count++;
            } else {
                $this->stderr("  - Erro ao criar o produto '{$productData['name']}'.\n", Console::FG_RED);
                foreach ($product->getErrors() as $attribute => $errors) {
                    $this->stderr("    - $attribute: " . implode(", ", $errors) . "\n");
                }
            }
        }
        
        $this->stdout("\nProcesso concluído. $count novos produtos foram adicionados.\n", Console::FG_YELLOW);
        return self::EXIT_CODE_NORMAL;
    }

    /**
     * Limpa completamente a tabela de produtos.
     * Pede confirmação para evitar exclusão acidental.
     */
    public function actionCleanProducts()
    {
        if ($this->confirm("Tem a certeza que deseja excluir TODOS os produtos da base de dados?")) {
            $this->stdout("Excluindo todos os produtos...\n", Console::FG_YELLOW);
            $deletedRows = Product::deleteAll();
            $this->stdout("$deletedRows produtos foram excluídos com sucesso.\n", Console::FG_GREEN);
        } else {
            $this->stdout("Operação cancelada.\n", Console::FG_GREY);
        }
        return self::EXIT_CODE_NORMAL;
    }
}
