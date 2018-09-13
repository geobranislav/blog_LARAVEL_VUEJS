<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
class UserController extends Controller
{
  public function register(Request $request)
  {
    // validate

    $this->validate($request,[
      'name' => 'required|max:255',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6',
    ]);
    //  create db
    $user= new User();
    $user->name=$request->name;
    $user->email=$request->email;
    $user->password=bcrypt($request->password);
    $user->save();

    // response

    return ["message"=>"User Created","user"=>$user];
  }

  public function login(Request $request, JWTAuth $JWTAuth)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:6',
    ]);
    $credientials = $request->only('email','password');

    $token = $JWTAuth->attempt($credientials);

    if(!$token) {
      return "Not Authenticated";
    }
    return ['token' => $token,'userId' => Auth::user()->id];
  }
}