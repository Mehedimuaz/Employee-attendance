@extends('home')
@section('home-content')
<?php
        $var2 = $data['var2'];
        $employee_name = $data['employee_name'];
        $next_day = $data['next_day'];
        $days = $data['days'];
        $total_salary = 0;
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$employee_name}} A Ganado</div>

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

                        @if(sizeof($days) != 0)
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <center>
                                        <button class="btn btn-md btn-success button-green" data-toggle="modal" data-target="#pay">PAGAR AHORA</button>
                                    </center>
                                </div>
                                <div class="col-md-3"></div>
                            </div><br>
                        @endif
                        <!-- Modal -->
                        <div id="pay" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <center>Are you sure?</center>
                                    </div>
                                    <div class="modal-footer">
                                        <center>
                                            <a href="{{url('/PaySalary')}}"><button class="btn btn-md btn-success" >Sí</button></a>
                                            <button type="button" class="btn btn-md btn-danger" data-dismiss="modal">No</button>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($var2 != 0)
                            <div class="row">
                                <div class="col-md-8 col-xs-8">
                                    <span>Confirmada la {{$var2 == 1? 'asistencia': 'falta'}} de {{$employee_name}} para el día de mañana {{$next_day->day}} {{$next_day->daynum}} de {{$next_day->month}} {{$next_day->year}}.</span>
                                </div>
                                <div class="col-md-4 col-xs-4">
                                    <img src="{{$var2 == 1? asset('images/tick.png'): asset('images/cross.png')}}" width="60px">
                                </div>
                            </div><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection