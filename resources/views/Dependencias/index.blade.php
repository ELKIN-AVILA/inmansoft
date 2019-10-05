@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Dependencias
@endsection

@section('contentheader_title')
    Dependencias
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($dependencias as $mde)
                    <tr>
                        <td>{{ $mde->id }}</td>
                        <td>{{ $mde->nombre }}</td>
                        @foreach($departamentos as $mdepar)
                            @if($mdepar->id == $mde->departamentos_id)
                                <td>{{ $mdepar->nombre}}</td>
                            @endif
                        @endforeach
                        <td><button class="btn btn-warning" onclick="editar({{ $mde->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mde->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
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
              <h4 class="modal-title">Crear Dependencias</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
            
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Sede:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="sede_id" id="sede_id" class="form-control" onchange="traedepar(this);">
                                <option value="">-----Selecione-----</option>
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
                                <select name="departamentos_id" id="departamentos_id" class="form-control required">
                                  
                                </select>
                            </div>
                        </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45"  name="nombre" id="nombre" class="form-control required"> 
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
              <h4 class="modal-title">Editar Dependencias</h4>
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
                            <input type="text" name="nombreedi" id="nombreedi" class="form-control"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Departamentos:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="departamentosedi" id="departamentosedi" class="form-control">
                                <option value="">-----Selecione-----</option>
                                @foreach($departamentos as $mdepart)
                                    <option value="{{ $mdepart->id }}">{{ $mdepart->nombre }}</option>
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
<script src="{{ asset('/js/Dependencias/index.js') }}" type="text/javascript"></script>
@endsection