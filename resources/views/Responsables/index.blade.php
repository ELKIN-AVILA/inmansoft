@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Responsables
@endsection

@section('contentheader_title')
    Responsables
@endsection
@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Responsable</th>
                <th>Equipo</th>
                <th></th>      
            </thead>
            <tbody>
                @foreach($responsables as $mres)
                    <tr>
                        <td>{{ $mres->id }}</td>
                        @foreach($empleados as $memple)
                            @if($mres->empleados_id == $memple->id )
                                <td>{{ $memple->priape }}{{ $memple->prinom }}</td>
                            @endif
                        @endforeach
                        @foreach($equipos as $mequi)
                            @if($mres->equipos_id == $mequi->id)
                                <td>{{ $mequi->numplaca }}</td>
                            @endif
                        @endforeach
                       
                        <td><button class="btn btn-warning" onclick="editar({{ $mres->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mres->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
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
              <h4 class="modal-title">Asginar responsable de equipo</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
                <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Equipo:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="equipos_id" id="equipos_id" class="form-control">
                                        <option value="">---Selecione---</option>
                                        @foreach($equipos as $mequi)
                                            <option value="{{ $mequi->id }}">{{ $mequi->numplaca }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Responsable:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="empleados_id" id="empleados_id" class="form-control">
                                        <option value="">---Selecione---</option>
                                        @foreach($empleados as $mres)
                                            <option value="{{ $mres->id }}">{{ $mres->priape }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                    
                </div>
            </div>
            <div class="modal-footer">
                    <button type="submit"  style="float:right;"  class="btn btn-success">Guardar</button>
                
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
              <h4 class="modal-title">Editar Proveedor</h4>
            </div>
            <form action="" id="formularioedi">
                <div class="modal-body">
                    <input type="hidden" name="idedi" id="idedi">
                    <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Equipo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="equipos_idedi" id="equipos_idedi" class="form-control">
                                            <option value="">---Selecione---</option>
                                            @foreach($equipos as $mequi)
                                                <option value="{{ $mequi->id }}">{{ $mequi->numplaca }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Responsable:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="empleados_idedi" id="empleados_idedi" class="form-control">
                                            <option value="">---Selecione---</option>
                                            @foreach($empleados as $mres)
                                                <option value="{{ $mres->id }}">{{ $mres->priape }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>    
                        
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="submit"  style="float:right;"  class="btn btn-success">Guardar</button>
                    
                </div>
                </form>
          </div>
          
        </div>
      </div>
      <!-- end edit-->
@endsection

@section('script')

<script src="{{ asset('/js/Responsables/index.js') }}" type="text/javascript"></script>

@endsection