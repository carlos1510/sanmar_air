@extends('main')

@section('title')
    Inicio
@endsection

@section('bodycontroller')
    id='homeController' ng-controller='homeController'
@endsection

@section('container-header')
    <strong>SISTEMA DE SEGUIMIENTO</strong>
@endsection

@section('content')

@endsection

@section('javascripts')
    @parent
    <script src="js/angular/controller/homeController.js"></script>
@endsection
