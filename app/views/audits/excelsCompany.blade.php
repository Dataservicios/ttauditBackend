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
                                                        <a id="download-{{$valores->id}}" class="fileDownloadSimpleRichExperience" href="{{$urlBase."/".$valores->url}}" >
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
                                                    <a  href="{{$urlBase."/".$valores->url}}" target="_blank">
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
