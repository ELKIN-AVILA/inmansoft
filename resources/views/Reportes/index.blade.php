@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Reportes
@endsection

@section('contentheader_title')
    Reportes
@endsection

@section('main-content')
  <div class="panel panel-primary">
    <div class="panel-heading">Reporte de Mantenimientos general por año</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <label for="">Sede:</label>
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
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <label for="">Año:</label>
                </div>
                <div class="col-sm-8">
                    <select name="ano" id="ano" class="form-control">
                        <option value="">--Seleccione--</option>
                        @php
                            $cont=date('Y'); 
                        @endphp
                        @while($cont >= 2017)@endphp
                            <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                          @php $cont = ($cont-1); @endphp
                        @endwhile
                    </select>
                </div>
            </div>
            <div class="col-sm-12" style="text-align:center;">
                <br>
                <button class="btn btn-success" onclick="generaequi();">Generar Reporte</button>
            </div>
        </div>
    </div>
  </div>


@endsection

@section('script')

<script src="{{ asset('/js/Reportes/index.js') }}" type="text/javascript"></script>

@endsection