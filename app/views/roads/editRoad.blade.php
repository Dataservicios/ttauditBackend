@extends('layouts/adminLayout')
@section('scripts_angular')
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.3.13/angular.min.js') }}
    {{ HTML::script('js/app.js') }}
@stop
@section('content')
    <section>
        @include('roads/partials/menuLeft')
        <div class="cuerpo">
            <div class="cuerpo-content">
                <div class="row pt pb">
                    <div class="col-sm-12">

                        <div class="report-marco ">
                            <div class="contenedor-report">
                                <h4>Nombre Ruta: {{$road->fullname}} </h4>
                                <span id="pdvs">{{count($roadDetails)}}</span><span> PDV</span><br>
                                Codigo Ruta: {{$road->id}} |
                                Situación: <a href="#" data-toggle="tooltip" data-placement="bottom" title="@if($road->audit==0) PDV aún por Auditar @else PDV fueron Auditados @endif">
                                    <span class="@if($road->audit==0)icon-indicador icon-table-size icon-color-red @else icon-indicador icon-table-size icon-color-green @endif"></span>
                                </a> |
                                PDV Auditados: {{$auditados}} |
                                Auditor: {{$road->user->fullname}} |
                                Fecha Ejecución: {{date('d F Y',strtotime($road->f_ejecucion))}}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="row pt pb">
                    <div class="col-sm-12">
                        <div class="report-marco ">
                            <div class="contenedor-report">
                                <h4>Datos Ruta</h4>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@section('scripts_ajax')
    <script type="application/javascript">
        $('#alertaFiltro').on('closed.bs.alert', function () {
            $('.alertaFiltro').hide("slow");
        })
        $(document).ready(function(){

        });
    </script>
@endsection