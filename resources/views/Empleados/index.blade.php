@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Empleados
@endsection

@section('contentheader_title')
    Empleados
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <div class="panel-success">
            <div class="panel-heading" style="text-align:center;">Listado de Empleados</div>
        
    <table class="table table-bordered" id="datos">
        <thead>
            <th>Primer Nombre</th>
            <th>Primer Apellido</th>
            <th>Cargo</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach($empleados as $memple)
                <tr>
                    <td>{{ $memple->prinom }}</td>
                    <td>{{ $memple->priape }}</td>
                    @foreach($cargo as $mcar)
                            @if($memple->cargo_id == $mcar->id)
                                    <td>{{ $mcar->nombre }}</td>
                            @endif
                    @endforeach
                    <td>
                        <button class="btn btn-warning" onclick="editar({{ $memple->id }})" data-toggle="tooltip" data-placement="right" title="Editar"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="eliminar({{ $memple->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button>
                    </td>
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
              <h4 class="modal-title">Crear Empleado</h4>
            </div>
            <div class="modal-body">
                <form action="" id="formulario">
                <div class="row">
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Primer Nombre:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="45" id="prinom" name="prinom" class="form-control required">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Segundo Nombre:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="45" id="segnom" name="segnom" class="form-control">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Primer Apellido:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="45" id="priape" name="priape" class="form-control">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Segundo Apellido:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="45" id="segape" name="segape" class="form-control">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Cargo:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="cargo_id" id="cargo_id" class="form-control">
                               <option value="">-----Selecione-----</option>
                                @foreach($cargo as $mcar)
                                    <option value="{{ $mcar->id }}">{{ $mcar->nombre }}</option>
                                @endforeach
                            </select>
                       </div>
                   </div>
                   <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Correo:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="email" minlength="" pattern="" id="correo" name="correo" class="form-control">
                        </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Celular:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="number" maxlength="11" name="celular" id="celular" class="form-control">
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
      </div>
    <!--fin modal nuevo -->
      <!-- modal edit -->


    <div class="modal fade" id="editar" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar Empleado</h4>
            </div>
            <form action="" id="formularioedi">
            <div class="modal-body">
                <input type="hidden" name="idedi" id="idedi">
                <div class="row">
                    
                   <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Primer Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45" id="prinomedi" name="prinomedi" class="form-control required">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Segundo Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45" id="segnomedi" name="segnomedi" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Primer Apellido:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45" id="priapeedi" name="priapeedi" class="form-control required">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Segundo Apellido:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" minlength="1" maxlength="45" id="segapeedi" name="segapeedi" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Cargo:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="cargo_idedi" id="cargo_idedi" class="form-control required">
                                <option value="">-----Selecione-----</option>
                                 @foreach($cargo as $mcar)
                                     <option value="{{ $mcar->id }}">{{ $mcar->nombre }}</option>
                                 @endforeach
                             </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                         <div class="col-sm-4">
                             <label for="">Correo:</label>
                         </div>
                         <div class="col-sm-8">
                             <input type="email" pattern="" id="correoedi" name="correoedi" class="form-control required">
                         </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Celular:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="tel" name="celularedi" id="celularedi" class="form-control required">
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
      
@endsection

@section('script')

<script src="{{ asset('/js/Empleados/index.js') }}" type="text/javascript"></script>
  
@endsection
