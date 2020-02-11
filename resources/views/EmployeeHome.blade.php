@extends('home')
@section('home-content')

    <?php
            $next_day = $data['next_day'];
            $today = $data['today'];
            $var1 = $data['var1'];
            $var2 = $data['var2'];
            $days = $data['days'];
            $total_salary = 0;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table style="width: 100%;">
                            @foreach($days as $day)
                                <tr>
                                    <td>{{$day->day}} {{$day->daynum}} {{$day->month}} {{$day->year}}</td>
                                    <td>{{$day->salary}}</td>
                                    <?php $total_salary = $total_salary + $day->value; ?>
                                </tr>
                            @endforeach
                                @if(sizeof($days) != 0)
                                    <tr>
                                        <td>   &nbsp  </td>
                                        <td>   &nbsp  </td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Acumulado</b></td>
                                        <td>$ {{$total_salary}}</td>
                                    </tr>
                                @endif
                        </table><br>
                        @if($var1 != 0)
                            <div class="row">
                                <div class="col-md-9 col-xs-8">
                                    <span>{{$var1 == 1? 'Asistencia': 'Falta'}} confirmada para {{$next_day->day}} {{$next_day->daynum}} de {{$next_day->month}} {{$next_day->year}}</span>
                                </div>
                                <div class="col-md-3 col-xs-4">
                                    <img src="{{$var1 == 1? asset('images/tick.png'): asset('images/cross.png')}}" width="50px">
                                </div>
                            </div><br>
                        @endif
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <button class="btn btn-md pull-right btn-success button-green" data-toggle="modal" data-target="#attendance">Solicitar<br> Asistencia</button>
                            </div>
                            <!-- Modal -->
                            <div id="attendance" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <center>Estas seguro que deseas confirmar asistencia para el dia de mañana {{$next_day->day}} {{$next_day->daynum}} {{$next_day->month}} {{$next_day->year}}?</center>
                                        </div>
                                        <div class="modal-footer">
                                            <center>
                                                <a href="{{url('/RequestAttendance/attendance')}}"><button class="btn btn-md btn-success" >ACEPTAR</button></a>
                                                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">CANCELAR</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <button class="btn btn-md pull-left btn-success button-brown" data-toggle="modal" data-target="#absence">Solicitar<br> Falta</button>
                            </div>
                            <!-- Modal -->
                            <div id="absence" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <center>Estas seguro que deseas confirmar falta para el dia de mañana {{$next_day->day}} {{$next_day->daynum}} {{$next_day->month}} {{$next_day->year}}?</center>
                                        </div>
                                        <div class="modal-footer">
                                            <center>
                                                <a href="{{url('/RequestAttendance/absence')}}"><button class="btn btn-md btn-success" >ACEPTAR</button></a>
                                                <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">CANCELAR</button>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        @if($var2 != 0)
                            <div class="row">
                                <center>ESPERANDO CONFIRMACIÓN DE {{$var2 == 1? 'ASISTENCIA': 'FALTA'}} POR {{strtoupper($data['supervisor_name'])}}  PARA EL DIA DE MAÑANA {{$next_day->daynum}} DE {{strtoupper($next_day->month)}} {{$next_day->year}}</center>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection