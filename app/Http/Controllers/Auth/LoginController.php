<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Services\ProfesionalServices;

class LoginController extends Controller
{

    public function index(){
        if(Session::has('idusuario')){
            return redirect('/home');
        }else{
            return view('auth.login');
        }
    }


    public function login(Request $request){
        $this->validate(request(),[
            'usuario' => 'required|string',
            'clave' => 'required|string'
        ]);

        $services = new ProfesionalServices();
        $user = $services->getUsuario($request->get('usuario'), $request->get('clave'));

        if(count($user)>0){
            if(isset($user['error'])){
                return back()->withErrors(['usuario' => trans('auth.failed')])
                    ->withInput(request()->only('usuario'));
            }else{
                //var_dump($user[0]->id);
                Session::put('idusuario', $user[0]->id);
                Session::put('nombres', $user[0]->nombres);
                Session::put('nick', $user[0]->nick);
                Session::put('idnivel', isset($user[0]->idnivel)?$user[0]->idnivel:null);
                Session::put('id_profesion', isset($user[0]->id_profesion)?$user[0]->id_profesion:null);
                Session::put('nom_nivel', $user[0]->nom_nivel);
                Session::put('nom_profesion', $user[0]->nom_profesion);
                Session::put('paterno', isset($user[0]->paterno)?$user[0]->paterno:'');
                Session::put('materno', isset($user[0]->materno)?$user[0]->materno:'');
                Session::put('telefono', isset($user[0]->telefono)? $user[0]->telefono:'');
                Session::put('id_establecimiento', isset($user[0]->id_establecimiento)?$user[0]->id_establecimiento:'');
                Session::put('nom_establecimiento', isset($user[0]->nom_establecimiento)?$user[0]->nom_establecimiento:'');
                //return $user[0]->id;
                return redirect('/home');
            }
        }else {
            return back()->withErrors(['usuario' => trans('auth.failed')])
                ->withInput(request()->only('usuario'));
        }
    }

    public function logout(){
        Session::flush();

        return redirect('/');
    }
}
