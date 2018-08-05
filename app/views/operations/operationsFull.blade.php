@extends('layouts/adminLayout')

@section('content')
<section>
    <div class="cuerpo" ng-app="MyStores">
        <div class="cuerpo-content" ng-controller="SearchCtrl">
            <div class="row">
                <div class="col-sm-8">
                    <h4>Operaciones Diversas:
                        @if($modulo=='eliminaPhoto')
                            Eliminación registro Media
                        @endif
                        @if($modulo=='liberarPuntosMasa')
                            Liberar Puntos
                        @endif
                    </h4>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
    <div class="cuerpo">
        <div class="cuerpo-content">
            @if($modulo=='eliminaPhoto')
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        Registro Id Media:
                    </div>
                    <div class="col-md-3">
                        {{$objMedia->id}}
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        Archivo Media:
                    </div>
                    <div class="col-md-3">
                        {{$objMedia->archivo}}
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">
                        @if($resultado)
                            archivo eliminado
                        @else
                            No existe archivo
                        @endif
                    </div>
                    <div class="col-md-3">
                        Registro eliminado
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            @endif
            @if($modulo=='liberarPuntosMasa')objCompany
                <div class="row">
                    <div class="col-sm-3">
                        campaña
                    </div>
                    <div class="col-sm-9">
                        {{$objCompany->id."-".$objCompany->fullname}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Puntos analizados
                    </div>
                    <div class="col-sm-9">
                        {{$arrayStores_id}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        Caracteristicas
                    </div>
                    <div class="col-sm-9">
                        {{"visitas: ".$visits." Devolver al mapa: ".$returnMap}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12"> Resultados Poll Details</div>
                </div>
                <div class="row">

                </div>
            @endif
        </div>
    </div>
</section>
@stop