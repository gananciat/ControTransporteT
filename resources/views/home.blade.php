@extends('layout.main')
@section('content')

<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            &nbsp;  <h3>ESCRITORIO</h3>
            <br>

            <div class="row">
                <div class="col-md-12"> 
                    <h1 class="box-title text-center">Pagos realizados en el año {{ date('Y') }}</h1>
                    <div class="chart-area">
                        <canvas id="graficapagos"></canvas>
                    </div>                        
                </div>
                <br>
                <div class="col-md-6"> 
                    <h1 class="box-title text-center" id="primer_multa"></h1>
                    <div class="chart-area">
                        <canvas style="width:1000px !important; height:600px !important;" id="graficaprimermulta"></canvas>
                    </div>                        
                </div> 
                <div class="col-md-6"> 
                    <h1 class="box-title text-center" id="segunda_multa"></h1>
                    <div class="chart-area">
                        <canvas style="width:1000px !important; height:600px !important;" id="graficasegundamulta"></canvas>
                    </div>                        
                </div>      
                <br>
                <div class="col-md-6" style="text-align:center;"> 
                    <h1 class="box-title text-center">Cantidad de líneas registradas</h1>
                    <div class="chart-area text-center">
                        <canvas id="graficalineas"></canvas>
                    </div>                        
                </div>    
                <div class="col-md-6" style="text-align:center;"> 
                    <h1 class="box-title text-center">Cantidad de rutas registradas</h1>
                    <div class="chart-area">
                        <canvas style="width:1000px !important; height:600px !important;" id="graficarutas"></canvas>
                    </div>                        
                </div>                                                                  
            </div>             
        </div>        
    </div>   
</div>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>

    var ejecuto = false;    
    $(function() {
        if(ejecuto === false)
        {
            ejecuto = true;
            $.get('/grafica/pagos', function(data){
                grafica_pagos(data.grafica,data.label);
            });     

            $.get('/grafica/lineas', function(data){
                grafica_lineas(data.grafica,data.label);
            }); 

            $.get('/grafica/rutas', function(data){
                grafica_rutas(data.grafica,data.label);
            });      

            $.get('/grafica/primer_tipo_pago', function(data){
                grafica_primer_tipo_pago(data.grafica,data.label,data.indicador);
            });  
            
            $.get('/grafica/segundo_tipo_pago', function(data){
                grafica_segundo_tipo_pago(data.grafica,data.label,data.indicador);
            });                                                      
        }
    })

    function grafica_pagos(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficapagos").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        }; 


        gradientChartOptionsConfiguration =  {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },

            responsive: true,

            scales:{
                yAxes: [{
                    ticks: {
                        suggestedMin:0,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],
            }             
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Total Q ",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                  
                fill: true,
                borderColor: '#d058b6',
                borderWidth: 2,
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }  

    function grafica_lineas(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficalineas").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        }; 


        gradientChartOptionsConfiguration =  {
            maintainAspectRatio: false,
            legend: {
                display: false
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },

            responsive: true,

            scales:{
                yAxes: [{
                    ticks: {
                        suggestedMin:0,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }],
            }             
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Cantidad",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                  
                fill: true,
                borderColor: '#d058b6',
                borderWidth: 2,
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }    

    function grafica_rutas(dato_grafica, label_grafica)
    {
        var ctx = document.getElementById("graficarutas").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };        

        gradientChartOptionsConfiguration =  {
            legend: {
                display: true,
                labels: {
                    padding: 20
                },
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,           
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Cantidad",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }    

    function grafica_primer_tipo_pago(dato_grafica, label_grafica, indicador)
    {
        $('#primer_multa').empty()
        $('#primer_multa').html('Cantidad de '+indicador)
        var ctx = document.getElementById("graficaprimermulta").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };        

        gradientChartOptionsConfiguration =  {
            legend: {
                display: true,
                labels: {
                    padding: 20
                },
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,           
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Cantidad",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }  

    function grafica_segundo_tipo_pago(dato_grafica, label_grafica, indicador)
    {
        $('#segunda_multa').empty()
        $('#segunda_multa').html('Cantidad de '+indicador)
        var ctx = document.getElementById("graficasegundamulta").getContext("2d");

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(231,233,237)'
        };        

        gradientChartOptionsConfiguration =  {
            legend: {
                display: true,
                labels: {
                    padding: 20
                },
            },

            tooltips: {
                backgroundColor: '#fff',
                titleFontColor: '#333',
                bodyFontColor: '#666',
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest"
            },
            responsive: true,           
        };

        var data = {
            labels: label_grafica,
            datasets: [{
                label: "Cantidad",
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.blue,
                ],                
                data: dato_grafica,
            }]
        };  

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: gradientChartOptionsConfiguration
        });                      
    }       
</script>  
@endsection