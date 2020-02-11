@extends('home')
@section('home-content')

    <?php
            $next_day = $data['next_day'];
            $today = $data['today'];
            $employee_name = $data['employee_name'];
            $var1 = $data['var1'];
            $var2 = $data['var2'];
            $var3 = $data['var3'];
            $var4 = $data['var4'];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if($var1 != 0)
                            <div class="row">
                                <div class="col-md-8 col-xs-8">
                                    <span>Usted a confirmado que {{$employee_name}} {{$var1 == 1? 'asistió': 'ausento'}} el día de hoy {{$today->day}} {{$today->daynum}} de {{$today->month}} {{$today->year}}.</span>
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <img src="{{$var1 == 1? asset('images/tick.png'): asset('images/cross.png')}}" width="43px">
                                </div>
                                <div class="col-md-2 col-xs-4">
                                    <a href="{{url('/RevertAttendance')}}"> <img src="{{asset('images/pencil.png')}}" width="40px"></a>
                                </div>
                            </div><br>
                        @endif
                        @if($var2 != 0)
                                <div class="row">
                                    <div class="col-md-8 col-xs-8">
                                        <span>Confirmada la {{$var2 == 1? 'asistencia': 'falta'}} de {{$employee_name}} para el día de mañana {{$next_day->day}} {{$next_day->daynum}} de {{$next_day->month}} {{$next_day->year}}.</span>
                                    </div>
                                    <div class="col-md-2 col-xs-4">
                                        <img src="{{$var2 == 1? asset('images/tick.png'): asset('images/cross.png')}}" width="43px">
                                    </div>
                                    <div class="col-md-2 col-xs-4">
                                        <a href="{{url('/RevertRequest')}}"><img src="{{asset('images/pencil.png')}}" width="40px"></a>
                                    </div>
                                </div><br>
                            @endif
                        @if($var3 != 0)
                                <div class="row">
                                    <center>{{$employee_name}} tiene asistencia Confirmada para hoy {{$today->day}} {{$today->daynum}} de {{$today->month}} {{$today->year}}. Asistió?</center>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <button class="btn btn-md pull-right btn-success button-green" data-toggle="modal" data-target="#attendance1">Sí</button>
                                    </div>
                                    <!-- Modal -->
                                    <div id="attendance1" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>Estas seguro que deseas confirmar que {{$employee_name}} aistió el día de hoy?</center>
                                                </div>
                                                <div class="modal-footer">
                                                    <center>
                                                        <a href="{{url('/MakeAttendance')}}"><button class="btn btn-md btn-success" >ACEPTAR</button></a>
                                                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">CANCELAR</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <button class="btn btn-md pull-left btn-success button-brown" data-toggle="modal" data-target="#absence1">No</button>
                                    </div>
                                    <!-- Modal -->
                                    <div id="absence1" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <center>Are you sure?</center>
                                                </div>
                                                <div class="modal-footer">
                                                    <center>
                                                        <a href="{{url('/MakeAbsence')}}"><button class="btn btn-md btn-success" >ACEPTAR</button></a>
                                                        <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">CANCELAR</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                            @endif
                        @if($var4 != 0)
                                <div class="row">
                                    <center>{{$employee_name}} desea {{$var4 == 1? 'asistir': 'omitir'}} el dia de mañana {{$next_day->day}} {{$next_day->daynum}} de {{$next_day->month}} {{$next_day->year}}.</center>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <center>
                                            <button class="btn btn-md btn-success button-green" <?php if($var4 == -1) echo 'style="background-color: #D2691E !important;"'; ?> data-toggle="modal" data-target="#attendance2">ACEPTAR<br>{{$var4 == 1? 'ASISTENCIA': 'FALTA'}}</button>
                                        </center>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <!-- Modal -->
                                <div id="attendance2" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <center>Estas seguro que deseas confirmar que {{$employee_name}} aistió el día de hoy?</center>
                                            </div>
                                            <div class="modal-footer">
                                                <center>
                                                    <a href="{{url('/AcceptAttendanceRequest')}}"><button class="btn btn-md btn-success" >ACEPTAR</button></a>
                                                    <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">CANCELAR</button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection