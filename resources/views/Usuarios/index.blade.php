@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Crear Usuarios
@endsection

@section('contentheader_title')
   Crear usuarios
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
    <div class="panel-success">
            <div class="panel-heading" style="text-align:center;">Listado de Usuarios</div>
        
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($usuarios as $musu)
                    <tr>
                        <td>{{ $musu->id }}</td>
                        <td>{{ $musu->name }}</td>
                        <td><button class="btn btn-warning" onclick="editar({{ $musu->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $musu->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <!--end Table -->

    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Usuario</h4>
            </div>
            <form id="formulario">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45" name="nombre" id="nombre" class="form-control"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Correo:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" name="correo" id="correo" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Contraseña:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" name="contrasena" id="contrasena" class="form-control" minlength="4" maxlength="8">
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
              <h4 class="modal-title">Editar Contraseña Usuario</h4>
            </div>
            <form action="" id="formularioedi">
            <div class="modal-body">
                <input type="hidden" name="idedi" id="idedi">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Contraseña:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="password" name="contrasenaedit" id="contrasenaedit" class="form-control">
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

<script src="{{ asset('/js/Usuarios/index.js') }}" type="text/javascript"></script>

@endsection
