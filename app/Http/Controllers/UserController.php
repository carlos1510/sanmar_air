<?php

namespace App\Http\Controllers;

use App\Http\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;

date_default_timezone_set('America/Lima');

class UserController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new UserServices();
    }

    public function login(Request $request){
        $this->validate(request(),[
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

        $params = array('usuario' => $request->get('usuario'), 'password' => $request->get('password'));

        $user = $this->service->obtenerUsuarioSesion($params);
        //dd($user);
        if ($user['confirm']){
            if (!is_null($user['user'])){
                Session::put('idusuario', $user['user']->id);
                //Session::put('nombres', $user[0]->nombres);
                //Session::put('nick', $user[0]->nick);
                Session::put('idnivel', isset($user['user']->idnivel)?$user['user']->idnivel:null);
                Session::put('idempresa', isset($user['user']->idempresa)?$user['user']->idempresa:null);

                return redirect('/home');
            }else{
                return back()->withErrors(['usuario' => trans('auth.failed')])
                    ->withInput(request()->only('usuario'));
            }
        }else{
            return back()->withErrors(['usuario' => trans('auth.failed')])
                ->withInput(request()->only('usuario'));
        }
    }

    public function logout(){
        Session::flush();

        return redirect('/');
    }

    public function registrarUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->registrarUsuario($params));
    }

    public function eliminarUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->eliminarUsuario($params));
    }

    public function listarUsuarios(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->listarUsuarios($params));
    }

    public function quitarAccesoUsuario(Request $request){
        $request->isXmlHttpRequest();
        $content = $request->getContent();
        $params = json_decode($content);
        return new JsonResponse($this->service->quitarAccesoUsuario($params));
    }
}
