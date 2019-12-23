@extends('adminlte::layouts.app')

@section('htmlheader_title')
   Inventarios de Equipos
@endsection

@section('contentheader_title')
    Inventario de Equipos
@endsection

@section('main-content')
	<div class="form-group">
        <button class="btn btn-primary" onclick="nuevo();">Nuevo</button>
        <a href="{{ route('equipos.pdf') }}" class="btn btn-sm btn-danger">
                <i class="fa fa-file-pdf-o"></i>
        </a>   
    </div>
    <div class="row">
        @foreach($equipos as $mequi)
            @if($mequi->estado=="A")
                    <div class="col-sm-3">
                            <div class="panel panel-primary">
                                    <div class="panel-heading">N° placa - {{ $mequi->numplaca }}</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                @foreach($tipequipo as $mtipeq)
                                                    @if($mequi->tipequipo_id==$mtipeq->id)
                                                        @if($mtipeq->nombre == "PC DE ESCRITORIO")
                                                            <img src="{{ asset('/img/pc.png') }}" alt="">

                                                        @elseif($mtipeq->nombre=="IMPRESORA")
                                                            <img src="{{ asset('/img/impresora.png') }}" alt="">
                                                        @elseif($mtipeq->nombre=="PROYECTOR")
                                                            <img src="{{ asset('/img/vb.png') }}" alt="">
                                                        @elseif($mtipeq->nombre=="TV")
                                                            <img src="{{ asset('/img/tv.png') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="ESCANER")
                                                            <img src="{{ asset('/img/scan.png') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="IMPRESORA DE RECIBO")
                                                            <img src="{{ asset('/img/imprecaja.jpg') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="MICROPC")
                                                            <img src="{{ asset('/img/micropc.png') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="IMPRESORA RADICADORA")
                                                            <img src="{{ asset('/img/impreradic.jpg') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="IMPRESORA CARDS")
                                                            <img src="{{ asset('/img/imprecard.jpg') }}" height="96px">
                                                        @elseif($mtipeq->nombre=="PORTATIL")
                                                            <img src="{{ asset('/img/portatil.png') }}" height="96px">

                                                        @else
                                                            
                                                        @endif
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <button class="btn btn-info" style="width:40px" onclick="infor({{ $mequi->id }});"  data-toggle="tooltip" data-placement="right" title="Informacion"><i class="fa fa-info"></i></button>
                                                <button class="btn btn-warning" onclick="editar({{ $mequi->id }})" data-toggle="tooltip" data-placement="right" title="Editar"><i class="fa fa-edit"></i></button>
                                            </div>
                                            
                                        </div>    
                                    </div>
                                    
                            </div>
                    </div>
                    @else
                    <div class="col-sm-3">
                        <div class="panel panel-primary">
                                <div class="panel-heading" style="background-color:red;">N° placa - {{ $mequi->numplaca }}</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            @foreach($tipequipo as $mtipeq)
                                                @if($mequi->tipequipo_id==$mtipeq->id)
                                                    @if($mtipeq->nombre == "PC DE ESCRITORIO")
                                                        <img src="{{ asset('/img/pc.png') }}" alt="">

                                                    @elseif($mtipeq->nombre=="IMPRESORA")
                                                        <img src="{{ asset('/img/impresora.png') }}" alt="">
                                                    @else
                                                        
                                                    @endif
                                                @endif
                                            @endforeach
                                            
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-info" style="width:40px" onclick="infor({{ $mequi->id }});"  data-toggle="tooltip" data-placement="right" title="Informacion"><i class="fa fa-info"></i></button>
                                            <button class="btn btn-warning" onclick="editar({{ $mequi->id }})" data-toggle="tooltip" data-placement="right" title="Editar"><i class="fa fa-edit"></i></button>
                                        </div>
                                        
                                    </div>    
                                </div>
                                
                        </div>
                </div>


                    @endif
        @endforeach
    </div>
    <!---modal info -->
    <div class="modal fade" id="informacion" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">  <p id="nombreequipo"></p></h4>
                </div>
                <div class="modal-body">
                        <ol>
                            <h4 id="estadoinfo"></h4>
                            <h4 id="tipoequipoinfo"></h4>
                            <h4 id="marcaequipoinfo"></h4>
                            <h4 id="modeloequipoinfo"></h4>
                            <h4 id="serialinfo"></h4>
                            <h4 id="fechacomprainfo"></h4>
                            <h4 id="valorcomprainfo"></h4>
                            <h4 id="proveedorinfo"></h4>
                            <h4 id="fechaegresoinfo"></h4>
                        </ol>
                </div>
            </div>
        </div>

    </div>
    <!-- -->
    <!-- modal nuevo-->
    <div class="modal fade" id="nuevo" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Crear Equipo</h4>
            </div>
            <div class="modal-body">
                <form action="">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Numero de placa:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" id="numplaca" name="numplaca" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Tipo de Equipo:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="tipequipo_id" id="tipequipo_id" class="form-control">
                                <option value="#">----Selecione----</option>
                                @foreach($tipequipo as $mtipe)
                                    <option value="{{ $mtipe->id }}">{{ $mtipe->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Marca Equipo:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="marcaequi_id" id="marcaequi_id" class="form-control" onchange="traemodelo(this);">
                                <option value="#">----Selecione----</option>
                                @foreach($marcaequi as $mmarca)
                                    <option value="{{ $mmarca->id }}">{{ $mmarca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Modelo de Equipo:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="modelequi_id" id="modelequi_id" class="form-control">
                                <option value="#">----Selecione----</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Serial:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" id="serial" name="serial" class="form-control" maxlength="15">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Valor Compra:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="number" id="valcompra" name="valcompra" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Fecha Compra:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" id="fechacompra" name="fechacompra" class="form-control"> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Proveedor:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="proveedores_id" id="proveedores_id" class="form-control">
                                <option value="#">----Selecione----</option>
                                @foreach($proveedores as $mprove)
                                    <option value="{{ $mprove->id }}">{{ $mprove->razonsoc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <label for="">Estado:</label>
                        </div>
                        <div class="col-sm-8">
                            <select name="estado" id="estado" onchange="egreso(this);" class="form-control">
                                <option value="#">----Selecione----</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12" id="egreso">
                        <div class="col-sm-4">
                            <label for="">Fecha Egreso:</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="date" name="fechaegreso" id="fechaegreso" class="form-control">
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="guardar();">Guardar</button>
            </div>
          </div>
          
        </div>
      </div>
    <!--fin modal nuevo -->
     <!-- modal editar-->
     <div class="modal fade" id="editar" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Editar Equipo</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idedi" id="idedi">
                    <div class="row">
                            <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Numero de placa:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" id="numplacaedi" name="numplacaedi" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Tipo de Equipo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="tipequipo_idedi" id="tipequipo_idedi" class="form-control">
                                            <option value="#">----Selecione----</option>
                                            @foreach($tipequipo as $mtipe)
                                                <option value="{{ $mtipe->id }}">{{ $mtipe->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Marca Equipo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="marcaequi_idedi" id="marcaequi_idedi" class="form-control">
                                            <option value="#">----Selecione----</option>
                                            @foreach($marcaequi as $mmarca)
                                                <option value="{{ $mmarca->id }}">{{ $mmarca->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Modelo de Equipo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="modelequi_idedi" id="modelequi_idedi" class="form-control">
                                            <option value="#">----Selecione----</option>
                                            @foreach($modelequi as $mmodel)
                                                <option value="{{ $mmodel->id }}">{{ $mmodel->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Serial:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="serialedi" name="serialedi" class="form-control" maxlength="15">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Valor Compra:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" id="valcompraedi" name="valcompraedi" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Fecha Compra:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="date" id="fechacompraedi" name="fechacompraedi" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Proveedor:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="proveedores_idedi" id="proveedores_idedi" class="form-control">
                                            <option value="#">----Selecione----</option>
                                            @foreach($proveedores as $mprove)
                                                <option value="{{ $mprove->id }}">{{ $mprove->razonsoc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                        <label for="">Estado:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="estadoedi" id="estadoedi" onchange="egreso(this);" class="form-control">
                                            <option value="#">----Selecione----</option>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="egresoedi">
                                    <div class="col-sm-4">
                                        <label for="">Fecha Egreso:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="date" name="fechaegresoedi" id="fechaegresoedi" class="form-control">
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="actualizar();">Guardar</button>
                </div>
              </div>
              
            </div>
          </div>
        <!--fin modal editar -->
@endsection
@section('script')
<script src="{{ asset('/js/Equipos/index.js') }}" type="text/javascript"></script>

@endsection
