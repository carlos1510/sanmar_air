<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ url('/') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Inicio</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('paciente') }}">
                        <i class="fas fa-users"></i>
                        <span data-key="t-horizontal">Paciente</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('empresa') }}">
                        <i data-feather="layout"></i>
                        <span data-key="t-horizontal">Empresas</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('seguimiento') }}">
                        <i class="fas fa-plane"></i>
                        <span data-key="t-horizontal">Seguimiento</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="pie-chart"></i>
                        <span data-key="t-apps">Reporte</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);">
                                <span><i class="far fa-circle"></i> Seguimiento</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('usuario') }}">
                        <i data-feather="users"></i>
                        <span data-key="t-horizontal">Usuarios</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
