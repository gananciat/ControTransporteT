<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    <title>reporte</title>
    <style>
      table.blueTable {
        font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
        border: 2px solid #3C56EB;
        background-color: #DEEEDD;
        width: 100%;
        text-align: left;
        border-collapse: collapse;
      }
      table.blueTable td, table.blueTable th {
        border: 1px solid #AAAAAA;
        padding: 4px 4px;
      }
      table.blueTable tbody td {
        font-size: 11px;
      }
      table.blueTable tr:nth-child(even) {
        background: #D0E4F5;
      }
      table.blueTable thead {
        background: #487DA4;
        background: -moz-linear-gradient(top, #769dbb 0%, #5a8aad 66%, #487DA4 100%);
        background: -webkit-linear-gradient(top, #769dbb 0%, #5a8aad 66%, #487DA4 100%);
        background: linear-gradient(to bottom, #769dbb 0%, #5a8aad 66%, #487DA4 100%);
        border-bottom: 5px solid #444444;
      }
      table.blueTable thead th {
        font-size: 14px;
        font-weight: bold;
        color: #FFFFFF;
        text-align: center;
        border-left: 2px solid #D0E4F5;
      }
      table.blueTable thead th:first-child {
        border-left: none;
      }

      table.blueTable tfoot td {
        font-size: 14px;
      }
      table.blueTable tfoot .links {
        text-align: right;
      }
      table.blueTable tfoot .links a{
        display: inline-block;
        background: #1C6EA4;
        color: #FFFFFF;
        padding: 2px 8px;
        border-radius: 5px;
      }
    </style>
</head>
<body>
  <head>
      <h1 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">SISCPA V.1 SISTEMA CONTROL DE PAGOS DEL TRANSPORTE COLECTIVO</h1>
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Inspecciones realizadas</h2>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </head>
  <br>
    @foreach($inspeccions as $inspeccion)
        <div style="text-align: center; font-size: 24px; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">
          Información de inspección numero {{ $inspeccion['numero'] }}
        </div>
        <div style="text-align: center; font-size: 16px; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">
          Fecha en que se realizó la inspección {{ date('d/m/Y' ,strtotime($inspeccion['fecha'])) }}
        </div>   

        <table style="width: 100%;">
          <tr>
            <td style="vertical-align: center;">
              <table class="blueTable">
                <thead>
                  <tr>
                    <th colspan="4">CARACTERISTICAS GENERALES DEL VEHICULO</th>         
                  </tr>
                </thead>
                <tbody>       
                  <tr>
                    <td>Tipo</td>
                    <td>{{ $inspeccion->transporte->linea->tipo_transporte->nombre }}</td>
                    <td>Chasis</td>
                    <td>{{ $inspeccion->transporte->no_chasis }}</td>                       
                  </tr>
                  <tr>
                    <td>Marca</td>
                    <td>{{ $inspeccion->transporte->marca_transporte->nombre }}</td>
                    <td>Motor</td>
                    <td>{{ $inspeccion->transporte->no_motor }}</td>                       
                  </tr> 
                  <tr>
                    <td>Modelo</td>
                    <td>{{ $inspeccion->transporte->modelo }}</td>
                    <td>Color</td>
                    <td>{{ $inspeccion->transporte->color }}</td>                       
                  </tr>   
                  <tr>
                    <td>Placa</td>
                    <td>{{ $inspeccion->transporte->placa }}</td>  
                    <td>Otros</td>
                    <td></td>                                          
                  </tr>                                 
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4">Cantidad de Multas {{ count($inspeccion->inspeccion_multas) }}</td>         
                  </tr>                  
                </tfoot>
              </table>
            </td>
            <td>
            <table class="blueTable">
                <thead>
                  <tr>
                    <th colspan="4">ACCESORIOS</th>         
                  </tr>
                </thead>
                <tbody>       
                  <tr>
                    <td>Total de llantas</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Radio-Tocacintas-Cd's</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                  </tr>      
                  <tr>
                    <td>Platos</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Bocinas de radio</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                  
                  </tr>  
                  <tr>
                    <td>Retrovisores</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Vidrios</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr>  
                  <tr>
                    <td>Antenas</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Tapon de conbustible</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                  
                  </tr>   
                  <tr>
                    <td>Silvines</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Tapón de radiador</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr>  
                  <tr>
                    <td>Stops</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Plumillas</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr> 
                  <tr>
                    <td>Tricket</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Alfombras</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr>    
                  <tr>
                    <td>Herramientas</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Pidevias</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr>
                  <tr>
                    <td>Placas</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif
                    <td>Repdoructor de DVD</td>
                    @if($inspeccion->total_llantas == 1)
                      <td style="text-align:center;"><img src="img/check.jpg" width="20px" height="18px" alt=""></td>
                    @else
                      <td style="text-align:center;"><img src="img/error.jpg" width="20px" height="18px" alt=""></td>                  
                    @endif                   
                  </tr>                                                                                                                                                                   
                </tbody>
              </table>              
            </td>
          </tr>        
          <tr>
            <td style="font-size: 10px; text-right: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;" colspan="2">
              <br>
              Agente que realizó la inspección {{ $inspeccion->agente->nombre_uno.' '.$inspeccion->agente->apellido_uno }}
            </td>
          </tr>
        </table>   
        <br>
        <hr>
        <br>
    @endforeach  
</body>
</html>