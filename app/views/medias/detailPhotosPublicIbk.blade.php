@extends('layouts/publicLayout')
@section('content')
<section>
    <div>
        <div class="cuerpo-content">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="report-marco ">
                        <div class="contenedor-report">
                            <div class="row pt pb">
                                <div class="col-sm-9">
                                    <h4 class="report-title">{{$titulo}}</h4>
                                </div>
                                <div class="col-sm-3">
                                    <img src="{{$logo}}" width="200px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="report-marco ">
                                        <div class="contenedor-report">
                                            <h4>Detalle PDV</h4>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div   class="btn btn-default btn-si">Id Tienda:</div>
                                                <div   class="btn btn-default btn-valor">{{$objStore->id}}</div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div   class="btn btn-default btn-si">Nombre PDV:</div>
                                                <div   class="btn btn-default btn-valor">{{$objStore->fullname}}</div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div   class="btn btn-default btn-si">Dirección:</div>
                                                <div   class="btn btn-default btn-valor">{{$objStore->address}}</div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div   class="btn btn-default btn-si">Ciudad:</div>
                                                <div   class="btn btn-default btn-valor">{{$objStore->region}}</div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <div   class="btn btn-default btn-si">Tipo:</div>
                                                <div   class="btn btn-default btn-valor">{{$objStore->client}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt pb">
                                <div class="col-sm-12 center-block">
                                    @if(count($photos)>0)
                                        <ul>
                                        @foreach($photos as $index => $foto)
                                            <li class="lista-image">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <a href="{{$url_image.$foto->archivo}}" class="zoom1 btn btn-default" data-fancybox-group="button"><img src="{{$url_image.$foto->archivo}}"  class="img-thumbnail"></a>
                                                    </div>
                                                </div>

                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
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


@endsection