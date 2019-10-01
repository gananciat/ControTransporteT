@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<header>
                <div class="icons"><i class="fa fa-password"></i></div>
                <h4 class="title">&nbsp; Cambiar contraseña</h4>
            </header>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <div class="body col-md-12 col-lg-12">
				            <form id="changeForm" class="form-horizontal" data-bind="with: model.userController.user">

				                <div class="form-group row">
				                	<div class="form-group col-lg-4 col-md-4col-sm-4 col-xs-4">
					                    <label for="text2">Contraseña anterior <span class="text-danger"> *</span></label>
					                        <input type="password" id="old_password" name="old_password" placeholder="ingrese contraseña anterior" class="form-control"data-bind="value: old_password"
					                             data-error=".errorOldPass"
					                             minlength="6" maxlength="25" required>
					                      <span class="text-danger errorOldPass help-inline"></span>
					                  </div>
				                    <div class="col-lg-4">
				                    <label for="text2">Nueva contraseña <span class="text-danger"> *</span></label>
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
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.userController.cambiar"><i class="fa fa-save"></i> Cambiar</a>
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
</script>
@endsection
