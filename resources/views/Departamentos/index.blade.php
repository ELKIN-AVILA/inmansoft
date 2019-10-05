@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Departamentos
@endsection

@section('contentheader_title')
    Departamentos
@endsection

@section('main-content')
	<div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!--Table -->
    <table class="table table-bordered" id="datos">
        <thead>
            <th>#</th>
            <th>Nombre</th>
            <th>Sede</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($departamentos as $mdepar)
                <tr>
                    <td>{{ $mdepar->id }}</td>
                    <td>{{ $mdepar->nombre }}</td>
                    @foreach($sedes as $msede)
                        @if($msede->id==$mdepar->sede_id)
                            <td>{{ $msede->nombre }}</td>
                        @endif
                    @endforeach
                    <td><button class="btn btn-warning" onclick="editar({{ $mdepar->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mdepar->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    <!-- -->
    <!-- modal nuevo-->
    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Departamento</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text"  name="nombre" id="nombre" class="form-control required"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Sede:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="sede_id" id="sede_id" class="form-control required">
                                <option value="">--Selecione--</option>
                                @foreach($sedes as $msede)
                                    <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" >Guardar</button>
            </div>
            </form>
          </div>
          
        </div>
      </div>
    <!--fin modal nuevo -->
     <!-- modal editar-->
     <div class="modal fade" id="editar" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar Departamento</h4>
                </div>
                <form action="" id="formularioedi">
                <div class="modal-body">
                    <input type="hidden" name="idedi" id="idedi">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label for="">Nombre:</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" minlength="4" maxlength="45" name="nombreedi" id="nombreedi" class="form-control required"> 
                            </div>
                        </div>
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Sede:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="sede_idedi" id="sede_idedi" class="form-control required">
                                        <option value="">--Selecione--</option>
                                        @foreach($sedes as $msede)
                                            <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
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
        <!--fin modal editar -->
@endsection
@section('script')
<script src="{{ asset('/js/Departamentos/index.js') }}" type="text/javascript"></script>
@endsection
