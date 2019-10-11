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
      <h2 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Reporte de Multas</h2>
      <h5 style="text-align: center; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">Fecha {{ date('d/m/Y H:i:s') }}</h5>
  </head>
  <br>
    @foreach($ver_no_pagadas as $key => $multa)
        <div style="text-align: center; font-size: 24px; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">
          {{ $multa['multa'] }}
        </div>
        <table class="blueTable">
          <thead>
            <tr>
              <th>Correlativo</th>
              <th>No Multa</th>
              <th>Fecha</th>
              <th>Total</th>
              <th>Causa</th>
              <th>Placa</th>
              <th>No Tarjeta</th>
              <th>Chofer</th>
              <th>Agente</th>
              <th>------</th>            
            </tr>
          </thead>
            <tbody>       
              @foreach($multas_no_pagadas as $informacion)
                @if($multa['identificador'] == $informacion['identificador'])
                <tr>
                  <td style="text-align: center;">{{ $informacion['correlativo'] }}</td>
                  <td style="text-align: center;">{{ $informacion['no_multa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['fecha_multa'] }}</td>
                  <td style="text-align: right;">Q {{ $informacion['total_a_pagar'] }}</td>
                  <td>{{ $informacion['causa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['placa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['no_tarjeta'] }}</td>
                  <td>{{ $informacion['chofer'] }}</td>       
                  <td>{{ $informacion['agente'] }}</td>
                  <td style="text-align: center;">{{ $informacion['info'] }}</td>                           
                </tr>
                @endif
              @endforeach
            </tbody>
        </table>
        <br>
        <hr>
        <br>
    @endforeach

    @foreach($ver_pagadas as $key => $multa)
        <div style="text-align: center; font-size: 24px; font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;">
          {{ $multa['multa'] }}
        </div>
        <table class="blueTable">
          <thead>
            <tr>
              <th>Correlativo</th>
              <th>No Multa</th>
              <th>Fecha</th>
              <th>Total</th>
              <th>Causa</th>
              <th>Placa</th>
              <th>No Tarjeta</th>
              <th>Chofer</th>
              <th>Agente</th>
              <th>------</th>            
            </tr>
          </thead>
            <tbody>       
              @foreach($multas_pagadas as $informacion)
                @if($multa['identificador'] == $informacion['identificador'])
                <tr>
                  <td style="text-align: center;">{{ $informacion['correlativo'] }}</td>
                  <td style="text-align: center;">{{ $informacion['no_multa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['fecha_multa'] }}</td>
                  <td style="text-align: right;">Q {{ $informacion['total_a_pagar'] }}</td>
                  <td>{{ $informacion['causa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['placa'] }}</td>
                  <td style="text-align: center;">{{ $informacion['no_tarjeta'] }}</td>
                  <td>{{ $informacion['chofer'] }}</td>       
                  <td>{{ $informacion['agente'] }}</td>
                  <td style="text-align: center;">{{ $informacion['info'] }}</td>                           
                </tr>
                @endif
              @endforeach
            </tbody>
        </table>
        <br>
        <hr>
        <br>
    @endforeach    
</body>
</html>