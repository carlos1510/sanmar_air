@extends('app')
@section('title') @endsection

@section('stylesheets')
    <link rel="shortcut icon" href="assets/images/favicon.ico" >

    <!-- Fonts and icons -->
    <script src="{{ asset('template/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['template/assets/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/azzara.min.css') }}">
    <link href="{{ asset('css/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}">



@endsection

@section('body')

    <div class="wrapper">
        <!--
            Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
        -->
        <div class="main-header" data-background-color="purple">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="index.html" class="logo">
                    <!--<img src="template/assets/img/logoazzara.svg" alt="navbar brand" class="navbar-brand">-->
                    RG
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize btn-rounded">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item toggle-nav-search hidden-caret">
                            <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                            </a>
                            <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                                <li>
                                    <div class="dropdown-title d-flex justify-content-between align-items-center">
                                        Messages
                                        <a href="#" class="small">Mark all as read</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="message-notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="template/assets/img/jm_denis.jpg" alt="Img Profile">
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Jimmy Denis</span>
                                                    <span class="block">
														How are you ?
													</span>
                                                    <span class="time">5 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="template/assets/img/chadengle.jpg" alt="Img Profile">
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Chad</span>
                                                    <span class="block">
														Ok, Thanks !
													</span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="template/assets/img/mlane.jpg" alt="Img Profile">
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Jhon Doe</span>
                                                    <span class="block">
														Ready for the meeting today...
													</span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="template/assets/img/talha.jpg" alt="Img Profile">
                                                </div>
                                                <div class="notif-content">
                                                    <span class="subject">Talha</span>
                                                    <span class="block">
														Hi, Apa Kabar ?
													</span>
                                                    <span class="time">17 minutes ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">4</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-scroll scrollbar-outer">
                                        <div class="notif-center">
                                            <a href="#">
                                                <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
                                                <div class="notif-content">
													<span class="block">
														New user registered
													</span>
                                                    <span class="time">5 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-icon notif-success"> <i class="fa fa-comment"></i> </div>
                                                <div class="notif-content">
													<span class="block">
														Rahmad commented on Admin
													</span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-img">
                                                    <img src="template/assets/img/profile2.jpg" alt="Img Profile">
                                                </div>
                                                <div class="notif-content">
													<span class="block">
														Reza send messages to you
													</span>
                                                    <span class="time">12 minutes ago</span>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                                <div class="notif-content">
													<span class="block">
														Farrah liked Admin
													</span>
                                                    <span class="time">17 minutes ago</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar avatar-online">
                                    <span class="avatar-title rounded-circle border border-white text-white" ng-class="{'bg-info': numero_generado==1, 'bg-danger': numero_generado==2, 'bg-success': numero_generado==3, 'bg-warning': numero_generado==4}"><strong>{{ Session::get('letra_inicial') }}</strong></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="{{ asset('') }}template/assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4>Hizrian</h4>
                                            <p class="text-muted">hello@example.com</p><a href="" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <!--<a class="dropdown-item" href="#">My Profile</a>
                                    <a class="dropdown-item" href="#">My Balance</a>
                                    <a class="dropdown-item" href="#">Inbox</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Account Setting</a>-->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('usuario/logout') }}"><i class="fas fa-power-off text-danger"></i> Cerrar Sesion</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-background"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <div class="avatar avatar-online">
                                <span class="avatar-title rounded-circle border border-white text-white text-bold" ng-class="{'bg-info': numero_generado==1, 'bg-danger': numero_generado==2, 'bg-success': numero_generado==3, 'bg-warning': numero_generado==4}"><strong>{{ Session::get('letra_inicial') }}</strong></span>
                            </div>
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Session::get('nombres') }}
									<span class="user-level">{{ Session::get('nom_nivel') }}</span>
									<span class="caret"></span>
								</span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <!-- <li>
                                         <a href="#profile">
                                             <span class="link-collapse">My Profile</span>
                                         </a>
                                     </li>
                                     <li>
                                         <a href="#edit">
                                             <span class="link-collapse">Edit Profile</span>
                                         </a>
                                     </li> -->
                                    <li>
                                        <a href="{{ url('usuario/logout') }}">
                                            <span class="link-collapse">Cerrar Sesión</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item active">
                            <a href="{{ url('home') }}">
                                <i class="fas fa-home"></i>
                                <p>Inicio</p>
                                <!--<span class="badge badge-count">5</span>-->
                            </a>
                        </li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
                            <h4 class="text-section">Opciones</h4>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ url('paciente') }}">
                                <i class="fas fa-user"></i>
                                <p>Paciente</p>
                                <!--<span class="badge badge-count">5</span>-->
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ url('empresa') }}">
                                <i class="fas fa-handshake"></i>
                                <p>Empresa</p>
                                <!--<span class="badge badge-count">5</span>-->
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ url('seguimiento') }}">
                                <i class="fas fa-fighter-jet"></i>
                                <p>Seguimientos</p>
                                <!--<span class="badge badge-count">5</span>-->
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a data-toggle="collapse" href="#charts" class="collapsed" aria-expanded="false" >
                                <i class="fas fa-chart-pie"></i>
                                <p>Reportes</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav nav-collapse">
                                    <li><a href="{{ url('reporte_seguimiento') }}"><span class="sub-item">Reporte Seguimiento</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item" >
                            <a href="{{ url('usuario') }}">
                                <i class="fas fa-users"></i>
                                <p>Usuarios</p>
                                <!--<span class="badge badge-count">5</span>-->
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        @yield('container-header')
                        <!--<h4 class="page-title">Dashboard</h4>-->
                    </div>

                    @yield('content')
                </div>
            </div>

        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Topbar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeMainHeaderColor" data-color="blue"></button>
                            <button type="button" class="selected changeMainHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeMainHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeMainHeaderColor" data-color="green"></button>
                            <button type="button" class="changeMainHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeMainHeaderColor" data-color="red"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Background</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                            <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                            <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="flaticon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>

@endsection

@section('javascripts')
    <!--   Core JS Files   -->
    <script src="{{ asset('template/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('template/assets/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('template/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('template/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('template/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('template/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>


    <!-- Sweet Alert -->
    <script src="{{ asset('template/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Azzara JS -->
    <script src="{{ asset('template/assets/js/ready.min.js') }}"></script>

    <script src="{{ asset('js/plugins/select2/select2.full.min.js') }}"></script>

    <script src="{{ asset('plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>




    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- <script src="js/bootstrap-datepicker.js"></script>-->

    <!-- Sweet alert -->
    <!-- <script src="js/plugins/sweetalert/sweetalert.min.js"></script> -->

    <!-- Full Calendar -->
    <!--<script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>-->
    <!--<script src="js/FullCalendar_v1.6.4.js"></script>-->

    <!-- Librerias AngularJS -->
    <script src="{{ asset('js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('js/angular/app.js') }}"></script>
    <script src="{{ asset('js/angular/services.js') }}"></script>
    <script src="{{ asset('js/angular/angular-datatables.min.js') }}"></script>
    <script src="{{ asset('js/angular/ng-alertify.js') }}"></script>
    <script src="{{ asset('js/accesorios.js') }}"></script>
    <script src="{{ asset('js/numeric.js') }}"></script>
    <!--<script type="text/javascript" src="js/cssrefresh.js"></script>-->
    <!-- Dual Listbox -->
    <!--<script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>-->
    <script>
        $(function () {
            //Notify


            $(window).resize(function() {
                $(window).width();
            });


            $('.changeMainHeaderColor').on('click', function(){
                if($(this).attr('data-color') == 'default'){
                    $('.main-header').removeAttr('data-background-color');
                } else {
                    $('.main-header').attr('data-background-color', $(this).attr('data-color'));
                }

                $(this).parent().find('.changeMainHeaderColor').removeClass("selected");
                $(this).addClass("selected");
                layoutsColors();
            });

            $('.changeBackgroundColor').on('click', function(){
                $('body').removeAttr('data-background-color');
                $('body').attr('data-background-color', $(this).attr('data-color'));
                $(this).parent().find('.changeBackgroundColor').removeClass("selected");
                $(this).addClass("selected");
            });

            var toggle_customSidebar = false,
                custom_open = 0;

            if(!toggle_customSidebar) {
                var toggle = $('.custom-template .custom-toggle');

                toggle.on('click', (function(){
                        if (custom_open == 1){
                            $('.custom-template').removeClass('open');
                            toggle.removeClass('toggled');
                            custom_open = 0;
                        }  else {
                            $('.custom-template').addClass('open');
                            toggle.addClass('toggled');
                            custom_open = 1;
                        }
                    })
                );
                toggle_customSidebar = true;
            }
        });
    </script>

@endsection
