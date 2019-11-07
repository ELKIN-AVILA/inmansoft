@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Rol de usuario
@endsection

@section('contentheader_title')
  Rol de usuario
@endsection

@section('main-content')
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <th>Rol</th>
                <th>Usuario</th>
            </thead>
            <tbody>
                @foreach($rolxuser as $mrolxuser)
                    <tr>
                        @foreach($rol as $mrol)
                            @if($mrol->id==$mrolxuser->role_id)
                                <td>{{ $mrol->name }}</td>
                            @endif
                        @endforeach
                        @foreach($usuarios as $musu)
                            @if($musu->id==$mrolxuser->model_id)
                                <td>{{ $musu->name }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asignar Rol a Usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Rol:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="rol_id" id="rol_id" class="form-control">
                                <option value="">--Seleccione--</option>
                                @foreach($rol as $mrol)
                                    <option value="{{ $mrol->id }}">{{ $mrol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Usuario:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="usuarios_id" id="usuarios_id" class="form-control">
                                <option value="">--Seleccione--</option>
                                @foreach($usuarios as $musu)
                                    <option value="{{ $musu->id }}">{{ $musu->name }}</option>
                                @endforeach
                            </select>
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
<script src="{{ asset('js/Rolxuser/index.js') }}" defer></script>

@endsection
