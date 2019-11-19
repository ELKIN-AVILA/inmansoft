@extends('adminlte::layouts.app')

@section('htmlheader_title')
  Permiso por rol
@endsection

@section('contentheader_title')
  Permiso por rol
@endsection

@section('main-content')
        <div class="row">
            <div class="form-group">
                <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
            </div>
        </div>
        <div class="panel-success">
                <div class="panel-heading" style="text-align:center;">Listado de Permisos por rol</div>
            
        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Rol</th>
                <th>Permiso</th>
            </thead>
            <tbody>
                @foreach($permixrol as $mper)
                    <tr>
                        <td>{{ $mper->id }}</td>
                        @foreach($rol as $mrol)
                            @if($mrol->id==$mper->role_id)
                                <td>{{ $mrol->name }}</td>
                            @endif
                        @endforeach
                        @foreach($permisos as $mpermi)
                            @if($mpermi->id==$mper->permission_id)
                                <td>{{ $mpermi->name }}</td>
                            @endif
                        @endforeach
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
              <h4 class="modal-title">Asignar permiso a rol</h4>
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
                            <label for="">Permiso:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="permisos_id" id="permisos_id" class="form-control">
                                <option value="">--Seleccione--</option>
                                @foreach($permisos as $mper)
                                    <option value="{{ $mper->id }}">{{ $mper->name }}</option>
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
<script src="{{ asset('js/Permisosxrol/index.js') }}" defer></script>
@endsection
