<?php

use yii\db\Migration;

class m240621_180900_create_product_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Nome do produto'),
            'sku' => $this->string(100)->notNull()->unique()->comment('SKU - Stock Keeping Unit'),
            'description' => $this->text()->comment('Descrição detalhada do produto'),
            'quantity' => $this->integer()->notNull()->defaultValue(0)->comment('Quantidade em estoque'),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0.00)->comment('Preço unitário do produto'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-product-sku',
            '{{%product}}',
            'sku'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-product-sku',
            '{{%product}}'
        );
        
        $this->dropTable('{{%product}}');
    }
}
