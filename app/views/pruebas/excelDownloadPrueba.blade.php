@extends('layouts/adminLayout')
@section('content')
    {{-- ---------------------- COLOCAR ESTO EN TU ARCHIVO CSS PRINCIPAL  --}}
    <style>

        /*.img-error{*/
            /*display: none;*/
        /*}*/
        /*.img-loader{*/
            /*display: none;*/
        /*}*/
        /*.img-warning{*/
            /*display: none;*/
        /*}*/


    </style>
    <section>
        {{--@include('report/partials/menuPrincipalColgate')--}}
        <div class="cuerpo">
            <div class="cuerpo-content">
                <!--sección titulo y buscador-->
                <div class="row pt pb">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12 pb">
                                <div class="report-marco ">

                                    {{--<div class="row pl">--}}
                                        {{--<div class="col-md-12 ">--}}
                                            {{--<a id="dowloadfile" href="#">Download Here.</a>--}}

                                            {{--<span class="loader" style="display: none">donloading...</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    {{--<div class="row pl">--}}
                                        {{--<div class="col-md-12 ">--}}
                                            {{--<a id="dowloadfile2" href="#">Download Here 2.</a>--}}
                                            {{--<span class="loader2" style="display: none">donloading...</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}

                                    <div class="row pl">
                                        <div class="col-md-12 ">
                                            <a id="download-123" class="fileDownloadSimpleRichExperience" href="http://ttaudit.com/planCamiseta/189">Download Here 3.</a>
                                            <span class="loader3" style="display: none">donloading...</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </section>


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
                            <img class="img-loader" src="img/loader2-white.gif" alt="">
                            <img class="img-warning pt" src="img/warning.png" alt="">
                            <img class="img-error pt" src="img/error.png" alt="">
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
@stop

@section('report')
    {{ HTML::script('lib/jquery.fileDownload.js'); }}
    <script type="text/javascript">

            $('#dowloadfile').click(function (e) {
                e.preventDefault();

                $('.loader').show();
                $.ajax({
                    url:"{{ asset('/') }}" + 'excelito',
                    dataType: "json",
                    complete:function (res) {
                        console.log(res);

                        var json = jQuery.parseJSON(res.responseText);
                        var path = json.path;

                        console.log(path);

                        location.href = path;
                        $('.loader').hide();
                    }
                });
            })

            $('#dowloadfile2').click(function (e) {
                e.preventDefault();

                $('.loader2').show();
                $.ajax({
                    //url:"{{ asset('/') }}" + 'excelito',
                    url:'http://ttaudit.com/planCamiseta/189',
                    type : 'GET',

//                    url : 'downloadExcel',
                    beforeSend : function() {
//                        startPreloader();
                        $('.loader2').show();
                    },
                    complete: function(){
//                        stopPreloader();
                        $('.loader2').hide();
                    },
                    success : function(response){
                        console.log(response);
                        var blob = new Blob([response], { type: 'data:application/vnd.ms-excel' });
                        var downloadUrl = URL.createObjectURL(blob);
                        var a = document.createElement("a");
                        a.href = downloadUrl;
                        a.download = "downloadFile.xlsx";
                        document.body.appendChild(a);
                        a.click();
                    }
                });


//                $.ajax({
//                    url : 'http://ttaudit.com/planCamiseta/189',
////                    contentType: "application/vnd.ms-excel",
//                    beforeSend : function(xhr) {
//
//                        //Aquí podemos mostrar un loader
//                    },
//                    success : function(data, status, xhr) {
//
//                        //Ocultamos el loader
//
//                        //Si se han devuelto datos
//                        if (data != null && data != "FAIL") {
//                            var b64Data = data;
//                            var contentType = xhr.getResponseHeader("Content-Type"); //Obtenemos el tipo de los datos
//                            var filename = xhr.getResponseHeader("Content-disposition");//Obtenemos el nombre del fichero a desgargar
//
//
//                            if(filename === null){
//                                filename = "pruebita.xls"
//                            } else {
//                                filename = filename.substring(filename.lastIndexOf("=") + 1) || "download";
//                            }
//
//                            var sliceSize = 512;
//
//
//                            var byteCharacters = decodeURIComponent(escape(window.atob(b64Data)));
//                            var byteArrays = [];
//
//                            for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
//                                var slice = byteCharacters.slice(offset, offset + sliceSize);
//
//                                var byteNumbers = new Array(slice.length);
//                                for (var i = 0; i < slice.length; i++) {
//                                    byteNumbers[i] = slice.charCodeAt(i);
//                                }
//
//                                var byteArray = new Uint8Array(byteNumbers);
//
//                                byteArrays.push(byteArray);
//                            }
//                            //Tras el procesado anterior creamos un objeto blob
//                            var blob = new Blob(byteArrays, {
//                                type : contentType
//                            });
//
//                            // IE 10+
//                            if (navigator.msSaveBlob) {
//                                navigator.msSaveBlob(blob, filename);
//                            } else {
//                                //Descargamos el fichero obtenido en la petición ajax
//                                var url = URL.createObjectURL(blob);
//                                var link = document.createElement('a');
//                                link.href = url;
//                                link.download = filename;
//                                document.body.appendChild(link);
//                                link.click();
//                                document.body.removeChild(link);
//                            }
//
//                        }
//                    },
//                    complete : function(xhr, status) {
//                        if (xhr.readyState == 4) {
//                            if (xhr.status == 200) {
//                                //Ocultamos el loader
//
//                                var contentLength = xhr.getResponseHeader("Content-Length");
//
//                                if (contentLength && contentLength == 0)
//                                //Si la descarga está vacía mostramos una alerta
//                                    alert("No se ha podido descargar el archivo");
//
//                            }
//                        }
//
//                    }
//                });
            })

    </script>


    <script type="text/javascript">

        $(function () {


            $("a[id^='download-']").click(function () {
//            $.fileDownload($(this).attr('href'), {
//                preparingMessageHtml: "The file download will begin shortly, please wait...",
//                failMessageHtml: "There was a problem generating your report, please try again."
//            });
//            return false; //this is critical to stop the click event which will trigger a normal file download!


//            $.fileDownload($(this).prop('href'))
//                .done(function () { alert('File download a success!'); })
//                .fail(function () {
//                    alert('File download failed!');
//                });
//
//            return false; //this is critical to stop the click event which will trigger a normal file download


                $.fileDownload($(this).prop('href'), {
                    prepareCallback: function (url) {
                        modalDowload("Descargando excel", "Espere un momento está descargando el archivo",1);
                    },
                    successCallback: function (url) {

                        //$preparingFileModal.dialog('close');
                        $('#myModal').hide();
                        //alert('ok');
                    },
                    failCallback: function (responseHtml, url) {

//                    $preparingFileModal.dialog('close');
//                    $("#error-modal").dialog({ modal: true });
                        modalDowload("Información","No se puede descargar el archivo, servidor ocupado",2);
                    }
                });
                return false; //this is critical to stop the click event which will trigger a normal file download!
            });




//            modalDowload("Descargando excel","Espere un momento está descargando el archivo",2);


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