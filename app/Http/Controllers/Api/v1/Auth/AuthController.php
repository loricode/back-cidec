<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Illuminate\Http\Request;
use App\Repositories\v1\Auth\AuthRepositoryInterface;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\v1\Auth\StoreRegister;

class AuthController extends ApiController
{
  private $repository;

  public function __construct(AuthRepositoryInterface $repository){
    $this->repository = $repository;
  }

  public function register(StoreRegister $request){
    $result = $this->repository->authRegister($request);
    return $this->apiResponse($result['info'], $result);
  }

  public function signIn(Request $request){
   
    $request->validate([
      'email'=>'required|email|max:191',
      'password'=>'required|string'
    ]);
    $result = $this->repository->authSignIn($request);
    return $this->apiResponse($result['info'], $result);
  }

  public function recoverAccount(Request $request){
    $result = $this->repository->authRecover($request);
    return $this->apiResponse($result['info'], $result);
  }

}
