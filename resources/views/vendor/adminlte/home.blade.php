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
							<div class="panel-heading" style="text-align:center;">Sede:{{ $msede->nombre }}</div>
							<div class="panel-body">
								 <div class="row">
									<div class="col-sm-12" style="text-align:center;">
											<img  style="cursor:pointer;"   src="{{ asset('/img/sedes.png') }}" alt="">
									
									</div>
									<div class="col-sm-12">
										<h2>TOTAL DE EQUIPOS</h2>
										<h1>{{ $nequipos[$ban] }}</h1>
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
					<button class="btn btn-primary" onclick="nuevoman();">Nuevo</button>
				</div>
				<div class="col-sm-12">
						<br>
						<h4 style="text-align:center">Listado De Mantenimientos</h4>
						<table class="table table-bordered" id="manteni">
								<thead>
									<th>#</th>
									<th>Fecha</th>
									<th>Tipo</th>
									<th>Estado</th>
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
	<!-- mantenimiento new-->

    <div class="modal fade" id="nuevoman" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Crear Mantenimiento</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="idequipo" id="idequipo">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-4">
								<label for="">Fecha:</label>
							</div>
							<div class="col-sm-8">
								<input type="date" class="form-control" disabled>
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
              <h4 class="modal-title">Componentes</h4>
            </div>
            <div class="modal-body">
				<input type="hidden" name="idequ" id="idequ">
               <div class="row">
				<div class="col-sm-12">
					<button class="btn btn-primary" onclick="nuevocomponen();">Nuevo</button>
				</div>
				<div class="col-sm-12" id="formcompo">
						<form action="" id="formcomponentes">
								<input type="hidden" name="idequ" id="idequ">
							<div class="row">
								<div class="col-sm-12">
										<h4>Crear Componente</h4>
									<div class="col-sm-4">
										<label for="">Tipo de Componente</label>
									</div>
									<div class="col-sm-8">
										<select name="tipcomponent" id="tipcomponente" class="form-control" onchange="traecomponente(this);">
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

							</div>	
						</form>
				</div>
				<div class="col-sm-12">
						<br>
						<h4 style="text-align:center">Listado De Componentes</h4>
						<table class="table table-bordered" id="componen">
								<thead>
									<th>#</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th>Estado</th>
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
					<h4 style="text-align:center;">Listado de Programas</h4>
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


	<!--- -->
@endsection

@section('script')
<script src="{{ asset('/js/Principal/index.js') }}" type="text/javascript"></script>

@endsection
