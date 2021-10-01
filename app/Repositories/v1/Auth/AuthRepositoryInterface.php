<?php

namespace App\Repositories\v1\Auth;
use App\Repositories\v1\GlobalInterface;

interface AuthRepositoryInterface
{
   public function authRegister($data);

   public function authSignIn($data);

   public function authRecover($data);
}
