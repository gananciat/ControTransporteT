<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
              @if(isset(Auth::user()->persona->foto))
                    <img src="{{URL::asset('img/'.Auth::user()->persona->foto)}}" class="media-object img-thumbnail user-img" alt="User Image" style="height: 70px; width: 60px;">
              @else
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('img/user.gif') }}">
              @endif
                <span class="label label-danger user-label"></span>
            </a>
    
            <div class="media-body">
                <h5 class="media-heading">{{Auth::user()->persona->nombre_uno}} {{Auth::user()->persona->apellido_uno}}</h5>
                <ul class="list-unstyled user-info">
                    <li><h5 href="">Usuario: {{Auth::user()->tipo_usuario->nombre}}</h5></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="bg-dark dker">
              <li class="nav-header">Menu</li>
              <li class="nav-divider"></li>
              <li class="">
                <a href="/">
                  <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Escritorio</span>
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
                    <a href="{{ route('personasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Personas</a>
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
                    <a href="{{ route('marcaTransportesView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Marca transportes</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoTransportesView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipo transportes</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('rutasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Rutas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('lineasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Lineas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('transportesView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Transportes</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-money "></i>
                  <span class="link-title">Multas</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('montoMultasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Montos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoMultasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipos de multas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('causasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Motivos o causas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('multasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Ingresar multas</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('pagoMultasView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Pago de multas</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-money "></i>
                  <span class="link-title">Pagos anuales</span>
                  <span class="fa arrow"></span>
                </a>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('pagosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Pagos</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="{{ route('inspeccionesView') }}">
                  <i class="fa fa-check"></i><span class="link-title">&nbsp; Inspecciones</span>
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