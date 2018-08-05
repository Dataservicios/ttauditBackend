@extends('layouts/adminLayout')
@section('content')
<section>
    @include('audits/partials/menuLeftAudit')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">Cliente: {{$customer->fullname}} Campaña: {{$compaigne->fullname}}</h4>
                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" >
                </div>
            </div>
            <div class="row pt pb">
                <div class="col-md-12 pb">
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4>Reportes en Excel</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                @if(count($valoresLinksExcels)>0)
                                    <ul>
                                        @foreach($valoresLinksExcels as $valores)
                                            @if($valores->type=='excel')
                                                @if(($valores->company_id==63) or ($valores->company_id==105))
                                                    <span class="glyphicon glyphicon-info-sign"></span> <span class="alert-error" style="text-align: center">Es un excel por Fechas por favor pedir a sistemas este reporte</span>
                                                    @else
                                                    <li><span class="glyphicon glyphicon-list-alt"></span>
                                                        <a href="{{$urlBase."/".$valores->url}}" target="_blank">
                                                            <span style="font-weight: bold">{{$valores->title}}</span>
                                                            <span class="glyphicon glyphicon-cloud-download"></span><br>
                                                            @if($valores->vigente==1)
                                                                <span style="font-weight: bold">Vigente:</span> Sí
                                                            @else
                                                                <span style="font-weight: bold">Vigente:</span> No
                                                            @endif
                                                            <span style="font-weight: bold">Programador:</span> {{$valores->programador}}
                                                            <span style="font-weight: bold">Creado:</span> {{$valores->created_at}}
                                                        </a> </li>
                                                @endif

                                            @endif

                                        @endforeach
                                    </ul>
                                @else
                                    <span class="alert-error" style="text-align: center">No Hay excel para esta campaña {{$compaigne->fullname}}</span>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="report-marco ">
                        <div class="row pl">
                            <div class="col-md-12 ">
                                <h4>App Vigente</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ">
                                @if(count($valoresLinksExcels)>0)
                                    <ul>
                                        @foreach($valoresLinksExcels as $valores)
                                            @if($valores->type=='android')
                                                <li><span class="glyphicon glyphicon-list-alt"></span>
                                                    <a href="{{$urlBase."/".$valores->url}}" target="_blank">
                                                        <span style="font-weight: bold">{{$valores->title}}</span>
                                                        <span class="glyphicon glyphicon-cloud-download"></span><br>
                                                        @if($valores->vigente==1)
                                                            <span style="font-weight: bold">Vigente:</span> Sí
                                                        @else
                                                            <span style="font-weight: bold">Vigente:</span> No
                                                        @endif
                                                        <span style="font-weight: bold">Programador:</span> {{$valores->programador}}
                                                        <span style="font-weight: bold">Creado:</span> {{$valores->created_at}}
                                                    </a> </li>
                                            @endif

                                        @endforeach
                                    </ul>
                                @else
                                    <span class="alert-error" style="text-align: center">No Hay app vigente o no se a declarado para esta campaña {{$compaigne->fullname}}</span>
                                @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
