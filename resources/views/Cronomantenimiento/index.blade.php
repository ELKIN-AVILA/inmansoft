@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Cronograma mantenimiento
@endsection

@section('contentheader_title')
    Cronograma mantenimiento
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- table cronograma-->
        <table class="table table-bordered">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($cronomantenimiento as $mcro)
                    <tr>
                        <td>{{ $mcro->id }}</td>
                        <td>{{ $mcro->nombre }}</td>
                        <td><button class="btn btn-success" onclick="agregar({{ $mcro->id }})" data-toggle="tooltip" data-placement="left" title="Agregar"><i class="fa fa-plus-square"></i></button><button class="btn btn-warning" onclick="editar({{ $mcro->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mcro->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button><a href="{{ url("/Cronomantenimiento/reporte/$mcro->id") }}" class="btn btn-info">s</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <!---->
    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Cronograma de Mantenimiento <caption></caption></h4>
            </div>
           <form action="" id="formulario">
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
                <button class="btn btn-success" type="submit">Guardar</button>
            </div>
           </form>
          </div>
          
        </div>
      </div>
    <!--fin modal nuevo -->
    <div class="modal fade" id="agregar" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Agregar  Cronograma de Mantenimiento <caption></caption></h4>
            </div>
           <form action="" id="formularioag">
            <div class="modal-body">
                <input type="hidden" name="idag" id="idag">
                <input type="hidden" name="idjefe" id="idjefe">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Mantenimiento:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="mantenimiento" name="mantenimiento" class="form-control required" disabled>
                        </div>
                    </div>
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
                            <label for="">Dependencias:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="dependencias_id" id="dependencias_id" class="form-control required" onchange="traerjefe(this)">
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Jefe Dependencias:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="jefedepar" name="jefedepar" class="form-control required" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Fecha:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text"   id="date_range" name="date_range" class="form-control required">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Guardar</button>
            </form>
                <div class="col-sm-12">
                    <h2>Listado De Mantenimientos</h2>
                    <table class="table table-bordered" id="tablecrono">
                        <thead>
                            <th>Sede</th>
                            <th>Departamentos</th>
                            <th>Dependencias</th>
                            <th>Fecha Inicial</th>
                            <th>Fecha Final</th>
                            
                        </thead>
                        <tbody id="tablecr">

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          
        </div>
      </div>
    <!-- add crono -->

    <!-- end crono-->

@endsection

@section('script')

<script src="{{ asset('/js/Cronomantenimiento/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/notify.js') }}" type="text/javascript"></script>
@endsection
