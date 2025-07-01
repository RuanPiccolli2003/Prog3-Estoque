<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Modelo Product (Produto).
 */
class Product extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['name', 'sku', 'quantity', 'price'], 'required', 'message' => 'Este campo é obrigatório.'],
            [['quantity', 'created_at', 'updated_at'], 'integer', 'message' => 'O valor deve ser um número inteiro.'],
            [['price'], 'number', 'message' => 'O preço deve ser um número válido.'],
            [['description'], 'string'],
            [['name', 'sku'], 'string', 'max' => 255],
            ['quantity', 'compare', 'compareValue' => 0, 'operator' => '>=', 'message' => 'A quantidade não pode ser negativa.'],
            ['price', 'compare', 'compareValue' => 0, 'operator' => '>=', 'message' => 'O preço não pode ser negativo.'],
            ['sku', 'unique', 'message' => 'Este SKU já está sendo utilizado por outro produto.'],
            [['name', 'sku', 'description'], 'trim'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome do Produto',
            'sku' => 'SKU (Código)',
            'description' => 'Descrição',
            'quantity' => 'Quantidade em Estoque',
            'price' => 'Preço Unitário (R$)',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Última Atualização',
        ];
    }
}