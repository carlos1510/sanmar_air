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
     * Login
     * @param Request $request
     * @return void
     */
    public function viewLogin(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('auth.login');
    }

    /**
     * Login
     * @param Request $request
     * @return void
     */
    public function viewHome(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('welcome');
    }

    /**
     * Vista Paciente
     * @param Request $request
     * @return void
     */
    public function viewFligth(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.fligth.fligth');
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
     * Vista Administrar vuelos
     * @param Request $request
     * @return void
     */
    public function viewManageFligth(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.fligth.manageFligth');
    }

    /**
     * Vista Administrar vuelos
     * @param Request $request
     * @return void
     */
    public function viewReserved(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.fligth.reserved');
    }

    /**
     * Vista Reporte Proforma
     * @param Request $request
     * @return void
     */
    public function viewReportProforma(Request $request)
    {
        /*$id = Session::get('idusuario');
        if(isset($id)){
            Session::put('menu_primario', 'configuracion');
            return view('configuracion/importar');
        }else{
            return redirect('/');
        }*/
        return view('moduls.report.proforma');
    }
}
