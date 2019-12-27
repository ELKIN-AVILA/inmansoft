@extends('adminlte::layouts.app')


@section('htmlheader_title')
   Principal
@endsection

@section('contentheader_title')
    Principal
@endsection


@section('main-content')

	<div class="row" id="sedes">	
			@php 
			  $ban=0;
			@endphp
			@foreach($sede as $msede)
			  	
			<div class="col-sm-4">
					<div class="panel panel-primary">
							<div class="panel-heading" style="text-align:center;background:darkblue">Sede:{{ $msede->nombre }}</div>
							<div class="panel-body">
								 <div class="row">
									<div class="col-sm-12" style="text-align:center;">
											<img  style="cursor:pointer;"   src="{{ asset('/img/sedes.png') }}" alt="">
									
									</div>
									<div class="col-sm-12">
										<h2 style="text-align: center;">TOTAL DE EQUIPOS</h2>
										<h1 style="text-align: center;font-size:70px;">{{ $nequipos[$ban] }}</h1>
									</div>
								</div>
							</div>
					</div>
			</div>
			@php
			   $ban+=1;	
			@endphp
		@endforeach
	</div>
	<div class="row">
		<form action="" id="formulario">
			<div class="col-sm-12">
				<div class="col-sm-4">
						<label for="">Sede:</label>
						<select name="sede_id" id="sede_id" class="form-control" onchange="departamentos(this)">
							<option value="">--Seleccione---</option>
							@foreach($sede as $msede)
								<option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
							@endforeach
						</select>
				</div>
				<div class="col-sm-4">
						<label for="">Departamentos:</label>
						<select name="departamentos_id" id="departamentos_id" class="form-control" onchange="dependencias(this)">
						</select>
				</div>

				<div class="col-sm-4">
						<label for="">Dependencias:</label>
						<select name="dependencias_id" id="dependencias_id" class="form-control">
							<option value="">--Seleccione---</option>
						</select>
					</div>
			</div>
		
			<div class="col-sm-12" style="text-align:center">
				<br>	
				<button class="btn btn-success" type="submit">Buscar</button>
			</div>
		</form>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12" id="contenido">
			
		</div>
	</div>
	<!-- nuevo esquema -->
	<!--Modal mantenimientos-->
		
    <div class="modal fade" id="mantenimientos" tabindex="-1" role="dialog" style="overflow-y: scroll;">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Mantenimientos</h4>
            </div>
            <div class="modal-body">
				<input type="hidden" name="idequ" id="idequ">
               <div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary"  onclick="nuevoman();">Nuevo</button>
				</div>
				<div class="col-sm-12">
						<br>
						<h4 style="text-align:center">Listado De Mantenimientos por realizar</h4>
						<table class="table table-bordered" id="manteni">
								<thead>
									<th>#</th>
									<th>Fecha</th>
									<th>Tipo</th>
									<th>Acciones</th>
								</thead>
								<tbody>

								</tbody>
							</table>
							<h4 style="text-align:center">Listado De Mantenimientos Realizados</h4>
						<table class="table table-bordered" id="mantenire">
								<thead>
									<th>#</th>
									<th>Fecha</th>
									<th>Tipo</th>
									<th>Acciones</th>
								</thead>
								<tbody>

								</tbody>
							</table>
				</div>
               </div>
            </div>
            
          </div>
          
        </div>
      </div>
	<!---End Modal--->
	<!-- info mantenimiento-->
	<div class="modal fade" id="infomantenimiento" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Informacion Mantenimiento</h4>
				</div>
				<div class="modal-body">
					<div class="row">

						<div class="col-sm-12">
								<label for="" class="col-sm-6">Responsable Mantenimiento: </label>
								<p class="col-sm-6" id="respomanteinfo"></p>
						</div>
						<div class="col-sm-12">
								<label for="" class="col-sm-6">Fecha de Mantenimiento:</label>
								<p class="col-sm-6" id="fechamanteinfo"></p>	
						</div>
						<div class="col-sm-12">
								<label for="" class="col-sm-6">Tipo de Mantenimiento:</label>
								<p class="col-sm-6" id="tipomanteinfo"></p>
						</div>
						<label for="" class="col-sm-12" style="text-align:center;">Descripcion del Mantenimiento:</label>
						<div class="col-sm-12" style="text-align:center">
							<textarea name="" id="descripcionmanteinfo" cols="30" rows="10" disabled style="margin: 0px; width: 566px; height: 229px;resize:none;overflow:auto;"></textarea>
						</div>
					</div>
				</div>
				
			  </div>
			  
			</div>
		  </div>	  

	<!-- end modal-->
	<!--- new detmantenimiento--->
	<div class="modal fade" id="detmantenimiento" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Detalle Mantenimiento</h4>
				</div>
	
				<div class="modal-body">
					<div class="row">
						<form action="" id="formuldetmante">
								<input type="hidden" name="idequimante" id="idequimante">
							<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-4">
										<label for="">Descripcion:</label>
									</div>
									<div class="col-sm-8">
										<textarea name="descripcionmante" id="descripcionmante" cols="30" rows="10"></textarea>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12 md-2" style="text-align:end">
								<button class="btn btn-success">Guardar</button>
							</div>
						</form>
					</div>
				</div>
				
			  </div>
			  
			</div>
		  </div>	  

	<!--- end modal-->
	<!-- modal fotos -->
	<div class="modal fade" id="fotosmantenimiento" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Fotos de Mantenimiento</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form action="" id="formulariofotmante" enctype="multipart/form-data">
							<input type="hidden" name="idequifotos" id="idequifotos">
								<div class="col-sm-12">
										<div class="col-sm-4">
											<label for="">Foto:</label>
										</div>
										<div class="col-sm-8">
											<input type="file" name="fotoid" id="fotoid" class="form-control">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="col-sm-4">
											<label for="">Observacion:</label>
										</div>
										<div class="col-sm-8">
											<textarea name="observafoto" id="observafoto" cols="41" rows="10" style="resize:none;"></textarea>
										</div>
									</div>
									<div class="col-sm-12" style="text-align:end;">
										<br>
										<button class="btn btn-success">Guardar</button>
									</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<div class="panel-success">
					<div class="panel-heading" style="text-align:center;">
						Listado de fotos Mantenimiento
					</div>
					
					<table class="table table-bordered" id="fotomante">
						<thead>
							<th>Imagen</th>
							<th>Observacion</th>
						</thead>
						<tbody>

						</tbody>
					</table>
					</div>
				</div>
			  </div>
			  
			</div>
		  </div>

		 <!-- end modal fotos-->
	<!-- mantenimiento new-->
	
    <div class="modal fade" id="nuevoman" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Crear Mantenimiento</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<form action="" id="formulmante">
						<input type="hidden" name="idequipoman" id="idequipoman">
						<div class="col-sm-12">
							<div class="col-sm-4">
								<label for="">Fecha:</label>
							</div>
							<div class="col-sm-8">
								<input type="date" class="form-control" disabled id="fechamante" value="<?php echo date("Y-m-d");?>">
							</div>				
						</div>
						<div class="col-sm-12">
							<div class="col-sm-4">
								<label for="">Tipo de Mantenimiento:</label>
							</div>
							<div class="col-sm-8">
								<select name="tipmante_id" id="tipmante_id" class="form-control">
									<option value="">--Seleccione---</option>
									@foreach($tipmante as $mtip)
										<option value="{{ $mtip->id }}">{{ $mtip->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12" style="text-align:right">
							<br>
							<button class="btn btn-success">Guardar</button>
						</div>
						</form>
					</div>
				</div>
				
			  </div>
			  
			</div>
		  </div>
	<!-- end mantenimientos-->

		
    <div class="modal fade" id="componentes" role="dialog" style="overflow-y: scroll;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Asignar Componentes</h4>
            </div>
            <div class="modal-body">
				<input type="hidden" name="idequ" id="idequ">
               <div class="row">
				<div class="col-sm-12">
						<form action="" id="formcomponentes" method="POST">
								<input type="hidden" name="idequcompo" id="idequcompo">
								<div class="row">
								<div class="col-sm-12">
									<div class="col-sm-4">
										<label for="">Numplaca:</label>
									</div>
									<div class="col-sm-8">
											<input type="text"  class="form-control" name="numplacacomp" id="numplacacomp" disabled>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-4">
										<label for="">Tipo de Componente:</label>
									</div>
									<div class="col-sm-8">
										<select name="tipcomponente" id="tipcomponente" class="form-control" onchange="traecomponente(this);">
											<option value="">---Seleccione---</option>
											@foreach ($tipcomponente as $mtipc)
													<option value="{{ $mtipc->id }}">{{ $mtipc->nombre }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-4">
										<label for="">Componente:</label>
									</div>
									<div class="col-sm-8">
										<select name="componenteid" id="componenteid" class="form-control"></select>
									</div>
								</div>
								<div class="col-sm-12" style="text-align:end;">
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>	
						</form>
				</div>
				<div class="col-sm-12">
						<br>
						<h4 style="text-align:center">Listado De Componentes</h4>
						<table class="table table-bordered" id="componen">
								<thead>
									<th>Tipo</th>
									<th>Nombre</th>
									<th>Acciones</th>
								</thead>
								<tbody id="listcomponen">

								</tbody>
							</table>
				</div>
               </div>
            </div>
            
          </div>
          
        </div>
      </div>
	<!---End Modal--->
	<!--- editar componente --->
	<div class="modal fade" id="editcomponente" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Editar  Componente</h4>
				</div>
				<div class="modal-body">
					<form id="formulcompoedi">

					<input type="hidden" name="idequicom" id="idequicom">
					<input type="hidden" name="idcompoedi" id="idcompoedi">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-4">
								<label for="">Tipo componente:</label>
							</div>
							<div class="col-sm-8">
								<select name="tipcomponente_idcom" id="tipcomponente_idcom" class="form-control" onchange="traecomponenteeditar(this);">
									@foreach($tipcomponente as $mtipcom)
										<option value="{{ $mtipcom->id }}">{{ $mtipcom->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-4">
								<label for="">Componente:</label>
							</div>
							<div class="col-sm-8">
								<select name="componente_idedi" id="componente_idedi" class="form-control">
									@foreach($componentes as $mcomp)
										<option value="{{ $mcomp->id }}">{{ $mcomp->nombre }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<br>
						<div class="col-sm-12" style="text-align:right;">
							<button type="submit" class="btn btn-primary">Guardar:</button>
						</div>
						</form>
	
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			  </div>
			  
			</div>
		  </div>
	
	
	<!--- end edit componente-->
	<!-- Programas--->
	
	  
    <div class="modal fade" id="nuevopro" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Asignar Programas</h4>
			</div>
			<div class="modal-body">
				<form id="formulpro">
				<input type="hidden" name="ideqpro" id="ideqpro">
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Numplaca:</label>
						</div>
						<div class="col-sm-8">
							<input type="text" disabled name="numplpro" id="numplpro" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Programas:</label>
						</div>
						<div class="col-sm-8">
							<select name="progr_id" id="progr_id" class="form-control" onchange="versionpro(this);"></select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Version programa:</label>
						</div>
						<div class="col-sm-8">
							<select name="version_proid" id="version_proid" class="form-control"></select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Licencia:</label>
						</div>
						<div class="col-sm-8">
							<input type="text" name="licencia" id="licencia" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Fecha de  Instalacion:</label>
						</div>
						<div class="col-sm-8">
							<input type="date" name="fechainst" id="fechainst" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Fecha de Caducidad:</label>
						</div>
						<div class="col-sm-8">
							<input type="date" name="fechacadu" id="fechacadu" class="form-control">
						</div>
					</div>
					<br>
					<div class="col-sm-12" style="text-align:right;">
						<button type="submit" class="btn btn-primary">Guardar:</button>
					</div>
					</form>

				</div>
				<div class="modal-footer">
					<div style="height:300px;overflow:scroll;">
						<h4 style="text-align:center;">Listado de Programas</h4>
						<input type="text" name="filtropro" id="filtropro" class="form-control" onkeyup="filtropro();" placeholder="introduce el nombre del programa">
						<table class="table table-bordered" id="prolist">
							<thead>
								<th>Programa</th>
								<th>Version</th>
								<th>Estado</th>
								<th>Accion</th>
							</thead>
							<tbody id="listpro">

							</tbody>
						</table>
					</div>
				</div>
			</div>
		  </div>
		  
		</div>
	  </div>
	<!-- -->
	<!--- modal editar programas --->
	<div class="modal fade" id="editprog" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Editar  Programa</h4>
			</div>
			<div class="modal-body">
				<form id="formulproedi">
				<input type="hidden" name="ideqproedi" id="ideqproedi">
				<input type="hidden" name="idregqui" id="idregqui">
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Programas:</label>
						</div>
						<div class="col-sm-8">
							<select name="progr_idedi" id="progr_idedi" class="form-control" onchange="versionproid(this);">
									@foreach($programas as $mpro)
										<option value="{{ $mpro->id }}">{{ $mpro->nombre }}</option>
									@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Version programa:</label>
						</div>
						<div class="col-sm-8">
							<select name="version_proidedi" id="version_proidedi" class="form-control">
								@foreach($version as $mversion)
									<option value="{{ $mversion->id }}">{{ $mversion->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Licencia:</label>
						</div>
						<div class="col-sm-8">
							<input type="text" name="licenciaedi" id="licenciaedi" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Fecha de  Instalacion:</label>
						</div>
						<div class="col-sm-8">
							<input type="date" name="fechainstedi" id="fechainstedi" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Fecha de Caducidad:</label>
						</div>
						<div class="col-sm-8">
							<input type="date" name="fechacaduedi" id="fechacaduedi" class="form-control">
						</div>
					</div>
					<br>
					<div class="col-sm-12" style="text-align:right;">
						<button type="submit" class="btn btn-primary">Guardar:</button>
					</div>
					</form>

				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		  </div>
		  
		</div>
	  </div>


	<!---Hoja de vida -->
	<div class="modal fade" id="hojadevida"  role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="numplahv"></h4>
            </div>
            <div class="modal-body">
				<input type="hidden" name="idequ" id="idequ">
				<h4 style="text-align:center;"><b>Software</b></h4>
				<table class="table table-bordered" id="hojadevid">
					<thead>
						<th style="background:yellow;">Programa</th>
						<th style="background:yellow;">Version</th>
					</thead>
					<tbody id="softvida">

					</tbody>
				</table>
				<h4 style="text-align:center"><b>Hardware</b></h4>
				<table class="table table-bordered" id="hojadevidcompo">
					<thead>
						<th style="background:yellow;">Tipo de Componente</th>
						<th style="background:yellow;">Componente</th>
					</thead>
					<tbody id="hadrvida">

					</tbody>
				</table>
				<div class="row">
					<div class="col-sm-12" style="text-align:end;">
						<a class="btn  btn-success  btn-lg btn-block" id="hojaurl"> <i class="fa fa-file-pdf-o"></i></a>
					</div>
				</div>
            </div>
            
          </div>
          
        </div>
      </div>
	<!---End Modal--->
	<!--- New Modal Transladoi--->
	<div class="modal fade" id="transladoequipo"  role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Translado de equipo</h4>
            </div>
            <div class="modal-body">
				<form id="formultranslado">
					<input type="hidden" name="equipoidtran" id="equipoidtran">
				<div class="row">
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Sede Actual:</label>
						</div>
						<div class="col-sm-8">
							<select name="sedeprovi" id="sedeprovi" class="form-control" disabled>
								@foreach($sede as $msed)
									<option value="{{ $msed->id }}">{{ $msed->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Departamentos Actual:</label>
						</div>
						<div class="col-sm-8">
							<select name="departamentosprovi" id="departamentosprovi" class="form-control" disabled>
								@foreach($departamentos as $mdepar)
									<option value="{{ $mdepar->id }}">{{ $mdepar->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Dependencias Actual:</label>
						</div>
						<div class="col-sm-8">
							<select name="dependenciapro" id="dependenciapro" class="form-control" disabled>
								@foreach($dependencias as $mdep)
									<option value="{{ $mdep->id }}">{{ $mdep->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Sede translado:</label>
						</div>
						<div class="col-sm-8">
							<select name="sedeactu" id="sedeactu" onchange="departamentostrans(this);" class="form-control">
								@foreach($sede as $msede)
									<option value="{{ $msede->id }}">{{ $msede->nombre }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Departamento Translado:</label>
						</div>
						<div class="col-sm-8">
							<select name="departamentosactu" id="departamentosactu" onchange="dependenciastrans(this);" class="form-control"></select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Dependencia Translado:</label>
						</div>
						<div class="col-sm-8">
							<select name="dependenciaactu" id="dependenciaactu" class="form-control"></select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-4">
							<label for="">Observacion:</label>
						</div>
						<div class="col-sm-8">
							<textarea name="observatransla" id="observatransla" cols="41" rows="10" maxlength="200" class="form-control" style="resize:none;"></textarea>
						</div>
					</div>
					<div class="col-sm-12" style="text-align:end;">
							<br>
							<button class="btn btn-primary" type="submit">Guardar</button>
					</div>
				</div>
				</form>
            </div>
            <div class="modal-footer">
				<h4 style="text-align:center;">Listado De Traslados</h4>
				<table class="table table-bordered" id="listatranslado">
					<thead>
						<th>Sede</th>
						<th>Departamento</th>
						<th>Dependencia</th>
						<th>Observacion</th>
						<th>Fecha</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
          </div>
          
        </div>
      </div>
	<!---End Modal -->
@endsection

@section('script')
<script src="{{ asset('/js/Principal/index.js') }}" type="text/javascript"></script>

@endsection
