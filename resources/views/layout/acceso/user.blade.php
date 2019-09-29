@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.userController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Usuarios <button class="text-right btn btn-success btn-sm" data-bind="click: model.userController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Usuario</th>
			                        <th>Tipo usuario</th>
			                        <th>Persona</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.userController.users,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: email"></td>
                                        <td data-bind="text: tipo_usuario.nombre"></td>
                                        <td data-bind="text: persona.nombre_uno+' '+persona.apellido_uno"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.userController.editar"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.userController.destroy"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.userController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.userController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.userController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.userController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.userController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.userController.user">

				                <div class="form-group row">
				                	<div class="col-lg-6 col-md-6 col-sm-6">
				                    <label for="linea_chofer_id">Empleado</label>
				                       <select class="form-control" id="causa_id" data-bind="options: model.userController.personas, optionsText: function(p) {return p.cui+' / '+p.nombre_uno+' '+p.apellido_uno}, 
				                       optionsValue: 'id',
				                       optionsCaption: '--seleccione empleado--',
				                       value: persona_id" 
				                       data-error=".errorPersona"
					                    required></select>
					                    <span class="errorPersona text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Rol</label>
				                       <select class="form-control" id="ubicacion" data-bind="options: model.userController.tipoUsuarios, 
				                       optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: tipo_usuario_id" 
				                       data-error=".errorTipo"
					                    required></select>
					                    <span class="errorTipo text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4">
				                    <label for="text2">Email</label>
				                        <input type="text" id="email" name="email" placeholder="ingrese correo electronico" class="form-control"data-bind="value: email"
					                           data-error=".errorEmail"
					                           minlength="3" maxlength="25" required readonly>
					                    <span class="errorEamil text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4">
				                    <label for="text2">Contraseña <span class="text-danger"> *</span></label>
		                                <input type="password" id="password" name="password" placeholder="ingrese contraseña" class="form-control"data-bind="value: password"
		                                     data-error=".errorPassword"
		                                     minlength="6" maxlength="25" required>
		                              <span class="text-danger errorPassword help-inline"></span>
				                    </div>
					                 <div class="col-lg-4">
					                    <label for="text2">Confirmar contraseña <span class="text-danger"> *</span></label>
	                                	<input type="password" id="password_confirmation" name="password_confirmation" placeholder="ingrese correo electronico" class="form-control"data-bind="value: password_confirmation"
	                                     data-error=".errorConfirmation"
	                                     minlength="6" maxlength="25" required>
	                              		<span class="text-danger errorConfirmation help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.userController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.userController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.userController.initialize();
        });
</script>
@endsection
