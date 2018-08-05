@extends('layouts/clienteIBK')

@section('content')
    <section>
        @include('report/partials/menuPrincipalInterbank')
        <div class="cuerpo">

            <div class="cuerpo-content">
                <div class="row pt pb">
                    <div class="col-sm-9">
                        <h4 class="report-title">{{$titulo}}</h4>
                    </div>
                    <div class="col-sm-3">
                        <img src="{{$logo}}" width="200px">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ Form::open(['route' => 'getPhotosInventoryFilter', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'pollPhoto' , 'validate']) }}
                        <div class="report-marco ">
                            <div class="contenedor-report">
                                <div class="row">

                                    <div class="col-md-8">
                                        <input type="text" id="store_id" name="store_id" class="form-control" placeholder="Digite codigo Tienda">
                                        {{ Form::hidden('company_id', 139, ['id' => 'company_id']) }}
                                    </div>

                                    <div class="col-md-4"><button type="submit" value="Buscar">Buscar</button> </div>
                                </div>

                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                @if($msj<>"")
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert" id="alert">{{$msj}}</div>
                        </div>
                    </div>
                @endif
                @if(count($polls)>0)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="report-marco ">
                                <div class="contenedor-report">
                                    <h4>Detalle PDV</h4>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Nombre PDV (id):</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->fullname}}</div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Id:</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->id}}</div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Cod. Cliente:</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->codclient}}</div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Dirección:</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->address}}</div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Distrito:</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->district}}</div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <div   class="btn btn-default btn-si">Ciudad:</div>
                                        <div   class="btn btn-default btn-valor">{{$objStore->region}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                <div class="row">
                    <div class="col-md-12">
                        @if(count($polls)>0)
                            @foreach($polls as $index=> $poll)
                                <div class="row">
                                    <div class="col-md-12 pb">
                                        <div class="report-marco ">
                                            <div class="row pl">
                                                <div class="col-md-12 ">
                                                    <h4>
                                                        <span class="badge">{{$index +1}}</span> Pregunta {{$poll->question."( Id: ".$poll->id.")"}}
                                                    </h4>
                                                </div>
                                            </div>
                                            @if(count($datosFotos)>0)
                                                @if($poll->categoryProduct==1)
                                                    @foreach($categoriesProducts as $categoriesProduct)
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4>{{$categoriesProduct->fullname}}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @foreach($datosFotos as $datosFoto)
                                                                    @if(($poll->id==$datosFoto['poll_id']) and ($categoriesProduct->id==$datosFoto['category_product_id']))
                                                                        <div id="{{'Impreso'.$datosFoto['id']}}">
                                                                            <a href="{{$datosFoto['urlFoto']}}" class="zoom1 btn btn-default" data-fancybox-group="button"><img src="{{$datosFoto['urlFoto']}}" width="200px" class="img-thumbnail"></a>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @foreach($datosFotos as $datosFoto)
                                                                @if($poll->id==$datosFoto['poll_id'])
                                                                    <div id="{{'Impreso'.$datosFoto['id']}}">
                                                                        <a href="{{$datosFoto['urlFoto']}}" class="zoom1 btn btn-default" data-fancybox-group="button"><img src="{{$datosFoto['urlFoto']}}" width="200px" class="img-thumbnail"></a>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('reportCSS')
    <!-- Galeria de imagenes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/jquery.fancybox.css?v=2.1.5') }}" media="screen" />
    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5') }}" />
@endsection
@section('report')
    <!--LIBRERIA fancybox PARA ZOOM PARA IMÁGENES-->
    {{ HTML::script('lib/fancybox/jquery.fancybox.js?v=2.1.5'); }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5'); }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7'); }}
    {{ HTML::script('lib/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6'); }}
    <script>
        $('.zoom1').fancybox(  {
            openEffect : 'elastic',
            openSpeed  : 150,

            closeEffect : 'elastic',
            closeSpeed  : 150,

            prevEffect : 'none',
            nextEffect : 'none',

            closeBtn  : true,

            helpers : {
                title : {
                    type : 'inside'
                },
                buttons : {}
            },

            afterLoad : function() {
                this.title = 'Imagen ' + (this.index + 1) + ' de ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                $("#alert").fadeOut("slow");
            },4000);
        });
    </script>
@endsection