<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $params = null;
        /*$id = Session::get('idusuario');
        if(isset($id)){
            $notificacion = new ReportesServices();
            $lista_notificacion = $notificacion->allNotificaciones($params);
            View::share('lista_notificacion', $lista_notificacion);
        }*/

        //$this->middleware('auth');
        //$id = Session::has('idusuario');
        /*if(Session::has('idusuario')){
            return view('/welcome');
        }else{
            return redirect('/');
        }*/
    }

    /**
     * Vista Paciente
     * @param Request $request
     * @return void
     */
    public function viewPatient(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.register.patient');
    }

    /**
     * Vista Empresa
     * @param Request $request
     * @return void
     */
    public function viewCompany(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.register.company');
    }

    /**
     * Vista Usuario
     * @param Request $request
     * @return void
     */
    public function viewUser(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.setting.user');
    }

    /**
     * Vista Seguimiento
     * @param Request $request
     * @return void
     */
    public function viewTracing(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.tracing.tracing');
    }
}
