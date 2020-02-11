@extends('layouts.app')

@section('content')
    <?php $dates = $data['dates'];?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["calendar"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'date', id: 'Date' });
            dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
            dataTable.addRows([
                <?php
                foreach ($dates as $day){
                    echo '[ new Date('.$day->year.', '.$day->month.', '.$day->day.'), '.$day->value.'],';
                }
                ?>
            ]);

            var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

            var options = {
                height: {{(date('Y') - 2017 + 1) * 170}},
                calendar: {
                    noDataPattern: {
                        backgroundColor: '#76a7fa',
                        color: '#a0c3ff'
                    },
                    cellColor: {
                        stroke: '#76a7fa',
                        strokeOpacity: 0.1,
                        strokeWidth: 1,
                    },
                    focusedCellColor: {
                        stroke: '#d3362d',
                        strokeOpacity: 1,
                        strokeWidth: 1,
                    },
                    dayOfWeekLabel: {
                        fontName: 'Times-Roman',
                        fontSize: 12,
                        color: '#1a8763',
                        bold: true,
                        italic: true,
                    },
                    dayOfWeekRightSpace: 10,
                    daysOfWeek: 'DLMMJVS',
                    monthLabel: {
                        fontName: 'Times-Roman',
                        fontSize: 12,
                        color: '#981b48',
                        bold: true,
                        italic: true
                    },
                    underYearSpace: 10, // Bottom padding for the year labels.
                    yearLabel: {
                        fontName: 'Times-Roman',
                        fontSize: 32,
                        color: '#1A8763',
                        bold: true,
                        italic: true
                    },


                },
                colorAxis: {colors:['red','#004411']},

            };

            chart.draw(dataTable, options);
        }
    </script>
    <?php
    $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $curtime = time(); //strtotime('+6 hour', time());
    $day = $days[date('w', $curtime)];
    $daynum = date('d', $curtime);
    $month = $months[date('n', $curtime) - 1];
    $year = date('Y', $curtime);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>MARCATTO</h2><br> <small>{{$day.' '.$daynum.' de '.$month.' '.$year.' (Current time)' }}</small></div>
                </div>
            </div>
        </div>
    </div>
    <div id="calendar_basic" style="width: 1000px; height: {{(date('Y') - 2017 + 1) * 350}}px; margin: auto;"></div>
    @yield('home-content')

@endsection
