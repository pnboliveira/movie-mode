<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data['users'] = Users::all();
        return view('user.list',$data);
    }
            
    public function destroy($id){
        $user = Users::find($id);
        if (auth()->user()->id == $id){
            return redirect('user')->with('error','Operação inválida.');
        }
        else{
            Users::where('id',$id)->delete();
            return redirect('user')->with('success','User apagado com sucesso.');
        }
        }       
}
