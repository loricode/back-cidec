<?php

namespace App\Http\Controllers\Api\v1\Product;

use Illuminate\Http\Request;
use App\Repositories\v1\Product\ProductRepositoryInterface;
use App\Http\Controllers\Api\ApiController;

class ProductController extends ApiController {
 
  private $repository;

  public function __construct(ProductRepositoryInterface $repository){
    $this->repository = $repository;
  }

  public function allProducts(){
    $result = $this->repository->all();
    return $this->apiResponse($result['info'], $result);
  }

}