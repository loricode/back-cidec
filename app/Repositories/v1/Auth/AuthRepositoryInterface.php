<?php

namespace App\Repositories\v1\Auth;

interface AuthRepositoryInterface
{
   public function authRegister($data);

   public function authSignIn($data);

   public function authRecover($data);
}
