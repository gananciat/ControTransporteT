<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('img/user.gif') }}">
                <span class="label label-danger user-label">16</span>
            </a>
    
            <div class="media-body">
                <h5 class="media-heading">Usuario</h5>
                <ul class="list-unstyled user-info">
                    <li><a href="">Administrador</a></li>
                    <li>Ultimo Acceso : <br>
                        <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="bg-dark dker">
              <li class="nav-header">Menu</li>
              <li class="nav-divider"></li>
              <li class="">
                <a href="dashboard.html">
                  <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
                </a>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Administracion</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoPersonasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipo Personas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('cargosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Cargos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('ubicacionesView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Ubicaciones</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('destinosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Destinos</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-cog "></i>
                  <span class="link-title">Configuración Anual</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('conceptoPagosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Concepto de Pagos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('aniosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Años</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-bus"></i>
                  <span class="link-title">Transportes</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="#">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipo Documentos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="#">
                      <i class="fa fa-angle-right"></i>&nbsp; Personas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="#">
                      <i class="fa fa-angle-right"></i>&nbsp; Transportes</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; Revisiones</span>
                </a>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; Pagos</span>
                </a>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-user "></i>
                  <span class="link-title">Acceso</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoUsuariosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipo Usuarios</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoUsuariosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Usuarios</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; Ayuda</span>
                </a>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; a cerca de</span>
                </a>
              </li><br /><br />
              <li class="">
                
              </li>
            </ul>
    <!-- /#menu -->
</div>