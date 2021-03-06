@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Roles
@endsection

@section('contentheader_title')
  Roles
@endsection

@section('main-content')
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
            </div>
        </div>
        <div class="panel-success">
                <div class="panel-heading" style="text-align:center;">Listado de Roles</div>
            
        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Nombre</th>
            </thead>
            <tbody>
                @foreach($roles as $mrol)
                    <tr>
                        <td>{{ $mrol->id }}</td>
                        <td>{{ $mrol->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Rol</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="40" name="nombre" id="nombre" class="form-control required"> 
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="guardar();">Guardar</button>
            </div>
          </div>
          
        </div>
      </div>
 
@endsection
@section('script')
<script src="{{ asset('js/Roles/index.js') }}" defer></script>
@endsection

