@extends('layouts.app')

@section('content')
    <?php
    $days = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $months = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    $curtime = strtotime('+6 hour', time());
    $day = $days[date('w', $curtime)];
    $daynum = date('d', $curtime);
    $month = $months[date('n', $curtime) - 1];
    $year = date('Y', $curtime);

            $user = $data['user'];
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>MARCATTO</h2><br> <small>{{$day.' '.$daynum.' de '.$month.' '.$year.' (Current time)' }}</small></div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/SupervisorSettings') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="name" value="{{$user->name}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Nuevo password (Si es necesario)</label>

                                <div class="col-md-6">
                                    <input id="email" type="password" class="form-control" name="new_password" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Confirmar nuevo password</label>

                                <div class="col-md-6">
                                    <input id="email" type="password" class="form-control" name="new_password1"  >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Password Actual (Obligatorio)</label>

                                <div class="col-md-6">
                                    <input id="email" type="password" class="form-control" name="password"  required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection