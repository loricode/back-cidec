<?php

namespace App\Repositories\v1\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements ProductRepositoryInterface
{
  protected $model;

  public function __construct(Product $model)
  {
    $this->model = $model;
  }

  public function all(){

   $result =  $this->model->paginate();
   
   return [
      'data' => [$result],
      'info' => 'success',
      'status' => 200,
      'message' => trans('messages.successfully')
     ];
  }


}