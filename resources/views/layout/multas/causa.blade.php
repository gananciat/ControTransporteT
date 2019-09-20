@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.causaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Causas o motivos de multa <button class="text-right btn btn-success btn-sm" data-bind="click: model.causaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                        <th>Nombre</th>
			                        <th>Monto de multa</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.causaController.causas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: id"></td>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: formatCurrency(parseFloat(monto.monto).toFixed(2))"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.causaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.causaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.causaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.causaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.causaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.causaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.causaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="causaForm" class="form-horizontal" data-bind="with: model.causaController.causa">
				                <div class="form-group">
				                	<div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="monto">Monto multa</label>
				                       <select class="form-control" id="monto_multa_id" data-bind="options: model.causaController.montos, optionsText: 'monto', optionsValue: 'id',
				                       optionsCaption: '--seleccione monto de multa--',
				                       value: monto_multa_id" 
				                       data-error=".errorMontoMulta"
					                    required></select>
					                    <span class="errorForma text-danger help-inline"></span>
				                    </div>
				                </div>

				                <div class="form-group">

				                    <div class="col-lg-12 col-md-12 col-sm-12">
				                    <label for="text2">Descripción</label>
				                        <textarea row="3" id="nombre" name="nombre" placeholder="ingrese descripción de la causa o motivo de multa" class="form-control"data-bind="value: nombre"
					                           data-error=".errorNombre"
					                           minlength="10" maxlength="1000" required></textarea>
					                    <span class="errorNombre text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.causaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.causaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.causaController.initialize();
        });
</script>
@endsection
