@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.transporteController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Transportes 
			                	@if(Auth::user()->tipo_usuario->nombre == "administrador")
			                	<button class="text-right btn btn-success btn-sm" data-bind="click: model.transporteController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			                	@endif
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Placa</th>
			                        <th>Tarjeta circulación</th>
			                        <th>No linea</th>
			                        <th>Tipo transporte</th>
			                        <th>Propietario</th>
			                        <th>Estado</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.transporteController.transportes,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: placa"></td>
                                        <td data-bind="text: no_tarjeta"></td>
                                        <td data-bind="text: linea.no_linea"></td>
                                        <td data-bind="text: linea.tipo_transporte.nombre"></td>
                                        <td data-bind="text: linea.propietario_actual.propietario.nombre_uno+' '+linea.propietario_actual.propietario.apellido_uno"></td>
                                        <td><span class="label" data-bind="text: (actual === 1 ? 'Activo' : 'Inactivo'), css: (actual === 1 ? 'label-success' : 'label-danger')"></span></td>
                                        <td width="10%">
                                        	@if(Auth::user()->tipo_usuario->nombre == "administrador")
                                        	<span data-bind="if: actual === 1">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.transporteController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.transporteController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        	</span>
                                        	@endif
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.transporteController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.transporteController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.transporteController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.transporteController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.transporteController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="transporteForm" class="form-horizontal" data-bind="with: model.transporteController.transporte">

				                <div class="form-group row">
				                	<div class="col-lg-4 col-md-4 col-sm-8">
				                    <label for="text2">Numero linea</label>
				                       <select class="form-control" id="marca_trasnporte" data-bind="options: model.transporteController.lineas, optionsText: function(linea) {return 'linea no. '+linea.no_linea +' / '+linea.tipo_transporte.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione numero de linea--',
				                       value: linea_id" 
				                       data-error=".errorLinea"
					                    required></select>
					                    <span class="errorLinea text-danger help-inline"></span>
				                    </div>

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
				                       <select name="marca_transporte" class="form-control" id="marca_trasnporte" data-bind="options: model.transporteController.marcas, optionsText: function(marca) {return marca.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione marca transporte--',
				                       value: marca_transporte_id" 
				                       data-error=".errorMarcaTrnasporte"
					                    required></select>
					                    <span class="errorMarcaTrnasporte text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No tarjeta circulación</label>
				                        <input type="text" id="no_tarjeta" name="no_tarjeta" placeholder="ingrese modelo" class="form-control"data-bind="value: no_tarjeta"
					                           data-error=".errorTarjeta"
					                           minlength="4" maxlength="20" required>
					                    <span class="errorTarjeta text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No seguro</label>
				                        <input type="text" id="no_seguro" name="no_seguro" placeholder="ingrese modelo" class="form-control"data-bind="value: no_seguro"
					                           data-error=".errorSeguro"
					                           minlength="4" maxlength="20" required>
					                    <span class="errorSeguro text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No motor</label>
				                        <input type="text" id="no_motor" name="no_motor" placeholder="ingrese no motor" class="form-control"data-bind="value: no_motor"
					                           data-error=".errorMotor"
					                           minlength="4" maxlength="16" required>
					                    <span class="errorMotor text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> No chasis</label>
				                        <input type="text" id="no_chasis" name="no_chasis" placeholder="ingrese no chasis" class="form-control"data-bind="value: no_chasis"
					                           data-error=".erorChasis"
					                           minlength="4" maxlength="15" required>
					                    <span class="erorChasis text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> Linea transporte</label>
				                        <input type="text" id="linea_transporte" name="linea" placeholder="ingrese linea transporte" class="form-control"data-bind="value: linea_transporte">
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2"> Color</label>
				                        <input type="text" id="color" name="color" placeholder="ingrese color" class="form-control"data-bind="value: color">
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.transporteController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.transporteController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.transporteController.initialize();
        });
</script>
@endsection
