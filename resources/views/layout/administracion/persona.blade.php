@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.personaController.gridMode()">
				 <div class="col-lg-12">
				 	<div class="box-header">
				 		<div class="text-center">
				 			<!-- ko foreach: {data: model.personaController.tipo_personas, as: 'tipo'} -->
							<a class="quick-btn" href="#" data-bind="click: model.personaController.selectTipoPersona">
								<i class="glyphicon glyphicon-user"></i>
								<span data-bind="text: tipo.nombre">></span>
								<span class="label label-success" data-bind="text: tipo.personas.length"></span>
							</a>
							<!-- /ko -->
						</div>
				 	</div>
			        <div class="box" data-bind="visible: model.personaController.selectTipo()">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; <span data-bind="text: model.personaController.persona_name"></span> <button class="text-right btn btn-success btn-sm" data-bind="click: model.personaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Foto</th>
			                    	<th>CUI</th>
			                        <th>Nombres</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.personaController.personas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td><img class="bgimage img-responsive" style=" height:90px;" data-bind="attr:{src: (foto !== null && foto !== '' ? '/img/'+foto : emptyLogo)}" /></td>
                                    	<td data-bind="text: cui"></td>
                                        <td data-bind="text: nombre_uno+' '+apellido_uno"></td>
                                        <td width="25%">
                                        	<span data-bind="visible: model.personaController.isPropietario()" data-original-title="adjuntar expediente anual" data-toggle="tooltip">
                                        		<a href="#" class="btn btn-success btn-xs"  data-bind="click: model.personaController.initializeExpediente" data-toggle="modal" data-target="#expediente"><i class="fa fa-file"></i> expediente</a>
                                        	</span>

                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.personaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.personaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.personaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.personaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.personaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.personaController.editMode()"> Nuevo Registro <span data-bind="text: model.personaController.persona_name"></span></h5> 
				            <h5 data-bind="visible:model.personaController.editMode()"> Editar Registro <span data-bind="text: model.personaController.persona_name"></span></h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.personaController.persona">
				            	<div class="col-lg-12">
				            		
					            	<div class="form-group row">
						            	<div class="col-lg-4 col-md-4">
							            	<label for="foto">Foto</label>
							            	<input type="file" id="foto" name="foto" placeholder="seleccione foto" class="form-control" data-bind="event:{ change: model.personaController.PreviewAvatar}"><br />
							            	<div class="fileinput-preview thumbnail" alt="arches">
							            		<img class="img-responsive" data-bind="attr:{src: (foto() !== null ? ( foto() !== '' ? '/img/'+foto() : emptyLogo ) : emptyLogo)}" id="previewFoto" src="#" alt="fotografia" style="height: 200px; width: 80%"/>
							            	</div>
						            	</div>
						            	 <div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Cui</label>
						                        <input type="text" id="cui" name="cui" placeholder="ingrese cui" class="form-control"data-bind="value: cui"
							                           data-error=".errorcui"
							                           minlength="13" maxlength="15" required>
							                    <span class="errorcui text-danger help-inline"></span>
						                    </div>
							            	<div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Primer Nombre</label>
						                        <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre_uno"
							                           data-error=".errorNombre"
							                           minlength="3" maxlength="25" required>
							                    <span class="errorNombre text-danger help-inline"></span>
						                    </div>
						                    <div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Segundo Nombre</label>
						                        <input type="text" id="nombre" name="nombre" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: nombre_dos">
						                    </div>

						                    <div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Primer Apellido</label>
						                        <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: apellido_uno"
							                           data-error=".errorApellido"
							                           minlength="3" maxlength="25" required>
							                    <span class="errorApellido text-danger help-inline"></span>
						                    </div>
						                    <div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Segundo apellido</label>
						                        <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: apellido_dos">
						                    </div>

						                   

						                    <div class="col-lg-4 col-md-4 col-sm6">
						                    <label for="text2">Fecha nacimiento</label>
						                        <input type="date" id="fecha_nac" name="cui" placeholder="ingrese fecha nacimiento" class="form-control"data-bind="value: fecha_nac"
							                           data-error=".errorFecha"
							                           minlength="3" maxlength="25" required>
							                    <span class="errorFecha text-danger help-inline"></span>
						                    </div>

						                    <div class="col-lg-4 col-md-4 col-sm-12">
						                    <label for="text2">Correo</label>
						                        <input type="email" id="email" name="cui" placeholder="ingrese correo" class="form-control"data-bind="value: email"
							                           data-error=".errorEmail"
							                           minlength="3" maxlength="25" required>
							                    <span class="errorEmail text-danger help-inline"></span>
						                    </div>

						                    <div class="col-lg-4 col-md-4 col-sm-12">
						                    <label for="text2">Licencia</label>
						                        <input type="number" id="licencia" name="licencia" placeholder="ingrese licencia" class="form-control"data-bind="value: licencia"
							                           data-error=".errorLicencia"
							                           minlength="8" maxlength="25">
							                    <span class="errorLicencia text-danger help-inline"></span>
						                    </div>

						                    <div class="col-lg-8 col-md-8 col-sm6">
						                    <label for="text2">Dirección</label>
						                        <input type="text" id="direccion" name="cui" placeholder="ingrese direccion" class="form-control"data-bind="value: direccion">
						                    </div>

						                    <div class="col-lg-4 col-md-4">
					                            <label> telefono</label>
					                            <div class="input-group input-group-md">
					                              <input type="text" class="form-control" data-bind="value: telefono">
					                                  <span class="input-group-btn">
					                                    <button data-bind="click: model.personaController.addTelefono" type="button" class="btn btn-success btn-flat"> <i class="fa fa-plus"></i> agregar</button>
					                                  </span>
					                            </div>
					                        </div>
					                          <div class="col-lg-4 col-md-4 col-sm-12">
					                            <label> telefonos</label>
					                            <table class="table table-responsive table-bordered table-hover">
					                              <tbody>
					                                <!-- ko foreach: {data: model.personaController.persona.telefonos, as: 'a'} -->
					                                <tr>
					                                  <td data-bind="text: a.telefono"></td>
					                                  <td><a href="#" class="btn btn-danger btn-xs" data-bind="click: model.personaController.removeTelefono" data-toggle="tooltip" title="remover"><i class="fa fa-minus"></i></a></td>
					                                </tr>
					                                <!-- /ko -->
					                                <tr data-bind="if: model.personaController.persona.telefonos().length === 0">
					                                  <td class="text-center"> ningun telefono agregado</td>
					                                </tr>
					                              </tbody>
					                            </table>
					                          </div>
					            	</div>
				            	</div>

				                
				                <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.personaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.personaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>


<div class="modal fade" id="expediente" data-backdrop="static">
  <div class="modal-dialog modal-lg" style="color: black">
    <div class="modal-content">
      <div class="modal-header">
        EXPEDIENTES <span data-bind="text: model.personaController.persona.nombre_uno().toUpperCase()+' '+model.personaController.persona.apellido_uno().toUpperCase()"></span> <a class="btn-xs pull-right"><i class="fa fa-close" data-dismiss="modal"></i></a>
      </div>
      <div class="modal-body">
        <div class="panel-body table-responsive" id="listadoExpedientes">
        	<div>
        		<form id="form_exp" class="form-horizontal" data-bind="with: model.expedienteController.expediente">
        			<div class="col-lg-12">
        				
        			<div class="form-group row">
						<div class="col-lg-4">
						<label>Año</label>
						 <select class="form-control" id="rol" data-bind="options: model.expedienteController.anios, optionsText: 'anio', optionsValue: 'id',
	                       optionsCaption: '--seleccione--',
	                       value: anio_id" 
	                       data-error=".errorAnio"
		                    required></select>
		                <span class="errorAnio text-danger help-inline"></span>
						</div>

					<div class="col-lg-8 col-md-8">
		            	<label for="foto">Expediente</label>
		            		<input type="file" class="form-control"
                           id="expediente_doc" dane="expediente" value="expediente" data-bind="event:{ change: model.expedienteController.setExpediente}" accept="application/pdf,application">
               				<span class="errorDocumento text-danger help-inline"></span>
	            	  </div>
					</div>
				  </div>
				  <div class="form-group">
                	<div class="col-md-12 col-lg-12 text-right">					           
                		<a class="btn btn-primary btn-sm" data-bind="click:  model.expedienteController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
	                	<a class="btn btn-danger btn-sm" data-bind="click: model.expedienteController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
                	</div>
                </div>
        		</form>
        	</div>
          <div id="tbl_expediente" class="body">
            <table id="dataTableExpediente" class="table table-bordered table-condensed table-hover table-striped">
               <thead>
                <tr>
                    <th>Anio</th>
                    <th>Aciones</th>
                </tr>
                </thead>
                <tbody data-bind="dataTablesForEach : {
                                    data: model.expedienteController.expedientes,
                                    options: dataTableOptions
                                  }">
                    <tr>
                        <td data-bind="text: anio.anio"></td>
                        <td width="15%">
                        	<a target="_blank" class="btn btn-primary btn-xs" data-bind="attr: { href: '/documentos/'+expediente }"> <i class="fa fa-print"></i> </a>
                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.expedienteController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>

                </tbody>              
             </table>
            </div>
        </div>
      </div>
      </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
	</div>
</div>



<script>
        $(document).ready(function () {
            model.personaController.initialize();
        });
</script>
@endsection
