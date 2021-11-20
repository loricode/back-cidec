<?php

namespace App\Repositories\v1\Auth;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function authRegister($data){
    try {

       if($data['password'] != $data['repeatPassword']){
         return [
          'data' => [],
          'info' => 'error',
          'status' => 200,
          'message' => trans('messages.no_equal')
         ];
       }

       $existUser = $this->model->where('email', $data['email'])->first();

       if(!empty($existUser)){
        return [
            'data' => [],
            'info' => 'error',
            'status' => 400,
            'message' => trans('messages.registered')
          ];
       }

       $user = $this->model->create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password'])
        ]);

        return [
          'data' => [],
          'info' => 'success',
          'message' => trans('messages.register')
        ];

     } catch (Throwable $e) {
       report($e);

       return false;
     }

  }

  public function authSignIn($data){
   try {
 
    $user = $this->model->where('email', $data['email'])->first();

    if(!$user || !Hash::check($data['password'], $user->password)){
      return [
        'data' => [],
        'info' => 'error',
        'status' => 401, //Unauthorized
        'message' => trans('messages.try_again')
      ];
    }

    $user->getRoleNames();

    $token = $user->createToken( "mifasatoken" )->plainTextToken;

    return [
        'data' => [
            'roles' => $user['roles'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'token' => $token ],
        'info' => 'success',
        'message' => trans('messages.authenticated')
    ];

   }catch(Throwable $e){
    report($e);

    return false;
   }
 }

    //recuperar cuenta recibe el correo y debe enviar un enlace
  public function authRecover($data){
   try {

     $isUser = $this->model->where('email', $data['email'])->first();

     if( empty($isUser) ){
        return [
            'data' => [],
            'info'=> 'error',
            'message' => trans('messages.email_not_exist')
        ];
      }

     $user = $this->model->where('email', $data['email'])->firstOrFail();

     return [
      'data' => [],
      'message' => trans('messages.successfully')
    ];

    }catch(Throwable $e){
     report($e);

     return false;
    }

  }

}
