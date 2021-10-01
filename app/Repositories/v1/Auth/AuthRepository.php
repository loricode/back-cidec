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
       $user = $this->model->create([
         'name' => $data['name'],
         'email' => $data['email'],
         'password' => Hash::make($data['password'])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
           'response' => ['token' => $token],
           'success' => true,
           'status' => 200,
           'message' => trans('messages.successfully')
          ];

     } catch (Throwable $th) {
       report($e);

       return false;
     }

  }

  public function authSignIn($data){
   try {

    if(!Auth::attempt($data->only('email', 'password'))){
      return [
        'success' => false,
        'status' => 401, //Unauthorized
        'message' => trans('messages.try_again')
      ];
    }

    $user = $this->model->where('email', $data['email'])->firstOrFail();

    $user->roles;

    $token = $user->createToken('auth_token')->plainTextToken;

    return [
        'response' => [ "data" => $user, 'token' => $token],
        'success' => true,
        'status' => 200,
        'message' => trans('messages.successfully')
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
            'response'=> [ 'data' => [] ],
            'success' => false,
            'status' => 404,
            'message' => trans('messages.email_not_exist')
        ];
      }

     $user = $this->model->where('email', $data['email'])->firstOrFail();



     $token = $user->createToken('auth_token')->plainTextToken;

     return [
      'response' => [ 'data' => $user, 'token' => $token ],
      'success' => true,
      'status' => 200,
      'message' => trans('messages.successfully')
    ];

    }catch(Throwable $e){
     report($e);

     return false;
    }

  }

}
