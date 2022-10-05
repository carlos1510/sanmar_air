@extends('main')

@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Empresa</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                            <li class="breadcrumb-item active">Empresa</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrar Empresa</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip01">RUC.:</label>
                                        <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip02">RAZON SOCIAL:</label>
                                        <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required>
                                        <div class="valid-tooltip">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltipUsername">TELEFONO:</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                            <input type="text" class="form-control" id="validationTooltipUsername" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                                            <div class="invalid-tooltip">
                                                Please choose a unique and valid username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip03">DIRECCION</label>
                                        <input type="text" class="form-control" id="validationTooltip03" placeholder="City" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid city.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="validationTooltip04">CORREO ELECTRONICO</label>
                                        <input type="text" class="form-control" id="validationTooltip04" placeholder="State" required>
                                        <div class="invalid-tooltip">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">GUARDAR</button>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>

    </div>
@endsection
