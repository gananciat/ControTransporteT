<script src="{{ asset('lib/jquery/jquery.js') }}"></script>


<!--Bootstrap -->
<script src="{{ asset('lib/bootstrap/js/bootstrap.js') }}"></script>
<!-- MetisMenu -->
<script src="{{ asset('lib/metismenu/metisMenu.js') }}"></script>
<!-- onoffcanvas -->
<script src="{{ asset('lib/onoffcanvas/onoffcanvas.js') }}"></script>
<!-- Screenfull -->
<script src="{{ asset('lib/screenfull/screenfull.js') }}"></script>

<!-- Metis core scripts -->
<script src="{{ asset('js/core.js') }}"></script>
<!-- Metis demo scripts -->
<script src="{{ asset('js/app.js') }}"></script>


<!-- DATATABLES -->
<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>

<script src="{{ asset('js/application.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<!--  -->
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.validate.localization.js') }}"></script>
<script src="{{ asset('js/knockout-3.4.2.js')}}"></script>
<script src="{{asset('js/knockout.mapping.js')}}"></script>  
<script src="{{asset('js/bootbox.min.js')}}"></script> 
<script src="{{asset('js/toastr.min.js')}}"></script> 
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!-- scripts  -->
<script src="{{asset('scripts/js/model.js')}}"></script>
<script src="{{asset('scripts/js/anio.js')}}"></script>
<script src="{{asset('scripts/js/tipoPersona.js')}}"></script>
<script src="{{asset('scripts/js/tipoUsuario.js')}}"></script>
<script src="{{asset('scripts/js/cargo.js')}}"></script>
<script src="{{asset('scripts/js/ubicacion.js')}}"></script>
<script src="{{asset('scripts/js/destino.js')}}"></script>
<script src="{{asset('scripts/js/conceptoPago.js')}}"></script>
<script src="{{asset('scripts/js/persona.js')}}"></script>
<script src="{{asset('scripts/js/expediente.js')}}"></script>
<script src="{{asset('scripts/js/ruta.js')}}"></script>
<script src="{{asset('scripts/js/tipoTransporte.js')}}"></script>
<script src="{{asset('scripts/js/marcaTransporte.js')}}"></script>
<script src="{{asset('scripts/js/linea.js')}}"></script>
<script src="{{asset('scripts/js/propietarioLinea.js')}}"></script>
<script src="{{asset('scripts/js/LineaChofer.js')}}"></script>
<script src="{{asset('scripts/js/transporte.js')}}"></script>
<script src="{{asset('scripts/js/montoMulta.js')}}"></script>
<script src="{{asset('scripts/js/tipoMulta.js')}}"></script>
<script src="{{asset('scripts/js/causa.js')}}"></script>
<script src="{{asset('scripts/js/multa.js')}}"></script>
<script src="{{asset('scripts/js/pagoMulta.js')}}"></script>
<script src="{{asset('scripts/js/pago.js')}}"></script>
<script src="{{asset('scripts/js/inspeccion.js')}}"></script>

<!-- scripts  services-->
<script src="{{asset('scripts/services/TipoPersonaService.js')}}"></script>
<script src="{{asset('scripts/services/TipoUsuarioService.js')}}"></script>
<script src="{{asset('scripts/services/CargoService.js')}}"></script>
<script src="{{asset('scripts/services/UbicacionService.js')}}"></script>
<script src="{{asset('scripts/services/DestinoService.js')}}"></script>
<script src="{{asset('scripts/services/ConceptoPagoService.js')}}"></script>
<script src="{{asset('scripts/services/AnioService.js')}}"></script>
<script src="{{asset('scripts/services/PersonaService.js')}}"></script>
<script src="{{asset('scripts/services/ExpedienteService.js')}}"></script>
<script src="{{asset('scripts/services/RutaService.js')}}"></script>
<script src="{{asset('scripts/services/TipoTransporteService.js')}}"></script>
<script src="{{asset('scripts/services/MarcaTransporteService.js')}}"></script>
<script src="{{asset('scripts/services/LineaService.js')}}"></script>
<script src="{{asset('scripts/services/PropietarioLineaService.js')}}"></script>
<script src="{{asset('scripts/services/LineaChoferService.js')}}"></script>
<script src="{{asset('scripts/services/transporteService.js')}}"></script>
<script src="{{asset('scripts/services/MontoMultaService.js')}}"></script>
<script src="{{asset('scripts/services/TipoMultaService.js')}}"></script>
<script src="{{asset('scripts/services/CausaService.js')}}"></script>
<script src="{{asset('scripts/services/MultaService.js')}}"></script>
<script src="{{asset('scripts/services/pagoService.js')}}"></script>
<script src="{{asset('scripts/services/inspeccionService.js')}}"></script>

<script>
	$(document).ready(function () {
	    console.log("applyBindings");
	    ko.applyBindings();

	    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>

