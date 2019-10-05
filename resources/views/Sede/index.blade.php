@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Sedes
@endsection

@section('contentheader_title')
    Sedes
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
                <th>Estado</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($sedes as $msedes)
                    <tr>
                        <td>{{ $msedes->id }}</td>
                        <td>{{ $msedes->nombre }}</td>
                        @if($msedes->estado=="A")
                            <td>ACTIVO</td>
                        @else
                            <td>INACTIVO</td>
                        @endif
                        <td><button class="btn btn-warning" onclick="editar({{ $msedes->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $msedes->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
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
              <h4 class="modal-title">Crear Sede</h4>
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
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Estado:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="estadoid" id="estadoid" class="form-control required">
                               <option value="">---Selecione---</option>
                               @php
                                $estado=array('A'=>'ACTIVO','I'=>'INACTIVO');    
                               @endphp
                               @foreach($estado as $item=>$valor)
                                    <option value="{{ $item}}">{{$valor}}</option>
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
              <h4 class="modal-title">Editar Sede</h4>
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
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Estado:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="estadoidedi" id="estadoidedi" class="form-control required">
                                <option value="">---Selecione---</option>
                                @php
                                 $estado=array('A'=>'ACTIVO','I'=>'INACTIVO');    
                                @endphp
                                @foreach($estado as $item=>$valor)
                                     <option value="{{ $item}}">{{$valor}}</option>
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

<script src="{{ asset('/js/Sede/index.js') }}" type="text/javascript"></script>

@endsection