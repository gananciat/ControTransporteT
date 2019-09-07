@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.lineaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Lineas <button class="text-right btn btn-success btn-sm" data-bind="click: model.lineaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>No linea</th>
			                        <th>Propietario</th>
			                        <th>Ruta</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.lineaController.lineas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: no_linea"></td>
                                        <!-- ko foreach: {data: propietarios, as: 'prop'} -->
                                        <td data-bind="if: actual == 1">
                                        	<span data-bind="text: propietario.nombre_uno+' '+propietario.apellido_uno"></span>
                                        </td>
                                        <!-- /ko-->
                                        <td data-bind="text: ruta.ubicacion.nombre+'-'+ruta.destino.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.lineaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.lineaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.lineaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.lineaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.lineaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.lineaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.lineaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="lineaForm" class="form-horizontal" data-bind="with: model.lineaController.linea">
				             <div class="form-group row">
				             	<div class="col-lg-12 col-md-12 col-sm-12">
					            	<div class="btn-group" data-toggle="buttons" id="light-toggle">
										<label data-bind="click: function(data, event) { model.lineaController.showFormulario('showLinea', data, event) }" class="btn btn-success btn-rect">
											<input type="radio" name="options" value="primary">
											<i class="fa fa-file"></i> Linea
										</label>
										<label data-bind="click: function(data, event) { model.lineaController.showFormulario('showTransporte', data, event) }" class="btn btn-success btn-rect">
											<i class="fa fa-bus"></i> <input type="radio" name="options" value="primary"> Transporte
										</label>
										<label data-bind="click: function(data, event) { model.lineaController.showFormulario('showPiloto', data, event) }" class="btn btn-success btn-rect">
											<i class="fa fa-user"></i><input type="radio" name="options" value="primary"> Piloto
										</label>
									</div>
				             	</div>
				             </div>
				              <div data-bind="visible: model.lineaController.flags.showLinea()">
				                <div class="form-group row">
				                    <div class="col-lg-3 col-md-3">
				                    <label for="text2">No linea</label>
				                        <input type="text" id="no_linea" name="no_linea" placeholder="ingrese no lineaS" class="form-control"data-bind="value: no_linea"
					                           data-error=".errorLinea"
					                           minlength="3" maxlength="25" required>
					                    <span class="errorLinea text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-9 col-md-9 col-sm-12">
				                    <label for="text2">Propietario</label>
				                       <select class="form-control" id="propitario" data-bind="options: model.lineaController.propietarios, optionsText: function(prop) {return prop.cui+' - '+prop.nombre_uno+' '+prop.apellido_uno},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione propietario--',
				                       value: propietario_id" 
				                       data-error=".errorPropietario"
					                    required></select>
					                    <span class="errorPropietario text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Tipo transporte</label>
				                       <select class="form-control" id="tipo_transporte" data-bind="options: model.lineaController.tipoTransportes, optionsText: function(tipo) {return tipo.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione tipo transporte--',
				                       value: tipo_transporte_id" 
				                       data-error=".errorTransporte"
					                    required></select>
					                    <span class="errorTransporte text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Ruta</label>
				                       <select class="form-control" id="ruta" data-bind="options: model.lineaController.rutas, optionsText: function(ruta) {return ruta.ubicacion.nombre+' '+ruta.destino.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione ruta--',
				                       value: ruta_id" 
				                       data-error=".errorRuta"
					                    required></select>
					                    <span class="errorRuta text-danger help-inline"></span>
				                    </div>

				                </div>
				              </div>
				              <div data-bind="visible: model.lineaController.flags.showTransporte()">
				                <div class="form-group row">
				                    <div class="col-lg-4">
				                    <label for="text2"> Placa</label>
				                        <input type="text" id="no_placa" name="no_placa" placeholder="ingrese placa" class="form-control"data-bind="value: placa"
					                           data-error=".errorPlaca"
					                           minlength="4" maxlength="8" required>
					                    <span class="errorPlaca text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> Modelo</label>
				                        <input type="number" id="modelo" name="modelo" placeholder="ingrese modelo" class="form-control"data-bind="value: modelo"
					                           data-error=".errorModelo"
					                           minlength="4" maxlength="4" required>
					                    <span class="errorModelo text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4 col-md-4 col-sm-8">
				                    <label for="text2">Marca transporte</label>
				                       <select class="form-control" id="marca_trasnporte" data-bind="options: model.lineaController.marcas, optionsText: function(marca) {return marca.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione marca transporte--',
				                       value: marca_transporte_id" 
				                       data-error=".erorMarca"
					                    required></select>
					                    <span class="erorMarca text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No tarjeta circulación</label>
				                        <input type="number" id="no_tarjeta" name="no_tarjeta" placeholder="ingrese modelo" class="form-control"data-bind="value: no_tarjeta"
					                           data-error=".errorTarjeta"
					                           minlength="4" maxlength="20" required>
					                    <span class="errorTarjeta text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No seguro</label>
				                        <input type="number" id="no_seguro" name="no_seguro" placeholder="ingrese modelo" class="form-control"data-bind="value: no_seguro"
					                           data-error=".errorSeguro"
					                           minlength="4" maxlength="20" required>
					                    <span class="errorSeguro text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No motor</label>
				                        <input type="number" id="no_motor" name="no_motor" placeholder="ingrese no motor" class="form-control"data-bind="value: no_motor"
					                           data-error=".errorMotor"
					                           minlength="4" maxlength="16" required>
					                    <span class="errorMotor text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No chasis</label>
				                        <input type="number" id="no_chasis" name="no_chasis" placeholder="ingrese no chasis" class="form-control"data-bind="value: no_chasis"
					                           data-error=".erorChasis"
					                           minlength="4" maxlength="15" required>
					                    <span class="erorChasis text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> Linea</label>
				                        <input type="text" id="linea" name="linea" placeholder="ingrese color" class="form-control"data-bind="value: linea">
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> Color</label>
				                        <input type="text" id="color" name="color" placeholder="ingrese color" class="form-control"data-bind="value: color">
				                    </div>
				                </div>
				              </div>

				              <div data-bind="visible: model.lineaController.flags.showPiloto()">
				                <div class="form-group row">
				                    <div class="col-lg-4 col-md-4 col-sm-8">
				                     <label for="text2">Piloto titular</label>
				                       <select class="form-control" id="chofer_titular" data-bind="options: model.lineaController.pilotos, optionsText: function(piloto) {return piloto.cui+'-'+piloto.nombre_uno+' '+piloto.apellido_uno},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione piloto titular--',
				                       value: chofer_titular" 
				                       data-error=".errorTitular"
					                    required></select>
					                    <span class="errorTitular text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4 col-md-4 col-sm-8">
				                     <label for="text2">Piloto suplente</label>
				                       <select class="form-control" id="chofer_suplente" data-bind="options: model.lineaController.pilotos, optionsText: function(piloto) {return piloto.cui+'-'+piloto.nombre_uno+' '+piloto.apellido_uno},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione piloto suplente--',
				                       value: chofer_suplente" 
				                       data-error=".errorTitular"></select>
				                    </div>
				                </div>
				              </div>

				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.lineaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.lineaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
        $(document).ready(function () {
            model.lineaController.initialize();
        });
</script>
@endsection
