@extends('layouts/bayerTransferencista')
@section('content')
@section('pageTitle', $titulo)
    <section>
    @include('report/partials/menuBayerTransferencista')
    <div class="cuerpo">
        <div class="cuerpo-content">
            <!--sección titulo y buscador-->
            <div class="row pt pb">
                <div class="col-sm-9">
                    <h4 class="report-title">{{$titulo}}</h4>
                </div>
                <div class="col-sm-3">
                    <img src="{{$logo}}" width="100px">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">

                    <div class="row">
                        <!--Filtros con combos-->

                                <!-- Fin Filtros con combos-->
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="rubro">&emsp;</label>
                                {{Form::select('campaigne', $campaignes, '0', ['id'=>'campaigne','class' => 'form-control', 'onchange' => 'newCampaigne(this)'])}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt pb">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    @if(count($excels)>0)
                        @foreach($excels as $index=>$excel)
                            <div><h3 class="panel-title"><span class="badge">{{$index + 1}} </span>
                                    <a id="download-{{$index + 1}}" class="fileDownloadSimpleRichExperience" href="{{$excel['url']}}" target="_blank">{{$excel['nombre']}}</a>
                                </h3>
                            </div>
                        @endforeach
                    @else
                        <div class="alert-info">No Hay aún excels configurados</div>
                    @endif

                </div>
                <div class="col-sm-2"></div>
            </div>


        </div>
    </div>
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> </h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-1">
                                {{ HTML::image('img/loader2-white.gif', "System Auditor", array('class' => 'img-loader')) }}
                                {{ HTML::image('img/warning.png', "System Auditor", array('class' => 'img-warning pt')) }}
                                {{ HTML::image('img/error.png', "System Auditor", array('class' => 'img-error pt')) }}
                            </div>
                            <div class="col-md-11 modal-message pt mb">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="sr-only">100% Complete</span>
                            </div>
                        </div>

                        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </section>

@stop

@section('report')
    {{ HTML::script('lib/jquery.fileDownload.js') }}
    <!-- Libreria AMCHART -->


        {{ HTML::script('lib/amcharts/amcharts.js') }}
        {{ HTML::script('lib/amcharts/serial.js') }}
        {{ HTML::script('lib/amcharts/pie.js') }}
    <!-- Export plugin includes and styles -->
    {{ HTML::script('lib/amcharts/plugins/export/export.js') }}
    {{ HTML::script('lib/amcharts/plugins/export/export.config.default.js') }}

        {{ HTML::script('js/graficos/Bayer-chart-ventas.js') }}
        {{ HTML::script('js/ajaxJsonFunction.js') }}

        <!-- // Libreria AMCHART creaGraficoColumnas(chartData2,"char3");	-->
<script>
    var url_base =  "{{ URL::to('/') }}" ;
    // Grafico Abierto Cerrado

</script>
    <script>
        function newCampaigne(valor){

            if(valor.value != 0){
                var fullname = valor.options[valor.selectedIndex].text;
                var url= "{{ route('getExcelsTransf') }}" + "/" + valor.value;
                var win = window.open(url, '_blank');
                win.focus();
            }
        }
    </script>
    <script type="text/javascript">
        $(function () {
            $("a[id^='download-']").click(function () {
                $.fileDownload($(this).prop('href'), {
                    prepareCallback: function (url) {
                        modalDowload("Descargando excel", "Espere un momento está descargando el archivo",1);
                    },
                    successCallback: function (url) {
                        $('#myModal').hide();
                    },
                    failCallback: function (responseHtml, url) {
                        modalDowload("Información","No se puede descargar el archivo, servidor ocupado",2);
                    }
                });
                return false; //this is critical to stop the click event which will trigger a normal file download!
            });

            function modalDowload(title, message,icon) {

                $('.modal-title').html("<b >" + title + "<b >");
                $('.modal-message').html("<p ><b >" + message + "<b ></p>");

                $('.img-loader').hide();
                $('.img-warning').hide();
                $('.img-error').hide();

                if(icon==1){
                    $('.img-loader').show();
                    $('.close').hide();
                    $('.btn-close').hide();

                }
                if(icon==2){
                    $('.img-warning').show();
                    $('.close').show();
                    $('.btn-close').show();
                    $('.progress').hide();
                }
                if(icon==3){
                    $('.img-error').show();
                    $('.close').show();
                    $('.btn-close').show();
                    $('.progress').hide();
                }

                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).show();
            }

        });
    </script>
@endsection