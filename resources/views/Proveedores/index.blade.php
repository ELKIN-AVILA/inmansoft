@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Proveedores
@endsection

@section('contentheader_title')
    Proveedores
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Nit</th>
                <th>Razon Social</th>
                <th>Direccion</th>
                <th>Correo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($proveedores as $mpro)
                    <tr>
                        <td>{{ $mpro->id }}</td>
                        <td>{{ $mpro->nit }}</td>
                        <td>{{ $mpro->razonsoc }}</td>
                        <td>{{ $mpro->direccion }}</td>
                        <td>{{ $mpro->correo }}</td>
                        <td><button class="btn btn-warning" onclick="editar({{ $mpro->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mpro->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
                    </tr>

                @endforeach
                
            </tbody>
        </table>
    <!--end Table -->
    {{ $proveedores->links() }}

    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Proveedor</h4>
            </div>
            <form action="" id="formulario" method="POST">
            <div class="modal-body">
                <div class="row">
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Nit</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="number" name="nit" id="nit"  maxlength="11" class="form-control required">
                       </div>
                   </div> 
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Razon Social:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="80" id="razonsoc" name="razonsoc" class="form-control required">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Dirrecion:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="text" minlength="1" maxlength="80" id="direccion" name="direccion" class="form-control required">
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Correo:</label>
                       </div>
                       <div class="col-sm-8">
                           <input type="email" minlength="1" maxlength="100" id="correo" name="correo" class="form-control required">
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
              <h4 class="modal-title">Editar Proveedor</h4>
            </div>
            <form action="" id="formularioedi">
            <div class="modal-body">
                <input type="hidden" name="idedi" id="idedi">
                <div class="row">
                        <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Nit</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number"  name="nitedi" id="nitedi" minlength="1" maxlength="11" class="form-control">
                                </div>
                            </div> 
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Razon Social:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" minlength="1" maxlength="80" id="razonsocedi" name="razonsocedi" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Dirrecion:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" minlength="1" maxlength="80" id="direccionedi" name="direccionedi" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Correo:</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="email" minlength="1" maxlength="80" id="correoedi" name="correoedi" class="form-control">
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

<script src="{{ asset('/js/Proveedores/index.js') }}" type="text/javascript"></script>

@endsection