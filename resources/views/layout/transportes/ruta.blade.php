@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.rutaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Rutas <button class="text-right btn btn-success btn-sm" data-bind="click: model.rutaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Ubicacion</th>
			                        <th>Destino</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.rutaController.rutas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: ubicacion.nombre"></td>
                                        <td data-bind="text: destino.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.rutaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.rutaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.rutaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.rutaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.rutaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.rutaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.rutaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="rutaForm" class="form-horizontal" data-bind="with: model.rutaController.ruta">

				                <div class="form-group row">
				                   <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Ubicacion</label>
				                       <select class="form-control" id="ubicacion" data-bind="options: model.rutaController.ubicaciones, optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: ubicacion_id" 
				                       data-error=".errorForma"
					                    required></select>
					                    <span class="errorForma text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Destino</label>
				                       <select class="form-control" id="destino" data-bind="options: model.rutaController.destinos, optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: destino_id" 
				                       data-error=".errorForma"
					                    required></select>
					                    <span class="errorForma text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.rutaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.rutaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.rutaController.initialize();
        });
</script>
@endsection
