<?php

namespace App\Controllers;

use App\Models\ModelProdutos;
use App\Controllers\BaseController;
use App\Models\Authors;
use Fluent\Models\DB;


class Api extends BaseController
{



  public function findAll()
  {
    $db = db_connect();
    $t = $db->table('produto');
    $t->select('nomeProduto as nome,estado,quantidade,preco,categoria,descricao');
    $t->join('categoria', 'categoria.id=produto.id_categoria');
    $dados = $t->get()->getResultObject();
    return $this->response->setStatusCode(200)->setJSON($dados);
  }
  public function find()
  {
    $db = db_connect();
    $t = $db->table('produto');
    $t->select('nomeProduto as nome,estado,quantidade');
    $dados = $t->get()->getResultObject();
    return $this->response->setStatusCode(200)->setJSON($dados);
  }


  public function findById($id)
  {
    $produtos = new ModelProdutos();
    $produto = $produtos->find($id);
    return $this
      ->response
      ->setStatusCode(200)
      ->setJson($produto);
  }

  public function search($keywork)
  {
    $produtos = new ModelProdutos();
    $produto = $produtos->like('nome', $keywork, 'both')->findAll();
    return $this
      ->response
      ->setStatusCode(200)
      ->setJson($produto);
  }

  public function delete($id)
  {
    $produtos = new ModelProdutos();
    $produtos->delete($id);
    return $this
      ->response
      ->setStatusCode(200);
  }

  public function update()
  {
    $frmproduto = $this->request->getJson();
    $produtos = new ModelProdutos();
    $produtos->update($frmproduto->id, $frmproduto);
    return $this->response->setStatusCode(200);
  }

  public function create()
  {
    $frmproduto = $this->request->getJson();
    $produtos = new ModelProdutos();
    $produtos->insert($frmproduto);
    return $this->response->setStatusCode(200);
  }

}
