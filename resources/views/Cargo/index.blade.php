@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Cargos
@endsection

@section('contentheader_title')
    Cargos
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($cargo as $mcar)
                    <tr>
                        <td>{{ $mcar->id }}</td>
                        <td>{{ $mcar->nombre }}</td>
                        <td><button class="btn btn-warning" onclick="editar({{ $mcar->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mcar->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
                    </tr>

                @endforeach
                
            </tbody>
        </table>
    <!--end Table -->
    {{ $cargo->links() }}

    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Cargo</h4>
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
      <!-- modal edit -->


    <div class="modal fade" id="editar" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Editar Cargo</h4>
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
                            <input type="text" minlength="1" maxlength="40" name="nombreedi" id="nombreedi" class="form-control required"> 
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

<script src="{{ asset('/js/Cargo/index.js') }}" type="text/javascript"></script>

@endsection