@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Programas
@endsection

@section('contentheader_title')
    Programas
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
    <div class="panel-success">
            <div class="panel-heading" style="text-align:center;">Listado de Programas</div>
        
        <table class="table table-bordered" id="datos">
            <thead>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($programas as $mpro)
                    <tr>
                        <td>{{ $mpro->nombre }}</td>
                        <td><button class="btn btn-warning" onclick="editar({{ $mpro->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button> <button class="btn btn-danger" onclick="eliminar({{ $mpro->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button> <button class="btn btn-info" onclick="agregar({{ $mpro->id }})" data-toggle="tooltip" data-placement="right" title="Agregar version"><i class="fa fa-plus-circle"></i></button> </td>
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
              <h4 class="modal-title">Crear Programa</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
               <div class="row">
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Nombre:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="45" name="nombre" id="nombre" class="form-control required">
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
              <h4 class="modal-title">Editar Programa</h4>
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
                            <input type="text" minlength="1" maxlength="45" name="nombreedi" id="nombreedi" class="form-control required">
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
      <!-- modal agregar -->


      <div class="modal fade" id="agregar" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Agregar Version programa</h4>
            </div>
            <form action="" id="formularioagr">
            <div class="modal-body">
                <input type="hidden" name="idag" id="idag">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Nombre:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="nombrepro" name="nombrepro" class="form-control" disabled> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Numero Version:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="numver" name="numver" class="form-control">
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-sm-12" style="text-align:end">
                        <button class="btn btn-success" type="submit">Guardar</button>

                </div>
                <hr>
            </div>
        </form>

            <div class="modal-footer">
                <div class="col-sm-12">
                        <table class="table table-bordered" id="versiones">
                            <thead>
                                <th>#</th>
                                <th>Version</th>
                                <th>Accion</th>
                            </thead>
                            <tbody id="tabver">
                                
                            </tbody>
                        </table>
                    </div>
            </div>
          </div>
                
        </div>
      </div>

      <!-- end edit-->
@endsection

@section('script')

<script src="{{ asset('/js/Programas/index.js') }}" type="text/javascript"></script>

@endsection