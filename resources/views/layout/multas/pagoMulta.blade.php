@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.pagoMultaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Multas <span data-bind="text: model.pagoMultaController.estado()"></span></h4>
			            </header> <br />
			            <div class="form-group text-center">
				             	<div class="col-lg-12 col-md-12 col-sm-12">
					            	<div class="btn-group" data-toggle="buttons" id="light-toggle">
										<button id="showLinea" data-bind="click: model.pagoMultaController.showMultas(0)" class="btn btn-danger btn-rect active"> <i class="fa fa-file"></i> Pendientes
										</button>
										<button id="showTransporte" data-bind="click: model.pagoMultaController.showMultas(1)" class="btn btn-success btn-rect active"><i class="fa fa-money"></i> Canceladas
										</button>
				             	</div>
				             </div>
				        </div>
			            <div id="collapse4" class="body table-responsive">
			                <table id="dataTablePago" class="table table-responsive table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>#</th>
			                        <th>Tipo multa</th>
			                        <th>Causa</th>
			                        <th>Placa transporte</th>
			                        <th>Piloto</th>
			                        <th>Agente</th>
			                        <th>Total a pagar</th>
			                        <th>Descuento</th>
			                        <th>Total pagado</th>
			                        <th>Estado</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.pagoMultaController.multas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td width="3%" data-bind="text: id"></td>
                                    	<td width="8%" data-bind="text: tipo_multa.nombre"></td>
                                    	<td data-bind="text: causa.nombre"></td><td width="8%" data-bind="text: transporte.placa"></td>

                                        <td data-bind="text: linea_chofer.chofer.nombre_uno+' '+linea_chofer.chofer.apellido_uno"></td>

                                        <td data-bind="text: agente.nombre_uno+' '+agente.apellido_uno"></td>
                                        <td width="8%" data-bind="text: formatCurrency(parseFloat(total_a_pagar).toFixed(2))"></td>
                                        <td width="8%" data-bind="text: formatCurrency(parseFloat(descuento).toFixed(2))"></td>
                                        <td width="8%" data-bind="text: formatCurrency(parseFloat(total_pagado).toFixed(2))"></td>

                                        <td width="8%">
                                        	<span class="label" data-bind="text: (pagado === 1 ? 'Cancelada' : 'Pendiente'), css: (pagado === 1 ? 'label-success' : 'label-danger')"></span>
                                          </td>
                                        <td width="10%">
                                        	@if(Auth::user()->tipo_usuario->nombre == "administrador")
                                        	<!-- ko if: deleted_at === null && pagado === 0 -->
                                            <a href="#" class="btn btn-success btn-xs" data-bind=" click: model.pagoMultaController.editar" data-toggle="tooltip" title="cancelar multa"><i class="fa fa-money"></i></a>
                                        	<!-- /ko -->
                                        	<!-- ko if: deleted_at === null && pagado -->
                                            <a href="#" class="btn btn-warning btn-xs" data-bind=" click: model.pagoMultaController.revertir" data-toggle="tooltip" title="revertir pago"><i class="fa fa-undo"></i></a>
                                        	<!-- /ko -->
                                        	@endif
                                        </td>

                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.pagoMultaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i class="fa fa-plus"></i> Cancelar multa </div>
				            <h5 data-bind="visible:!model.pagoMultaController.editMode()"> Pago multa</h5>           <!-- /.toolbar -->
				        </header>
				        <div class="body">
				        	<div class="row">
				        		
				        	<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="box">
								<header>
									<h5>Información de multa
										<small>
										</small>
									</h5>
								</header>
								<div class="body">
									<ul>
										<li><label class="text-info">Tipo multa: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.tipo_multa()"></span></li>
										<li><label class="text-info">Total multa: </label> <span data-bind="text: formatCurrency(parseFloat(model.pagoMultaController.pagoMulta.total_multa()).toFixed(2))"></span></li>
										<li><label class="text-info">Descuento opcional aplicable: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.porcentaje_descuento()+'%'"></span></li>
										<li><label class="text-info">Agente: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.agente()"></span></li>
										<li><label class="text-info">Causa: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.causa_multa()"></span></li>
										<li data-bind="visible: model.pagoMultaController.pagoMulta.no_inspeccion() !== ''"><label class="text-info">Multa por inspeccion numero: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.no_inspeccion()+' realizada el '+moment(model.pagoMultaController.pagoMulta.fecha_inspeccion()).format('DD/MM/YYYY')"></span></li>
									</ul>
								</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="box">
								<header>
									<h5>Información de piloto
										<small>
											
										</small>
									</h5>
								</header>
								<div class="body">
									<ul>
										<li><label class="text-info">Dpi: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.dpi_piloto()"></span></li>
										<li><label class="text-info">Piloto: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.piloto()"></span></li>
										<li><label class="text-info">Licencia: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.licencia()"></span></li>
										<li><label class="text-info">Linea: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.linea()"></span></li>
									</ul>
								</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="box">
								<header>
									<h5>Información de transporte
										<small></small>
									</h5>
								</header>
								<div class="body">
									<ul>
										<li><label class="text-info">Linea: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.linea()"></span></li>
										<li><label class="text-info">Tarjeta circulación: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.tarjeta_circulacion()"></span></li>
										<li><label class="text-info">Placa: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.placa_transporte()"></span></li>
										<li><label class="text-info">No chasis: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.no_chasis()"></span></li>
										<li><label class="text-info">No motor: </label> <span data-bind="text: model.pagoMultaController.pagoMulta.no_motor()"></span></li>
									</ul>
								</div>
								</div>
							</div>
				        	</div>
				            <form id="pagoMultaForm" class="form-horizontal" data-bind="with: model.pagoMultaController.pagoMulta">
				                <div class="form-group row">

				                    <div class="col-lg-3">
				                    <label for="text2">Fecha pago</label>
				                        <input type="date" id="fecha_pago" name="fecha_pago" class="form-control"data-bind="value: fecha_pago"
					                           data-error=".fecha_pago" required>
					                    <span class="fecha_pago text-danger help-inline"></span>
				                    </div>

				                    <div class="form-group col-md-2 col-lg-2">
				                    	<label for="descuento"> Descuento</label>
			                            <p class="bold">aplicar descuento: <input type="checkbox" data-bind="checked: isDescuento, event:{change: model.pagoMultaController.setMonto}" /></p>
			                        </div>

				                    <div class="form-group col-lg-2 col-md-4 col-sm-4 col-xs-12">
			                          <label for="total_pagado"> Total pagado</label>
			                              <input type="number" id="total_pagado" name="total_pagado" class="form-control" data-bind="value: total_pagado" readonly>
			                        </div>

				                    <div class="col-lg-12 col-sm-12 col-md-12">
				                    <label for="text2">Descripción</label>
				                        <textarea rows="3" id="observacion" name="observacion" class="form-control"data-bind="value: observacion"></textarea>
				                    </div>
				                </div>

				                <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.pagoMultaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.pagoMultaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.pagoMultaController.initialize();
        });
</script>
@endsection
