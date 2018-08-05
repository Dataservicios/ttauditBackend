@extends('layouts/bayerTransferencista')


@section('content')
@section('pageTitle', $titulo)
<section>
    @include('report/partials/menuBayerTransferencista')

    <div class="cuerpo">
        <div class="cuerpo-content">
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">Listado de Rutas Período: {{$titulo}}</h4>
                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" width="100px">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">

                    <table class="table-responsive table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha Programada</th>
                            <th>Nombre</th>
                            <th>Auditor</th>
                            <th>Departamento</th>
                            <th># PDV Asignados</th>
                            <th># Auditados</th>
                            <th>Fecha Cierre</th>
                            <th>Situación</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $c=0 ?>
                        @foreach ($roads as $index => $road)
                            <tr id="{{ $road->id }}">
                                <td>{{$index +1}}</td>
                                <td>{{date('d F Y',strtotime($road->f_ejecucion))}}</td>
                                <td ><a href="{{ route('getDetailRoadForMerca', [$road->id,$company_id]) }}">{{ $road->fullname }}</a></td>

                                <td>{{ $road->auditor }}</td>
                                <td>{{ $road->departamento }}</td>
                                <td>{{ $road->pdvs }}</td>
                                <td>{{ $road->auditados }}</td>

                                <td>
                                    @if($road->pdvs==$road->auditados)
                                        {{date('d F Y',strtotime($road->cerrado))}}
                                        @else
                                    @endif
                                </td>
                                <td>
                                @if($road->pdvs==$road->auditados)
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="PDV totalmente Auditados">
                                        <span class="icon-indicador icon-table-size icon-color-green"></span>
                                    </a>
                                @else
                                    <a href="#" data-toggle="tooltip" data-placement="bottom" title="PDV aún por Auditar">
                                        <span class="icon-indicador icon-table-size icon-color-red"></span>
                                    </a>
                                @endif
                                </td>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

      </div>
    </div>
</section>
@stop
@section('scripts_ajax')

@endsection
