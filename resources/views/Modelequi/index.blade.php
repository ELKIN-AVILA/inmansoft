@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Modelo equipo
@endsection

@section('contentheader_title')
    Modelo equipo
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
    <div class="panel-success">
            <div class="panel-heading" style="text-align:center;">Listado de Modelos de Equipos</div>
        
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca Equipo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($modelequi as $mmodel)
                    <tr>
                        <td>{{ $mmodel->id }}</td>
                        <td>{{ $mmodel->nombre }}</td>
                        @foreach($marcaequi as $mmar)
                            @if($mmodel->marcaequi_id == $mmar->id)
                                <td>{{ $mmar->nombre }}</td>
                            @endif
                        @endforeach
                        <td><button class="btn btn-warning" onclick="editar({{ $mmodel->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mmodel->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
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
              <h4 class="modal-title">Crear Modelo de equipo</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text"  maxlength="45"  minlength="1" name="nombre" id="nombre" class="form-control required"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Marca de equipo:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="marcaequi_id" id="marcaequi_id" class="form-control required">
                                <option value="">----Selecione----</option>
                                @foreach($marcaequi as $mmar)
                                    <option value="{{ $mmar->id }}">{{ $mmar->nombre }}</option>
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
              <h4 class="modal-title">Editar Modelo de Equipo</h4>
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
                            <input type="text" maxlength="45" minlength="1" name="nombreedi" id="nombreedi" class="form-control required"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                            <div class="col-sm-4">
                                <label for="">Marca de equipo:</label>
                            </div>
                            <div class="col-sm-8">
                                <select name="marcaequi_idedi" id="marcaequi_idedi" class="form-control required">
                                    <option value="">----Selecione----</option>
                                    @foreach($marcaequi as $mmar)
                                        <option value="{{ $mmar->id }}">{{ $mmar->nombre }}</option>
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

<script src="{{ asset('/js/Modelequi/index.js') }}" type="text/javascript"></script>

@endsection