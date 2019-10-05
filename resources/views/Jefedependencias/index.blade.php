@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Jefe dependencia
@endsection

@section('contentheader_title')
    Jefe dependencia
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Sede</th>
                <th>Departamento</th>
                <th>Dependencia</th>
                <th>Empleado</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($jefedepar as $mdepar)
                    <tr>
                        <td>{{ $mdepar->id }}</td>
                        @foreach($sede as $msede)
                            @if($msede->id==$mdepar->sede_id)
                                <td>{{ $msede->nombre }}</td>
                            @endif
                        @endforeach
                        @foreach($departamentos as $mdeparr)
                            @if($mdeparr->id==$mdepar->departamentos_id)
                                <td>{{ $mdeparr->nombre }}</td>
                            @endif
                            
                        @endforeach
                        @foreach($dependencias as $mdep)
                            @if($mdepar->dependencias_id == $mdep->id)
                                <td>{{ $mdep->nombre }}</td>
                            @endif
                        @endforeach
                        @foreach($empleados as $mempleados)
                            @if($mempleados->id==$mdepar->empleados_id)
                                <td>{{ $mempleados->priape }} {{ $mempleados->segape }} {{ $mempleados->prinom }} {{ $mempleados->segnom }}</td>
                            @endif
                        @endforeach
                        <td><button class="btn btn-warning" onclick="editar({{ $mdepar->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mdepar->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    <!--end Table -->

    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Jefe Dependencia</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Sede:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="sede_id" id="sede_id" class="form-control required" onchange="depart(this)">
                                <option value="">---Selecione---</option>
                                @foreach($sede as $msede)
                                    <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Departamentos:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="departamentos_id" id="departamentos_id" class="form-control required" onchange="dependencias(this)">

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Dependencia:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="dependencias_id" id="dependencias_id" class="form-control required">

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Empleado:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="empleados_id" id="empleados_id" class="form-control required">
                                @php
                                    $cont=0;
                                @endphp
                                <option value="">---Selecione---</option>
                                    @foreach($empleados as $memple)
                                        
                                        <option value="{{ $memple->id }}">{{ $memple->priape }} {{ $memple->segape }} {{ $memple->prinom }} {{ $memple->segnom }}</option>
                                       
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
            </form>
          </div>
          
        </div>
      </div>
    <!--fin modal nuevo -->
      <!-- modal edit -->


    <div class="modal fade" id="editar" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar Jefe Departamento</h4>
            </div>
            <form action="" id="formularioedi">
            <div class="modal-body">
                <input type="hidden" name="idedi" id="idedi">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Sede:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="sede_idedi" id="sede_idedi" class="form-control required" onchange="departa(this)" disabled>
                                <option value="">---Selecione---</option>
                                @foreach($sede as $msede)
                                    <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Departamentos:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="departamentos_idedi" id="departamentos_idedi" class="form-control required" onchange="dependenciasedi(this)">
                                <option value="">---Selecione---</option>
                                @foreach($departamentos as $mdepar)
                                    <option value="{{ $mdepar->id }}">{{ $mdepar->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Dependencia:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="dependencias_idedi" id="dependencias_idedi" class="form-control required">
                                <option value="">---Selecione---</option>
                                @foreach($dependencias as $mdep)
                                    <option value="{{ $mdep->id }}">{{ $mdep->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Empleado:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="empleados_idedi" id="empleados_idedi" class="form-control required">
                                <option value="">---Selecione---</option>
                                    @foreach($empleados as $memple)
                                        <option value="{{ $memple->id }}">{{ $memple->priape}} {{ $memple->segape }} {{ $memple->prinom }} {{ $memple->segnom }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
            </form>
          </div>
          
        </div>
      </div>
      <!-- end edit-->
@endsection

@section('script')
<script src="{{ asset('/js/Jefedependencias/index.js') }}" type="text/javascript"></script>
@endsection