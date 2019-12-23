@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Reportes
@endsection

@section('contentheader_title')
    Reportes
@endsection

@section('main-content')
  <div class="panel panel-primary">
    <div class="panel-heading">Reporte de Mantenimiento general </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <label for=""><strong>Sede:</strong></label>
                </div>
                <div class="col-sm-8">
                    <select name="sedes" id="sedes" class="form-control">
                        <option value="">--Seleccione--</option>
                        @foreach($sedes as $msede)
                            <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br><br>
            <div class="col-sm-12"> 
                <div class="col-sm-3">
                    <label for=""><strong> Fecha Inicial:<strong></label>
                </div>
                <div class="col-sm-3">
                    <input type="date" name="fechaini" id="fechaini" class="form-control">
                </div>
                <div class="col-sm-3">
                        <label for=""><strong> Fecha Final:<strong></label>
                    </div>
                <div class="col-sm-3">
                        <input type="date" name="fechafin" id="fechafin" class="form-control">
                </div>
                
            </div>
            <div class="col-sm-12" style="text-align:center;">
                <br>
                <button class="btn btn-success" onclick="generaequi();">Generar Reporte</button>
            </div>
        </div>
    </div>
  </div>
  <!-- Reporte de sedes,departamentos,dependencias y jefe dependencias --->
<div class="panel panel-primary">
    <div class="panel-heading">Reporte de Sedes</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12" style="text-align:center;">
                    <a class="btn  btn-success" href='/Reportes/Sedes'>Generar Reporte</a>
            </div>
        </div>
    </div>
</div>
<!-- Reporte de localizacion--->
<div class="panel panel-primary">
        <div class="panel-heading">Reporte de Localizacion</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12" style="text-align:center;">
                        <a class="btn  btn-success" href='/Reportes/Localizacion'>Generar Reporte</a>
                </div>
            </div>
        </div>
</div>
<!--Reporte de empleados -->
<div class="panel panel-primary">
    <div class="panel-heading">Reporte de Empleados</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12" style="text-align:center;">
                    <a class="btn  btn-success" href='/Reportes/Empleados'>Generar Reporte</a>
            </div>
        </div>
    </div>
</div>
<!-- fin reporte -->
<!-- Reporte de responsable de equipos--->
<div class="panel panel-primary">
    <div class="panel-heading">Reporte de Responsables de Equipos</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12" style="text-align:center;">
                    <a class="btn  btn-success" href='/Reportes/Responsables'>Generar Reporte</a>
            </div>
        </div>
    </div>
</div>
<!--- fin reporte--->
<!---Reporte de proveedores-->
<div class="panel panel-primary">
    <div class="panel-heading">Reporte de Proveedores</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12" style="text-align:center;">
                    <a class="btn  btn-success" href='/Reportes/Proveedores'>Generar Reporte</a>
            </div>
        </div>
    </div>
</div>
<!-- fin reporte--->
@endsection

@section('script')

<script src="{{ asset('/js/Reportes/index.js') }}" type="text/javascript"></script>

@endsection