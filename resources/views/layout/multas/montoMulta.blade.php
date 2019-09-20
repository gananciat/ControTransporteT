@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.montoMultaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Monto de multas con descuento <button class="text-right btn btn-success btn-sm" data-bind="click: model.montoMultaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                        <th>Multa</th>
			                        <th>Porcentaje a aplicar</th>
			                        <th>Multa con descuento</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.montoMultaController.montoMultas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: id"></td>
                                        <td data-bind="text: formatCurrency(parseFloat(monto).toFixed(2))"></td>
                                        <td data-bind="text: porcentaje_descuento+'%'"></td>
                                        <td data-bind="text: formatCurrency(parseFloat(monto - (monto * (porcentaje_descuento/100))).toFixed(2))"></td>

                                        <td width="15%">
                                        	<a href="#" class="btn btn-info btn-xs" data-bind="click: model.montoMultaController.setCausas" data-toggle="tooltip" title="ver información"><i class="fa fa-eye"></i></a>

                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.montoMultaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.montoMultaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.montoMultaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.montoMultaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.montoMultaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.montoMultaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.montoMultaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="montoMultaForm" class="form-horizontal" data-bind="with: model.montoMultaController.montoMulta">

				                <div class="form-group">

				                    <div class="col-lg-6">
				                    <label for="text2">monto</label>
				                        <input type="number" step="0.01" id="monto" name="monto" placeholder="ingrese monto" class="form-control"data-bind="value: monto"
					                           data-error=".errormonto" required>
					                    <span class="errormonto text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                    <div class="col-lg-6">
				                    <label for="descuento">Porcentaje descuento (%)</label>
				                        <input type="number" id="porcentaje_descuento" name="porcentaje_descuento" placeholder="ingrese porcentaje de descuento" class="form-control"data-bind="value: porcentaje_descuento"
					                           data-error=".errorDescuento" min="0" max="100" required>
					                    <span class="errorDescuento text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-6 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.montoMultaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.montoMultaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>

			<div class="row" data-bind="visible: model.montoMultaController.infoMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="box">
						 <header>
				            <div class="icons"><i class="fa fa-info"></i></div>
						      <h5> MULTAS DE <span data-bind="text: formatCurrency(parseFloat(model.montoMultaController.montoMulta.monto()).toFixed(2))"> </span> quetzalez. Se aplicará multa de <span data-bind="text: formatCurrency(parseFloat(model.montoMultaController.montoMulta.monto()).toFixed(2))"> </span> quetzalez en los casos que siguen: </h5>  	
						      <div class="pull-right">
						      	<a style="margin: 5px;" class="btn btn-danger btn-xs" data-bind="click: model.montoMultaController.volver"><i class="fa fa-undo"></i> Volver</a> 
						      </div>
					                	       <!-- /.toolbar -->
				        </header>

						<div id="multas" class="body">
			                <table id="dataTableMultas" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                        <th>Caso</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.montoMultaController.causas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: $index()+1"></td>
                                    	<td data-bind="text: nombre"></td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
        $(document).ready(function () {
            model.montoMultaController.initialize();
        });
</script>
@endsection
