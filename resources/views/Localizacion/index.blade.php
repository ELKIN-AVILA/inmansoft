@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Localizacion
@endsection

@section('contentheader_title')
    Localizacion
@endsection

@section('main-content')
    <div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
    </div>
    <!-- Table-->
        <table class="table table-bordered" id="datos">
            <thead>
                <th>#</th>
                <th>Sede</th>
                <th>Departamento</th>
                <th>Dependencias</th>
                <th>Equipos</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($localizacion as $mlocali)
                    <tr>
                        <td>{{ $mlocali->id }}</td>
                      @foreach($sedes as $msede)
                        @if($msede->id==$mlocali->sede_id)
                            <td>{{ $msede->nombre }}</td>
                        @endif
                      @endforeach
                      @foreach($departamentos as $mdepar)
                        @if($mdepar->id==$mlocali->departamentos_id)
                            <td>{{ $mdepar->nombre }}</td>
                        @endif
                      @endforeach
                      @foreach($dependencias as $mdepen)
                        @if($mlocali->dependencias_id==$mdepen->id)
                            <td>{{ $mdepen->nombre }}</td>
                        @endif
                      @endforeach
                      @foreach($equipos as $mequip)
                        @if($mequip->id==$mlocali->equipos_id)
                            <td>{{ $mequip->numplaca }}</td>
                        @endif
                      @endforeach
                        <td><button class="btn btn-warning" onclick="editar({{ $mlocali->id }})" data-toggle="tooltip" data-placement="left" title="Editar"><i class="fa fa-edit"></i></button><button class="btn btn-danger" onclick="eliminar({{ $mlocali->id }})" data-toggle="tooltip" data-placement="right" title="Eliminar"><i class="fa fa-trash"></i></button></td>
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
              <h4 class="modal-title">Crear Localizacion</h4>
            </div>
            <form action="" id="formulario">
            <div class="modal-body">
               <div class="row">
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Sede:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="sede_id" id="sede_id" class="form-control required" onchange="traedepar(this);">
                               <option value="">---Selecione---</option>
                                @foreach($sedes as $msede)
                                    <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                                @endforeach
                            </select>
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Departamento:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="departamentos_id" id="departamentos_id" class="form-control required" onchange="depend(this)">
                              
                            </select>
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Dependencia:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="dependencias_id" id="dependencias_id" class="form-control required">
                           </select>
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="col-sm-4">
                           <label for="">Equipo:</label>
                       </div>
                       <div class="col-sm-8">
                           <select name="equipos_id" id="equipos_id" class="form-control required">
                               <option value="">---Selecione---</option>
                               @foreach($equipos as $mequip)
                                    <option value="{{ $mequip->id }}">{{ $mequip->numplaca }}</option>
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
                                    <label for="">Sede:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="sede_idedi" id="sede_idedi" class="form-control required">
                                        <option value="">---Selecione---</option>
                                         @foreach($sedes as $msede)
                                             <option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
                                         @endforeach
                                     </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Departamento:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="departamentos_idedi" id="departamentos_idedi" class="form-control required" onchange="dependi(this)">
                                        <option value="">---Selecione---</option>        
                                         @foreach($departamentos as $mdepar)
                                             <option value="{{ $mdepar->id }}">{{ $mdepar->nombre }}</option>
                                         @endforeach
                                     </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Dependencia:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="dependencias_idedi" id="dependencias_idedi" class="form-control required">
                                        <option value="">---Selecione---</option>
                                        @foreach($dependencias as $mdepen)
                                            <option value="{{ $mdepen->id }}">{{ $mdepen->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-4">
                                    <label for="">Equipo:</label>
                                </div>
                                <div class="col-sm-8">
                                    <select name="equipos_idedi" id="equipos_idedi" class="form-control required">
                                        <option value="">---Selecione---</option>
                                        @foreach($equipos as $mequip)
                                             <option value="{{ $mequip->id }}">{{ $mequip->numplaca }}</option>
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

<script src="{{ asset('/js/Localizacion/index.js') }}" type="text/javascript"></script>

@endsection