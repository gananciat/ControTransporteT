@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.anioController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp;  anios <button class="text-right btn btn-success btn-sm" data-bind="click: model.anioController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="tableAnio" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Anio</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.anioController.anios,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: anio"></td>
                                        <td width="10%">
                                            <!-- <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.anioController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>-->
                                            <a href="#" class="btn btn-info btn-xs" data-bind="click: model.anioController.viewInfo" data-toggle="tooltip" title="información"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.anioController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.anioController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.anioController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.anioController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.anioController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.anioController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="anioForm" class="form-horizontal" data-bind="with: model.anioController.anio">

				                <div class="form-group">

				                    <div class="col-lg-6">
				                    <label for="text2">Año</label>
				                        <input type="number" id="anio" name="anio" placeholder="ingrese año" class="form-control"data-bind="value: anio"
					                           data-error=".errorAnio"
					                           minlength="4" maxlength="4" required>
					                    <span class="errorAnio text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div data-bind="visible: !model.anioController.editMode()" class="form-group">
				                <div class="col-md-12 col-lg-12">
				                		
				                <div id="conceptos">
				                	<label for="concepto">Agregar Cuotas</label>
					                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
					                    <thead>
					                    <tr>
					                        <th>Concepto Pago</th>
					                        <th>Forma Pago</th>
					                        <th>Cuota</th>
					                    </tr>
					                    </thead>
					                    <tbody>
					                    <!-- ko foreach: {data: model.anioController.cuotas, as: 'concepto'} -->
		                                    <tr>
		                                        <td data-bind="text: concepto.nombre"></td>
		                                        <td><span class="label" data-bind="text: (concepto.forma_pago === 'M' ? 'Mensual' : 'Anual'), css: (concepto.forma_pago === 'M' ? 'label-info' : 'label-success')"></span>
		                                        </td>
		                                        <td>
		                                        	<div class="input-group">
													  <span class="input-group-addon"><i class="fa fa-money"></i></span>
													  <input type="number" class="form-control" min="1" step="0.50" data-bind="value: concepto.cuota">
													</div>
		                                        </td>
		                                    </tr>
		                                <!-- /ko -->
		                                </tbody>              
					                 </table>
					            </div>
				                	</div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">
				                		<a class="btn btn-primary btn-sm" data-bind="click: model.anioController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.anioController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>
			<div class="row" data-bind="visible: model.anioController.viewMode()">
				<div class="col-lg-12"><br />

						<div class="pull-right">
	        				<button data-bind="click: model.anioController.cancelar" class="btn btn-danger btn-sm"> <i class="fa fa-undo"></i> volver</button>
						</div>
					<h2>Detalle de cuotas y pagos del año <span data-bind="text: model.anioController.anio.anio"></span>
					</h2>
					<ul class="pricing-table dark" contenteditable="" id="light">
						<!-- ko foreach: {data: model.anioController.cuotasAnios, as: 'cuota'} -->
						<li class="active success col-lg-3 " style="height: 300px;">
							<h3><span data-bind="text: concepto_pago.nombre"></span></h3>
							<div class="price-body">
								<div class="price" style="font-size: 17px;">
								  <span data-bind="text: formatCurrency(parseFloat(cuota).toFixed(2))"></span>
								</div>
							</div>
							<div class="features">
								<ul>
									<li data-bind="if: concepto_pago.forma_pago === 'A'"> PAGO ANUAL </li>
									<li data-bind="if: concepto_pago.forma_pago === 'M'"> PAGO ANUAL</li>
								</ul>
							</div>
					    </li>
					    <!-- /ko -->
					<div class="clearfix"></div>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div id="preview" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"> Año y Cuotas Ingresadas</h4> 
	      </div>
	      <div class="modal-body">
	        <p class="text-info">por favor verifique los pagos</p>
	        <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-info">Concepto Pago</th>
                    <th class="text-info">Cuota</th>
                </tr>
                </thead>
                <tbody>
                <!-- ko foreach: {data: model.anioController.cuotas, as: 'concepto'} -->
                    <tr>
                        <td class="text-info" data-bind="text: concepto.nombre"></td>
                        <td class="text-info" data-bind="text: concepto.cuota"></td>
                    </tr>
                <!-- /ko -->
                </tbody>              
             </table>

	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" data-bind="click: model.anioController.create"><i class="fa fa-check"></i> Confirmar</button>
	        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo"></i> Cancelar</button>
	      </div>
	    </div>

	  </div>
	</div>

</div>


<script>
        $(document).ready(function () {
            model.anioController.initialize();
        });
</script>
@endsection
