@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.multaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; multas <button class="text-right btn btn-success btn-sm" data-bind="click: model.multaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body table-responsive">
			                <table id="dataTable" class="table table-responsive table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                    	<th>Tipo multa</th>
			                        <th>Causa</th>
			                        <th>Placa transporte</th>
			                        <th>Piloto</th>
			                        <th>Agente</th>
			                        <th>Total a pagar</th>
			                        <th>Estado</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.multaController.multas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td width="3%" data-bind="text: id"></td>
                                    	<td width="8%" data-bind="text: tipo_multa.nombre"></td>
                                        <td data-bind="text: causa.nombre"></td>
                                        <td width="8%" data-bind="text: transporte.placa"></td>

                                        <td data-bind="text: linea_chofer.chofer.nombre_uno+' '+linea_chofer.chofer.apellido_uno"></td>

                                        <td data-bind="text: agente.nombre_uno+' '+agente.apellido_uno"></td>
                                        <td width="8%" data-bind="text: formatCurrency(parseFloat(total_a_pagar).toFixed(2))"></td>


                                        <td width="8%"><span class="label" data-bind="text: (pagado === 1 ? 'Cancelado' : 'Pendiente'), css: (pagado === 1 ? 'label-success' : 'label-danger')"></span></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.multaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.multaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.multaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.multaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.multaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.multaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.multaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="multaForm" class="form-horizontal" data-bind="with: model.multaController.multa">
				                <div class="form-group row">
				                	<div class="col-lg-12 col-md-12 col-sm-12">
				                    <label for="monto">Causa o motivo de multa</label>
				                       <select class="form-control" id="causa_id" data-bind="options: model.multaController.causas, optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione causa o motivo de multa--',
				                       value: causa_id" 
				                       data-error=".errorCausa"
					                    required></select>
					                    <span class="errorCausa text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-2">
				                    <label for="text2">Monto de multa</label>
				                        <input type="text" id="total_a_pagar" name="total_a_pagar" class="form-control"data-bind="value: total_a_pagar"
					                           data-error=".total_a_pagar" required readonly>
					                    <span class="total_a_pagar text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4 col-md-4 col-sm-4">
				                    <label for="tipo_multa">Tipo de multa</label>
				                       <select class="form-control" id="causa_id" data-bind="options: model.multaController.tipos, optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione tipo de multa--',
				                       value: tipo_multa_id" 
				                       data-error=".errorTipo"
					                    required></select>
					                    <span class="errorTipo text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-6">
				                    <label for="linea_chofer_id">Chofer</label>
				                       <select class="form-control" id="causa_id" data-bind="options: model.multaController.pilotos, optionsText: function(chofer) {return chofer.chofer.cui+' / '+chofer.chofer.nombre_uno+' '+chofer.chofer.apellido_uno+' / piloto '+chofer.tipo_chofer}, optionsValue: 'id',
				                       optionsCaption: '--seleccione piloto--',
				                       value: linea_chofer_id" 
				                       data-error=".errorPiloto"
					                    required></select>
					                    <span class="errorPiloto text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-3">
				                    <label for="text2">Transporte actual</label>
				                        <input type="text" id="transporte" name="transporte" class="form-control"data-bind="value: transporte" readonly>
				                    </div>

				                    <div class="col-lg-3">
				                    <label for="no_linea">No linea actual</label>
				                        <input type="text" id="no_linea" name="no_linea" class="form-control"data-bind="value: no_linea" readonly>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-8">
				                    <label for="agente_id">Agente</label>
				                       <select class="form-control" id="causa_id" data-bind="options: model.multaController.agentes, optionsText: function(agente) {return agente.cui+' / '+agente.nombre_uno+' '+agente.apellido_uno}, optionsValue: 'id',
				                       optionsCaption: '--seleccione agente--',
				                       value: agente_id" 
				                       data-error=".errorAgente"
					                    required></select>
					                    <span class="errorAgente text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-3">
				                    <label for="text2">Fecha multa</label>
				                        <input type="date" id="fecha_multa" name="fecha_multa" class="form-control"data-bind="value: fecha_multa"
					                           data-error=".fecha_multa" required>
					                    <span class="fecha_multa text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-12 col-sm-12 col-md-12">
				                    <label for="text2">Fecha multa</label>
				                        <textarea rows="3" id="observacion" name="observacion" class="form-control"data-bind="value: observacion"></textarea>
				                    </div>
				                </div>

				                <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.multaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.multaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.multaController.initialize();
        });
</script>
@endsection
