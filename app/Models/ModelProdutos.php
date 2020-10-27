<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProdutos  extends Model
{
    protected $table = ' produto';
    protected $primaryKey = 'id';
    protected $allowedField = [
	'nomeProduto',
	'id_categoria',
	'estado',
	'quantidade',
	'preco'];
}
