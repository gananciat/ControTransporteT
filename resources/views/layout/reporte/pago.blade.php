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
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Reporte de Pagos del {{ date('Y') }}</h2>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </head>
  <br>
    @foreach($conceptos as $key => $concepto)
        <div style="text-align: center; font-size: 24px; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">
          {{ $concepto['nombre'] }}
        </div>
        <table class="blueTable">
          <thead>
            <tr>
              <th>Correlativo</th>
              <th>No Linea</th>
              <th>Propietario</th>
              <th>Total</th>          
            </tr>
          </thead>
          <tbody>       
            @foreach($pagos as $pago)
              @if($pago['nombre'] == $concepto['nombre'])
              <tr>
                <td style="text-align: center;">{{ $pago['correlativo'] }}</td>
                <td style="text-align: center;">{{ $pago['no_linea'] }}</td>
                <td>{{ $pago['propietario'] }}</td>
                <td style="text-align: right;">Q {{ $pago['total'] }}</td>                        
              </tr>
              @endif
            @endforeach
          </tbody>
          <tfoot>
            @foreach($totales as $total)
              @if($total['nombre'] == $concepto['nombre'])
                <tr>
                  <td style="text-align: right;" colspan="3">Total Pagado</td>
                  <td style="text-align: right;">Q {{ number_format($total['total_general']) }}</td>
                </tr>  
              @endif
            @endforeach          
          </tfoot>
        </table>
        <br>
        <hr>
        <br>
    @endforeach  
</body>
</html>