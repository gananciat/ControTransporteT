@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.pagoController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Pagos anuales</h4>
			            </header> <br />
			            <div class="form-group text-center">
				             	<div class="col-lg-12 col-md-12 col-sm-12">
					            	<div class="btn-group" data-toggle="buttons" id="light-toggle">
												<button id="showLinea" data-bind="click: function(data, event) { model.pagoController.showTable(true, data, event) }" class="btn btn-info btn-rect active"> <i class="fa fa-file"></i> Propietarios
												</button>
												<button id="showTransporte" data-bind="click: function(data, event) { model.pagoController.showTable(false, data, event) }" class="btn btn-success btn-rect active"><i class="fa fa-money"></i> Pagos
												</button>
												 </div>
												 <a href="{{ route('pagos') }}" class="btn btn-primary btn-rect active" target="_blank">Reporte de Pagos</a>
				             </div>
				        </div>
				        <div data-bind="visible: model.pagoController.flag()">
				        	
			            <div id="collapse4" class="body table-responsive" >
			                <table id="dataTableProp" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Foto</th>
			                    	<th>CUI</th>
			                        <th>Nombres</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.pagoController.propietarios,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td><img class="bgimage img-responsive" style=" height:90px;" data-bind="attr:{src: (foto !== null && foto !== '' ? '/img/'+foto : emptyLogo)}" /></td>
                                    	<td data-bind="text: cui"></td>
                                        <td data-bind="text: nombre_uno+' '+apellido_uno"></td>
                                        <td width="25%">
                                            <a href="#" class="btn btn-info btn-xs" data-bind="click: model.pagoController.editar" data-toggle="tooltip" title="ver pagos"><i class="fa fa-money"> pagos</i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
				        </div>
			            <div data-bind="visible: !model.pagoController.flag()">
			            	
			            <div id="dataTablePagosG" class="body table-responsive">
			                <table id="dataTablePagosGeneral" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Propietario</th>
			                    	<th>Linea</th>
			                        <th>Concepto pago</th>
			                        <th>Año</th>
			                        <th>Total</th>
			                        <th>Estado</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.pagoController.pagos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: propietario_linea.propietario.nombre_uno+' '+propietario_linea.propietario.apellido_uno"></td>
                                        <td data-bind="text: propietario_linea.linea.no_linea+ ' - '+propietario_linea.linea.tipo_transporte.nombre"></td>
                                        <td data-bind="text: concepto_pago_anio.concepto_pago.nombre"></td>
                                        <td data-bind="text: concepto_pago_anio.anio.anio"></td>
                                        <td data-bind="text: formatCurrency(parseFloat(total).toFixed(2))"></td>
                                        <td><span class="label" data-bind="text: (anulado ? 'Anulado' : 'Cancelado'), css: (anulado ? 'label-danger' : 'label-success')"></span></td>
                                        <td width="10%">
                                        	@if(Auth::user()->tipo_usuario->nombre == "administrador")
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="visible: !anulado, click: model.pagoController.anular" data-toggle="tooltip" title="anular"><i class="fa fa-ban"></i></a>
                                            @endif
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.pagoController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<br />
			    	<div class="row">
			    		<div class="form-group col-lg-12">
			                <div class="text-right">
			                    <span><a class="text-danger" href="javascript:;"><i data-bind="click: model.pagoController.volver" class="fa fa-undo"> volver</i></a></span>
			                </div>
			    		</div>
			    	</div>
				    <div class="box dark">
				        <header>
				            <h5> Pagos <span data-bind="text: model.pagoController.pago.propietario()"></span></h5>           <!-- /.toolbar -->
				        </header>
				        <div class="body">
				        	@if(Auth::user()->tipo_usuario->nombre == "administrador")
				            <form id="pagoForm" class="form-horizontal" data-bind="with: model.pagoController.pago">

				            	<div class="form-group row">
				            		<div class="col-lg-3 col-md-3 col-sm-6">
				                    <label for="anio">Año</label>
				                       <select class="form-control" id="ruta" data-bind="options: model.pagoController.anios, optionsText: function(anio) {return anio.anio},
                              		   optionsValue: 'concepto_pago_anios',
				                       optionsCaption: '--seleccione año--',
				                       value: concepto, event:{change: model.pagoController.getConceptos}"
				                       data-error=".errorAnio"></select>
					                    <span class="errorAnio text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-3 col-md-3 col-sm-6">
				                    <label for="anio">Concepto pago</label>
				                       <select class="form-control" id="ruta" data-bind="options: model.pagoController.concepto_pagos, optionsText: function(concepto) {return concepto.concepto_pago.nombre},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione concepto pago--',
				                       value: concepto_pago_anio_id, 
				                       event:{change: model.pagoController.setTotal}" 
				                       data-error=".errorConcepts"
					                    required></select>
					                    <span class="errorConcepts text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-3 col-md-3 col-sm-6">
				                    <label for="text2">Linea</label>
				                       <select class="form-control" id="ruta" data-bind="options: model.pagoController.lineas, optionsText: function(linea) {return linea.linea.no_linea},
                              		   optionsValue: 'id',
				                       optionsCaption: '--seleccione linea--',
				                       value: propietario_linea_id" 
				                       data-error=".errorLinea"
					                    required></select>
					                    <span class="errorLinea text-danger help-inline"></span>
				                    </div>
				                    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
			                          <label for="monto"> Monto</label>
			                              <input type="number" id="total" name="total" class="form-control" data-bind="value: total" readonly>
			                        </div>

			                        <div class="form-group">
				                	<div class="col-md-12 col-lg-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.pagoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.pagoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				                </div>

				            </form>
				            @endif

				            <div id="tablePagosPropieta" class="body table-responsive">
			                <table id="tablePagosPropietarios" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Linea</th>
			                    	<th>Concepto pago</th>
			                    	<th>Año</th>
			                    	<th>total pago</th>
			                    	<th>Estado</th>
			                    	<th>Opciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.pagoController.propietarioPagos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: propietario_linea.linea.no_linea+ ' - '+propietario_linea.linea.tipo_transporte.nombre"></td>
                                        <td data-bind="text: concepto_pago_anio.concepto_pago.nombre"></td>
                                        <td data-bind="text: concepto_pago_anio.anio.anio"></td>
                                        <td data-bind="text: formatCurrency(parseFloat(total).toFixed(2))"></td>
                                        <td><span class="label" data-bind="text: (anulado ? 'Anulado' : 'Cancelado'), css: (anulado ? 'label-danger' : 'label-success')"></span></td>
                                        <td width="10%">
                                        	@if(Auth::user()->tipo_usuario->nombre == "administrador")
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="visible: !anulado, click: model.pagoController.anular" data-toggle="tooltip" title="anular"><i class="fa fa-ban"></i></a>
                                            @endif
                                        </td>
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
</div>


<script>
        $(document).ready(function () {
            model.pagoController.initialize();
        });
</script>
@endsection
