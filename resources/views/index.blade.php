@extends('layouts.layout')
@section('contenido')
<div class="container">
    <div class="row">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-registro-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-registro" type="button" role="tab" aria-controls="nav-registro"
                    aria-selected="true">Registrar</button>
                <button class="nav-link" id="nav-ingresos-tab" data-bs-toggle="tab" data-bs-target="#nav-ingresos"
                    type="button" role="tab" aria-controls="nav-ingresos" aria-selected="false">Ingresos</button>
                <button class="nav-link" id="nav-egresos-tab" data-bs-toggle="tab" data-bs-target="#nav-egresos"
                    type="button" role="tab" aria-controls="nav-egresos" aria-selected="false">Egresos</button>
                <button class="nav-link" id="nav-total-tab" data-bs-toggle="tab" data-bs-target="#nav-total"
                    type="button" role="tab" aria-controls="nav-total" aria-selected="false">Total Ganancias</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-registro" role="tabpanel" aria-labelledby="nav-registro-tab">
                <form method="POST" action="Registrar">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput">Descripcion</label>
                        <input type="text" class="form-control" name="Descripcion" placeholder="Descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Fecha</label>
                        <input type="date" class="form-control" name="Fecha" placeholder="Fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Monto</label>
                        <input type="number" class="form-control" name="Monto" placeholder="Monto" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tipo de Movimiento</label>
                        <select class="form-select" name="Tipo_Movimiento" required>
                            <option value="" selected>Seleccione el tipo de Movimiento</option>
                            <option value="1">Ingreso</option>
                            <option value="2">Egreso</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>

                </form>

            </div>
            <div class="tab-pane fade" id="nav-ingresos" role="tabpanel" aria-labelledby="nav-ingresos-tab">

                <table id="ingresosTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ingresos as $informacion_ingresos)
                        <tr>
                            <td>{{$informacion_ingresos->id_ingreso}} </td>
                            <td>{{$informacion_ingresos->descripcion_ingreso}}</td>
                            <td> ${{number_format($informacion_ingresos->monto_ingreso, 0, '', '.')}}
                            </td>
                            <td>{{date("d-m-Y", strtotime($informacion_ingresos->fecha_ingreso))}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-egresos" role="tabpanel" aria-labelledby="nav-egresos-tab">

                <table id="egresosTable" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($egresos as $informacion_egresos)
                        <tr>
                            <td>{{$informacion_egresos->id_egreso}} </td>
                            <td>{{$informacion_egresos->descripcion_egreso}}</td>
                            <td> ${{number_format($informacion_egresos->monto_egreso, 0, '', '.')}}
                            </td>
                            <td>{{date("d-m-Y", strtotime($informacion_egresos->fecha_egreso))}}

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-total" role="tabpanel" aria-labelledby="nav-total-tab">

                @foreach($meses_unicos as $meses)
                @php($mes_fecha = \Carbon\Carbon::createFromDate(null, $meses, 1))
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">
                                {{ $mes_fecha->format('F')  }}</th>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col">Ingreso </th>
                            <th scope="col">Egreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @foreach($total_ingresos as $ingresos_totales)
                                @php($ingreso_mes = 0)
                                @if($ingresos_totales->mes == $meses)
                                @php($ingreso_mes = $ingresos_totales->total)
                                @break
                                @endif
                                @endforeach
                                ${{number_format($ingreso_mes, 0, '', '.')}}
                            </td>
                            <td>
                                @foreach($total_egresos as $egresos_totales)
                                @php($egresos_mes = 0)
                                @if($egresos_totales->mes == $meses)
                                @php($egresos_mes = $egresos_totales->total)
                                @break
                                @endif
                                @endforeach
                                ${{number_format($egresos_mes, 0, '', '.')}}
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{number_format($ingreso_mes-$egresos_mes, 0, '', '.')}}</td>
                        </tr>
                    </tbody>
                </table>


                @endforeach
            </div>
        </div>


    </div>
</div>
@endsection