@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">

			<div class="row" data-bind="visible: model.inspeccionController.viewInfo()">
			    <div class="col-lg-12"><br />
			    	<div class="row">
			    		<div class="form-group col-lg-12">
			                <div class="text-right">
			                    <span><a class="text-danger" href="javascript{0}"><i data-bind="click: model.inspeccionController.cancelar" class="fa fa-undo"> volver</i></a></span>
			                </div>
			    		</div>
			    	</div>
			        <div class="box">
			            <header>
			                <h5>Información de inspección <span data-bind="text: 'numero '+model.inspeccionController.inspeccion.numero()"></span></h5>
			                <div class="toolbar">
			                    <span class="label label-info" data-bind="text: 'fecha: '+ moment(model.inspeccionController.inspeccion.fecha()).format('DD/MM/YYYY')"></span>
			                </div>                
			            </header>
			            <div class="col-lg-6">
			            	<div class="body">
			            		
				                <table class="table table-bordered table-striped">
				                    <thead>
				                        <tr>
				                            <th colspan="4" class="text-center">CARACTERISTICAS GENERALES DEL VEHICULO</th>
				                        </tr>
				                    </thead>
				                    <tbody data-bind="with: model.inspeccionController.transporte">
				                        <tr>
				                            <td>
				                                <span class="label label-default">Tipo</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: tipo()"></span>
				                            </td>
				                            <td>
				                            	<span class="label label-default">Chasis</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: chasis()"></span>
				                            </td>
				                        </tr>
				                        <tr>
				                            <td>
				                                <span class="label label-default">Marca</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: marca()"></span>
				                            </td>
				                            <td>
				                                <span class="label label-default">Motor</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: motor()"></span>
				                            </td>
				                        </tr>
				                        <tr>
				                            <td>
				                                <span class="label label-default">Modelo</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: modelo()"></span>
				                            </td>
				                            <td>
				                                <span class="label label-default">Color</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: color()"></span>
				                            </td>
				                        </tr>
				                        <tr>
				                            <td>
				                                <span class="label label-default">Placa</span>
				                            </td>
				                            <td>
				                                <span data-bind="text: placa()"></span>
				                            </td>
				                            <td>
				                                <span class="label label-default">Otros</span>
				                            </td>
				                            <td>
				                                <span></span>
				                            </td>
				                        </tr>
				                    </tbody>
				                </table>
			            	</div>

			            </div>

			            <div class="col-md-6 col-lg-6">
			            	<div class="body">
			            		
			                <table class="table table-bordered table-striped">
			                    <thead>
			                        <tr>
			                            <th colspan="4" class="text-center">ACCESORIOS</th>
			                        </tr>
			                    </thead>
			                    <tbody data-bind="with: model.inspeccionController.inspeccion">
			                        <tr>
			                            <td>
			                                <span class="label label-default">Total de llantas</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: total_llantas()" class="fa fa-check"></i>
			                                <i data-bind="visible: !total_llantas()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                            	<span class="label label-default">Radio-Tocacintas-Cd's</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: radio()" class="fa fa-check"></i>
			                                <i data-bind="visible: !radio()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Platos</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: platos()" class="fa fa-check"></i>
			                                <i data-bind="visible: !platos()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Bocinas de radio</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: bocinas_radio()" class="fa fa-check"></i>
			                                <i data-bind="visible: !bocinas_radio()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Retrovisores</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: retrovisores()" class="fa fa-check"></i>
			                                <i data-bind="visible: !retrovisores()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Vidrios</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: vidrios()" class="fa fa-check"></i>
			                                <i data-bind="visible: !vidrios()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Antenas</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: antena()" class="fa fa-check"></i>
			                                <i data-bind="visible: !antena()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Tapon de conbustible</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: tapon_conbustible()" class="fa fa-check"></i>
			                                <i data-bind="visible: !tapon_conbustible()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Silvines</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: silvines()" class="fa fa-check"></i>
			                                <i data-bind="visible: !silvines()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Tapón de radiador</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: tapon_radiadior()" class="fa fa-check"></i>
			                                <i data-bind="visible: !tapon_radiadior()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Stops</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: stops()" class="fa fa-check"></i>
			                                <i data-bind="visible: !stops()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Plumillas</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: plumillas()" class="fa fa-check"></i>
			                                <i data-bind="visible: !plumillas()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Tricket</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: tricket()" class="fa fa-check"></i>
			                                <i data-bind="visible: !tricket()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Alfombras</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: alfombras()" class="fa fa-check"></i>
			                                <i data-bind="visible: !alfombras()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Herramientas</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: herramienta()" class="fa fa-check"></i>
			                                <i data-bind="visible: !herramienta()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Pidevias</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: pidevias()" class="fa fa-check"></i>
			                                <i data-bind="visible: !pidevias()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>
			                                <span class="label label-default">Placas</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: placas()" class="fa fa-check"></i>
			                                <i data-bind="visible: !placas()" class="fa fa-close"></i>
			                            </td>
			                            <td>
			                                <span class="label label-default">Repdoructor de DVD</span>
			                            </td>
			                            <td>
			                                <i data-bind="visible: reproductor()" class="fa fa-check"></i>
			                                <i data-bind="visible: !reproductor()" class="fa fa-close"></i>
			                            </td>
			                        </tr>
			                    </tbody>
			                </table>
			            	</div>

			            </div>

			            <div class="col-lg-12" data-bind="visible: model.inspeccionController.inspeccion.multasInfo().length > 0">
			            	<div class="body">
			            		<h5> Multas por inspección</h5>
				                <table class="table table-bordered table-striped">
				                    <thead>
		                                <tr>
		                                  <th>#</th>
		                                  <th>Tipo multa</th>
		                                  <th>Causa</th>
		                                  <th>Total a pagar</th>
		                                  <th>Descuento</th>
		                                  <th>total pagado</th>
		                                  <th>Estado</th>
		                                </tr>
		                              </thead>
		                              <tbody>
		                                <!-- ko foreach: {data: model.inspeccionController.inspeccion.multasInfo, as: 'm'} -->
		                                <tr>
		                                  <td data-bind="text: m.multa.no_multa"></td>
		                                  <td data-bind="text: m.multa.tipo_multa.nombre"></td>
		                                  <td data-bind="text: m.multa.causa.nombre"></td>
		                                  <td data-bind="text: m.multa.total_a_pagar"></td>
		                                  <td data-bind="text: m.multa.descuento"></td>
		                                  <td data-bind="text: m.multa.total_pagado"></td>
		                                  <td>
		                                  <span class="label" data-bind="text: (m.multa.pagado === 1 ? 'Pagado' : 'Pendiente'), css: (m.multa.pagado === 1 ? 'label-success' : 'label-danger')"></span>
		                                  </td>
		                                </tr>
		                                <!-- /ko -->
		                              </tbody>
				                </table>
			            	</div>

			            </div>


			        </div>

			    <div class="form-group row">
                </div>
			    </div>
		    <!-- /.col-lg-12 -->
			</div>
			<div class="row" data-bind="visible: model.inspeccionController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; inspecciones <button class="text-right btn btn-success btn-sm" data-bind="click: model.inspeccionController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>No inspección</th>
			                        <th>Fecha</th>
			                        <th>Placa transporte</th>
			                        <th>Agente</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.inspeccionController.inspeccions,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: numero"></td>
                                        <td data-bind="text: moment(fecha).format('DD/MM/YYYY')"></td>
                                        <td data-bind="text: transporte.placa"></td>
                                        <td data-bind="text: agente.nombre_uno+' '+agente.apellido_uno"></td>
                                        <td width="10%">
											<a href="#" class="btn btn-primary btn-xs" data-bind="click: model.inspeccionController.view" data-toggle="tooltip" title="información"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.inspeccionController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.inspeccionController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.inspeccionController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.inspeccionController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.inspeccionController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.inspeccionController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="inspeccionForm" class="form-horizontal" data-bind="with: model.inspeccionController.inspeccion">

			                  <div class="form-group row">
			                  	<div class="col-lg-2">
			                    <label for="text2">Numero</label>
			                        <input type="number" id="numero" name="numero" class="form-control"data-bind="value: numero"
				                           data-error=".numero" required>
				                    <span class="numero text-danger help-inline"></span>
			                    </div>
				            	<div class="col-lg-3">
			                    <label for="text2">Fecha de inspeccion</label>
			                        <input type="date" id="fecha" name="fecha" class="form-control"data-bind="value: fecha"
				                           data-error=".fecha" required>
				                    <span class="fecha text-danger help-inline"></span>
			                    </div>
				                	<div class="col-lg-3 col-md-3 col-sm-8">
				                    <label for="text2">Vehiculo</label>
				                       <select class="form-control" id="marca_trasnporte" data-bind="options: model.inspeccionController.transportes, optionsText: function(v) {return v.placa},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione vehículo--',
				                       value: transporte_id, event:{change: model.inspeccionController.setVehiculo}" 
				                       data-error=".errorAgente"
					                    required></select>
					                    <span class="errorAgente text-danger help-inline"></span>
				                    </div>
				                	<div class="col-lg-4 col-md-4 col-sm-4">
				                    <label for="text2">Agente</label>
				                       <select class="form-control" id="marca_trasnporte" data-bind="options: model.inspeccionController.agentes, optionsText: function(a) {return a.nombre_uno +' '+a.apellido_uno},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione agente--',
				                       value: agente_id" 
				                       data-error=".errorAgente"
					                    required></select>
					                    <span class="errorAgente text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-6 col-md-6 col-sm-12">
										<div class="box">
										<header>
											<h5>ACCESORIOS
											</h5>
										</header>
										<div class="col-md-12">
											<div class="col-md-6 col-lg-6">
												<div class="body">
													<div>
							                            <p class="bold">Total de llanatas: <input class="pull-right" type="checkbox" data-bind="checked: total_llantas" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Platos: <input class="pull-right" type="checkbox" data-bind="checked: platos" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Retrovisores: <input class="pull-right" type="checkbox" data-bind="checked: retrovisores" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Antena: <input class="pull-right" type="checkbox" data-bind="checked: antena" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Silvines: <input class="pull-right" type="checkbox" data-bind="checked: silvines" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Stops: <input class="pull-right" type="checkbox" data-bind="checked: stops" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Tricket: <input class="pull-right" type="checkbox" data-bind="checked: tricket" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Herramientas: <input class="pull-right" type="checkbox" data-bind="checked: herramienta" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Placas: <input class="pull-right" type="checkbox" data-bind="checked: placas" /></p>
							                        </div>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="body">
													<div>
							                            <p class="bold">Radio.-ticacubtas-Cd´s: <input class="pull-right" type="checkbox" data-bind="checked: radio" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Bocinas de Radio: <input class="pull-right" type="checkbox" data-bind="checked: bocinas_radio" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Vidrios: <input class="pull-right" type="checkbox" data-bind="checked: vidrios" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Tapón de combustible: <input class="pull-right" type="checkbox" data-bind="checked: tapon_conbustible" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Tapón de radiadior: <input class="pull-right" type="checkbox" data-bind="checked: tapon_radiadior" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Alfombras: <input class="pull-right" type="checkbox" data-bind="checked: alfombras" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Pidevias: <input class="pull-right" type="checkbox" data-bind="checked: pidevias" /></p>
							                        </div>
							                        <div>
							                            <p class="bold">Reproductos de DVD: <input class="pull-right"type="checkbox" data-bind="checked: reproductor" /></p>
							                        </div>
												</div>
											</div>
										</div>
										</div>
									</div>
				                    <div class="col-lg-6 col-md-6 col-sm-12">
										<div class="box">
										<header>
											<h5>CARACTERISTICAS GENERALES DEL VEHÍCULO
											</h5>
										</header>
										<div class="col-md-12">
											<div class="col-md-6 col-lg-6">
												<div class="body">
													<ul>
														<li><label class="text-info">Tipo: </label> <span data-bind="text: model.inspeccionController.transporte.tipo()"></span></li>
														<li><label class="text-info">Marca: </label> <span data-bind="text: model.inspeccionController.transporte.marca()"></span></li>
														<li><label class="text-info">Modelo: </label> <span data-bind="text: model.inspeccionController.transporte.modelo()"></span></li>
														<li><label class="text-info">Placa: </label> <span data-bind="text: model.inspeccionController.transporte.placa()"></span></li>
													</ul>
												</div>
											</div>
											<div class="col-md-6 col-lg-6">
												<div class="body">
													<ul>
														<li><label class="text-info">Chasis: </label> <span data-bind="text: model.inspeccionController.transporte.chasis()"></span></li>
														<li><label class="text-info">Motor: </label> <span data-bind="text: model.inspeccionController.transporte.motor()"></span></li>
														<li><label class="text-info">Color: </label> <span data-bind="text: model.inspeccionController.transporte.color()"></span></li>
													</ul>
												</div>
											</div>
										</div>
										</div>
									</div>

									<div class="col-lg-12 col-md-12">
				                    <label for="text2">Observaciones (especifique)</label>
				                        <textarea rows="2" class="form-control" data-bind="value: observacion" placeholder="ingrese observacion" ></textarea>
					                    <span class="numero text-danger help-inline"></span>
				                    </div>


		                	<div class="col-lg-12 col-md-12 col-sm-12">
		                		<div>
		                            <p class="bold">Aplicar multas: <input type="checkbox" data-bind="checked: applyMulta" /></p>
		                        </div> 
							     <div class="form-group row" data-bind="visible: applyMulta">
								     <div class="col-lg-12">
				                    <label for="text2">Causa</label>
				                       <select class="form-control" id="causa" data-bind="options: model.inspeccionController.causas, optionsText: function(c) {return c.nombre},
		                      		   optionsValue: 'id',
				                       optionsCaption: '--seleccione causa--',
				                       value: causa_id, event:{change: model.inspeccionController.setCausa}" 
				                       data-error=".errorCausa"
					                    required></select>
					                    <span class="errorCausa text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4">
				                    <label for="text2">Numero</label>
				                        <input type="number" id="no_multa" name="no_multa" class="form-control"data-bind="value: no_multa"
					                           data-error=".no_multa" required>
					                    <span class="no_multa text-danger help-inline"></span>
				                    </div>
				                 <div class="col-lg-4 col-md-4 col-sm-4">
				                    <label for="text2">Tipo multa</label>
				                       <select class="form-control" id="tipo_multa" data-bind="options: model.inspeccionController.tipos, optionsText: function(a) {return a.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione tipo de multa--',
				                       value: tipo_multa_id" 
				                       data-error=".errorTipoMulta"
					                    required></select>
					                    <span class="errorTipoMulta text-danger help-inline"></span>
				                    </div>
				                <div class="col-lg-4">
			                    <label for="text2">Total a pagar</label>
			                        <input type="number" id="total_a_pagar" name="total_a_pagar" class="form-control"data-bind="value: total_a_pagar"
				                           data-error=".total_a_pagar" required>
				                    <span class="total_a_pagar text-danger help-inline"></span>
			                    </div>
			                    <div class="col-lg-12 col-md-12">
				                    <label for="text2">Observaciones (multa)</label>
				                        <textarea rows="2" class="form-control" data-bind="value: observacion_multa" placeholder="ingrese observacion de multa" ></textarea>
					                    <span class="numero text-danger help-inline"></span>
				                    </div>	
				                 <div class="col-lg-12 col-md-12 pull-right">	<br />	           
			                		<a class="btn btn-success btn-sm text-right" data-bind="click:  model.inspeccionController.addMulta"><i class="fa fa-plush"></i> Agregar</a>
				                 </div><br />
			                    <div class="col-lg-12 col-md-12 col-sm-12">
		                            <label class="text-info"> lista de multas</label>
		                            <table class="table table-responsive table-bordered">
		                              <thead>
		                                <tr>
		                                  <th>causa</th>
		                                  <th>total_a_pagar</th>
		                                  <th>opcion</th>
		                                </tr>
		                              </thead>
		                              <tbody>
		                                <!-- ko foreach: {data: model.inspeccionController.inspeccion.multas, as: 'm'} -->
		                                <tr>
		                                  <td data-bind="text: m.causa"></td>
		                                  <td data-bind="text: m.total_a_pagar"></td>
		                                  <td><a href="#" class="btn btn-danger btn-xs" data-bind="click: model.inspeccionController.removeMulta" data-toggle="tooltip" title="remover"><i class="fa fa-minus"></i></a></td>
		                                </tr>
		                                <!-- /ko -->
		                              </tbody>
		                            </table>
		                          </div>
							     </div>

				                </div>


				                <div class="form-group row">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.inspeccionController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.inspeccionController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.inspeccionController.initialize();
        });
</script>
@endsection
