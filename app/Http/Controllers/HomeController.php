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
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'home');
            return view('welcome');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista vuelo
     * @param Request $request
     * @return void
     */
    public function viewFligth(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'vuelos');
            return view('moduls.fligth.fligth');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Empresa
     * @param Request $request
     * @return void
     */
    public function viewCompany(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'empresa');
            return view('moduls.register.company');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Usuario
     * @param Request $request
     * @return void
     */
    public function viewUser(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'usuario');
            return view('moduls.setting.user');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Administrar vuelos
     * @param Request $request
     * @return void
     */
    public function viewManageFligth(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'administrar_vuelo');
            return view('moduls.fligth.manageFligth');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Administrar vuelos
     * @param Request $request
     * @return void
     */
    public function viewReserved(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'reservados');
            return view('moduls.fligth.reserved');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Reporte Proforma
     * @param Request $request
     * @return void
     */
    public function viewReportProforma(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'proforma');
            return view('moduls.report.proforma');
        }else{
            return redirect('/');
        }
    }

    /**
     * Vista Reporte Indicadores
     * @param Request $request
     * @return void
     */
    public function viewIndicadores(Request $request)
    {
        if(Session::has('idusuario')){
            Session::put('menu_primario', 'indicadores');
            return view('moduls.report.indicadores');
        }else{
            return redirect('/');
        }
    }
}
