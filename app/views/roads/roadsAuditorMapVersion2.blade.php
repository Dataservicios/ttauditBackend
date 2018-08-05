@extends('layouts/adminLayout')
<link rel="stylesheet" href="{{ asset('css/mapa-styles.css') }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    .site-skintools {
        top: 100px;
    }

    .site-skintools {
        /*position: fixed;*/
        position: absolute;
        top: 100px;
        right: 0px;
        z-index: 2;
        width: 380px;
        color: #76838f;
        -webkit-transition: all .3s;
        -o-transition: all .3s;
        transition: all .3s;
    }

    .site-skintools .site-skintools-toggle {
        position: absolute;
        top: 0;
        left: -34px;
        padding: 10px 8px;
        font-size: 18px;
        cursor: pointer;
        background-color: #fff;
        border-color: rgba(0,0,0,.09);
        border-style: solid;
        border-width: 1px 0 1px 1px;
        border-radius: 3px 0 0 3px;
    }

    .site-skintools .site-skintools-content {
        height: 100%;
        min-height: 100px;
        padding: 5px 20px 20px;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.08);
        border-radius: 0 3px 3px;
    }

    .site-skintools-content h1 {
       font-size: 1em;
    }
    .site-skintools-content h1 {
        font-size: 1em;
    }
    .site-skintools-content #tiendas p {
        font-size: 0.7em;
        margin-bottom: 4px;
        border-bottom: dashed 1px #464646;
    }
    .site-skintools-content  p {
        font-size: 0.7em;
        margin-bottom: 4px;

    }

    #puntosEmpresa{
        background-color: #f8f8f8;
        padding: 2px 8px;
        font-size: 12px;
        margin-bottom: 10px;
    }

    #puntosEmpresa img{

        height: 30px;
    }


    #guardar{
        display: none;
    }
</style>

@section('content')
    <div id="map_canvas">
        <!-- css3 preLoading-->
        <div class="mapPerloading"> <span>Cargando</span>
            <span class="l-1"></span>
            <span class="l-2"></span>
            <span  class="l-3"></span>
            <span class="l-4"></span>
            <span class="l-5"></span>
            <span class="l-6"></span>
        </div>
    </div>

    <!-- END MAPA CANVAS -->
    <div class="site-skintools">
        <div class="site-skintools-inner">
            <div class="site-skintools-toggle">
                <i class="icon glyphicon glyphicon-cog"></i>
            </div>
            <div class="site-skintools-content">
                <div class="nav-tabs-horizontal">
                    <ul role="tablist" class="nav nav-tabs nav-tabs-line">
                        <li role="presentation" class="nav-item">
                            <a class="nav-link active" role="tab" aria-controls="skintoolsSidebar" href="#skintoolsSidebar" data-toggle="tab" aria-expanded="true">PDVs</a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a class="nav-link" role="tab" href="#skintoolsUser" data-toggle="tab" aria-expanded="false">Auditor</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="skintoolsSidebar" class="tab-pane active">

                            <div>
                                <h1 id="total-pdv">Total PDVS </h1>
                            </div>
                            <div id="puntosEmpresa">
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" value="">--}}
                                        {{--Option--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            </div>
                            <div id="tiendas">

                            </div>

                            <div>
                                <p>Selecionados: <span id="pdvSelected" class="label label-danger">0</span></p>
                            </div>

                            <button id="guardar" class="btn btn-block btn-primary margin-top-20" id="skintoolsReset" type="button">GUARDAR RUTA</button>
                        </div>
                        <div role="tabpanel" id="skintoolsUser" class="tab-pane">
                            <h5 class="site-skintools-title">ID: {{ $user[0]->id }} </h5>
                            <h5 class="site-skintools-title">Nombre: {{ $user[0]->fullname }} </h5>
                            <h5 class="site-skintools-title">Email: {{ $user[0]->email }} </h5>
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
                    <h4 class="modal-title">Guardar Ruta </h4>
                </div>
                <div class="modal-body">
                    <div class="row " >


                        <div class="col-md-12 pb">
                            <div class="form-group">
                                <label for="input1" class="col-sm-6 control-label">Ingrese Nombre de la Ruta</label>
                                <div class="col-sm-6">
                                    <input  class="form-control" id="name_ruta" placeholder="Nombre de Ruta">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pb">
                            <div class="form-group pb">
                                <label for="input2" class="col-sm-6 control-label">Fecha ejecución</label>
                                <div class="col-sm-6">
                                    <input  class="form-control" id="datepicker" placeholder="Fecha ejecución">
                                </div>
                            </div>
                        </div>
                            <div class="form-group pb">
                                <p id="mensaje" style="color: red ; font-weight: bold"></p>
                            </div>
                            {{--<input type="text" id="name_ruta" ><br>--}}
                            {{--<p>Fecha ejecución: <input type="text" id="datepicker"></p>--}}



                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" id="guarda_ruta" class="btn btn-default">GUARDAR RUTA</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop

@section('scripts_ajax')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7tL9pwWTxpywD6zMUDw32yaml7lr9oi4"></script>

{{--<script type="text/javascript" src="lib/mapa/infobox.js"></script>--}}
{{ HTML::script('lib/mapa/infobox.js'); }}

<script type="application/javascript">

$(document).ready(function() {

    var _map;
    var mark_points;
    var _markers=[];
    var _markersCompany=[];
    var _campaign=[];
    var _company=[];
    var _infoBox;
    var _visits=[];
    function init () {
        setupMapa(jQuery('#map_canvas')[0]);
    }
    function setupMapa(div){
        url = "{{ asset('/') }}" + "getPointStoresForCompanyDepartamentVisits";
        $.post(url ,{departament:'{{ $city['city'] }}'}, function(json){
            //if (item.latitud != 0 && item.longitud != 0){
            //console.log(json.length);
            if(json.length==0){
                _map= new google.maps.Map( div, {
                        scrollwheel: true,
                        zoom: 14,
                        center: new google.maps.LatLng('-12.046612','-77.042096'),
                        disableDefaultUI: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                );
                $('#guardar').css({'display':'none'});

            } else {
                _map= new google.maps.Map( div, {
                        scrollwheel: true,
                        zoom: 14,
                        center: new google.maps.LatLng(json[0].latitud, json[0].longitud),
                        disableDefaultUI: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                );

            }


           populateMap(json);
        });

    }
    //----------------------- ---
    // Rellena el mapa de burbujitas con los datos del json
    function populateMap(data){
        var url_base =  "{{ URL::to('/') }}" ;
        var total_puntos = 0;
        var cont=0;
        $('#total-pdv').append(data.length);
        $.each(data, function(i, item){
            valor = item.latitud + item.longitud ;
            //console.log(item);
            total_puntos ++;

            mark_points =item.mark_points;
            $.each(mark_points, function(j, item1){
                var icono = url_base+"/rutas-auditor/img/"+item1.mark_point;
                var marker = new google.maps.Marker({
                    id 		:cont,
                    clickable 	:true,
                    position  	:new google.maps.LatLng(item.latitud, item.longitud),
                    animation 	:google.maps.Animation.DROP,
                    icon      	:icono,
                    origin 		:(18, 38),   // Desfase del png de la burbuja con respecto al punto
                    map      	:_map
                });
                // Escucho los eventos de raton sobre las burbujas
                //if(item.status=="true") {
                google.maps.event.addListener(marker, 'click', function() {
                    openInfoBox(marker, item, item1.mark_point);
                });
                _markersCompany[cont] = [marker,item.company_id,item.id,item.visits,item1.visit_id];

                _markers[cont] = marker;cont ++;
            });
            _company.push(item.company_id) ;
           // _campaign[i] = [item.company_id,item.customer,item.customer_id,item.customer,item.estudio,item.estudio_id,item.marker_point_web];
        });

        /**
         * Removiendo duplicado
         *
         **/
        function removeDuplicate(list) {
            var result = [];
            $.each(list, function(i, e) {
                if ($.inArray(e, result) == -1) result.push(e);
            });
            return result;
        }

        _company = removeDuplicate(_company);

        // Obtiene un array solo de las campañas
        $.each(_company, function(i, item){
            var comp = item;
            var contador = 0;
            $.each(data, function(x, item2){
                if(comp == item2.company_id){
                    contador ++ ;
                    mark_points =item.mark_points;
                    _campaign[i] = [item2.company_id,
                                    item2.customer,
                                    item2.customer_id,
                                    item2.estudio,
                                    item2.estudio_id,
                                    item2.marker_point_web,
                                    item2.campaigne,
                                    contador,
                                    item2.num_max_visit];

                }
            });
        });

        $.each(_campaign, function(i, item){
            //_campaign[i] = [item2.company_id,item2.customer,item2.customer_id,item2.customer,item2.estudio,item2.estudio_id,item2.marker_point_web];
            $('#puntosEmpresa').append('<div class="checkbox"><label><input class="customer_id" type="checkbox"  checked="checked"  value="' + item[0] + '"><img src="' + item[5] + '"  > ' + item[6]  +' (' + item[7] + ')</label> <span id="'+ item[0] +'" class="label label-danger">0</span></div>');
            if (item[8]>0)
            {
                $('#puntosEmpresa').append('<p style="padding-left: 5px;">Visits:<br>');
                for (var i = 1; i <= 3; i++) {
                    $('#puntosEmpresa').append('<div class="checkbox"><label><input companyId="' + item[0] + '" class="visit_id" type="checkbox"  checked="checked"  value="' + i + '">' + 'Visita '+i +  '</label> </div>');
                }
                $('#puntosEmpresa').append('</p>');
            }

        });

        // Abre la ventana de info cuando se hace click sobre una burbuja
        function openInfoBox(marker, item,icono) {
            _map.panTo(marker.position);
            var myOptions = {
                // content 			:createInfoboxHtml(item.cadenaRuc,item.tipo,item.codclient, item.fullname, item.departamento, item.address, item.referencia, item.district ,item.id, item.company_id)
                content 			:createInfoboxHtml(item.cadenaRuc,item.tipo,item.codclient, item.fullname, item.departamento, item.address, item.referencia, item.district ,item.id, item.company_id,item.campaigne,item.visits)
                ,alignBottom 			:true
                ,disableAutoPan 		:false
                ,maxWidth 			:0
                ,pixelOffset 			:new google.maps.Size(-114, -55) // Desfase del cartel con respecto a la burbuja
                ,zIndex 			:null
                ,closeBoxURL 			:""
                ,infoBoxClearance 		:new google.maps.Size(0, 60) // margen superior del cartel con el borde superior del mapa
                ,isHidden 			:false
                ,pane 				:"floatPane"
                ,enableEventPropagation 	:false
                ,zoom					:15
            };

            // Si ya hay un infoBox abierto lo cierro
            if(_infoBox){
                _infoBox.close();
            }
            _infoBox = new InfoBox(myOptions);
            // Escucho el evento para poder cerrar la ventana de info
            google.maps.event.addListener(_infoBox, 'domready', function() {
                jQuery('.IFclose', '.infoBox').unbind('click', closeInfoBox);
                jQuery('.IFclose', '.infoBox').bind('click', closeInfoBox);
                $('#add').unbind('click', addPDV(marker,icono));
                $('#add').bind('click', addPDV(marker,icono));
                //marker.icon="img/delete.png";
                //$('.IFclose', '.infoBox').bind('click', closeInfoBox);
            });
            //console.log(item);
            _infoBox.open(_map, marker);
        }
        // Devuelve el HTML de la cartela de informacion de la burbuja
        //createInfoboxHtml(item.fullname, item.address, item.urbanization, item.district ,item.id)
        function createInfoboxHtml(cadenaRuc,tipo,codclient,fullname, departamento, address, referencia,district,id,company_id,campaigne,visits) {
            var boxText = document.createElement("div");
            var textCadena = "";
            if (codclient == ""){
                textCadena = tipo;
            }else{
                textCadena = codclient;
            }
            boxText.innerHTML = "<div class='IFcontainer'>"+
                "<a href='#' class='IFclose'></a>"+
                "<div id='IFtitleBox'>" + cadenaRuc + " - " + fullname + "</div>"+
                "<span class='codigo' >" + id + "</span>"+
                "<span class='company_id' style='visibility:hidden'>" + company_id + "</span>"+
                "<div class='contenido'>Campaña: "+ campaigne + "</div>"+
                "<div class='contenido'>Frecuencia: "+ visits + "</div>"+
                "<div class='contenido'>Codigo: "+ textCadena + "</div>"+
                "<div class='contenido'>Dirección: "+ address + "</div>"+
                "<div class='contenido'>Referencia: "+ referencia + "</div>"+
                "<div class='contenido'>Distrito: "+ district + "</div>"+
                "<div class='contenido'>Departamento: "+ departamento + "</div>"+
                "<div class='pt'><button id='add' button_company = '" + company_id + "'  type='submit' class='add btn btn-block btn-primary  btn-xs'>AGREGAR TIENDA</button></div>"+
                "<div class='IFcorner'></div>"+
                "</div>";
            return boxText;
        }

        // Cierra la ventana de info
        function closeInfoBox(e){
            e.preventDefault();
            _infoBox.close();
        }

        //Añadiendo PDV
        function addPDV(val,icono){
            return function(e) {
                // your code that does something with param
                e.preventDefault();
                contador = 0;
                //console.log( "codigo: " +$('.codigo').text());
                $(".cod").each(function( index ) {
                    //contador ++ ;
                    //console.log( index + ": " +   $(this).text());
                    codgigo1 = "";
                    codgigo2 = "" ;
                    codgigo1 = $(this).text();
                    codgigo2 = $(".codigo").text() ;
                    if (codgigo1 == codgigo2) {
                        //$( "span" ).text( "Stopped at div index #" + index );
                        contador ++;
                        return false;
                    } else {
                        //$('#tiendas ').append("<p>"+ $('#IFtitleBox').text() +"(<span>" + $('.codigo').text() + "</span>)</p>")
                        contador=0;
                    }
                });

                if(contador > 0){
                    return;
                } else {
                    $('#tiendas ').append(
                        "<p id='"
                        + $('.codigo').text() +"' company-id='" + $('.company_id').text() + "'>"
                        + " <img src='" + icono +"' height='20'/> "
                        + $('#IFtitleBox').text()
                        +"(<span class='cod'>" + $('.codigo').text() + "</span>)"
                        + "<a href='#'  id=code" + $('.codigo').text() + " data-id=" + $('.codigo').text()+ " data-company-id="+ $('.company_id').text() + "  data-toggle='tooltip' data-placement='top' title='Eliminar Tienda'><img src='{{ asset('/') }}rutas-auditor/img/delete.png' alt='Eliminar Tienda'  /></a>"
                        + "</p>");
                }
                val.setVisible(false);
                links = $("#code" + $('.codigo').text());
                links.on("click",  function(e) {
                    e.preventDefault();
                    //console.log($(this).attr("data-id"));
                    selected = $('#' + $(this).attr("data-id")).remove();
                    var company_id_selected =  $(this).attr("data-company-id");
                    // val.setIcon("img/burbuja-map-active.png");
                    val.setVisible(true);
                    elemetSelected=0;
                    $(".cod").each(function( index ) {
                        elemetSelected ++ ;
                    });
                    //console.log(selected_company_id);
                    $('#pdvSelected').html(elemetSelected);
                    showHiendeButtonSave(elemetSelected);
                    countElementForCampagn(company_id_selected);
                });
                elemetSelected=0;
                $(".cod").each(function( index ) {
                    elemetSelected ++ ;
                });
                showHiendeButtonSave(elemetSelected);
                //console.log(elemetSelected);
                $('#pdvSelected').html(elemetSelected);
                _infoBox.close();

                //console.log($(this).attr("button_company"));

                var company_id_selected ;
                company_id_selected = $(this).attr("button_company");

                countElementForCampagn(company_id_selected);

            };
        }

        function countElementForCampagn(company_id_selected){
            var counter_company_selected = 0;
            $('#tiendas p').each(function(index, element ) {
                company_id = $(this).attr("company-id");
                //data_store[index]= element.id + "|" + company_id ;
                if(company_id_selected == company_id) {
                    counter_company_selected ++;
                }

            });
           // console.log(counter_company_selected);
            $('#'+ company_id_selected).html(counter_company_selected);
        }


        $(".customer_id").click(function(){
            id=$(this).val();
           // var total_store = $('#tiendas p').length;
            if($(this).is(':checked')){
//                    marker.setVisible(true);
//                    marker_open.setVisible(true);
//                    marker_close.setVisible(true);
                //alert($(this).val());
                $.each(_markersCompany, function(i,item){
                    //item[0].setVisible(true);
                    if(id == item[1] ){
                       // console.log($('#tiendas p').length);
//                        $('#tiendas p').each(function(index, element ) {
//
//                            if(element.id == item[2]){
//                                item[0].setVisible(true);
//                                setTimeout(function(){ item[0].setAnimation(null); }, 1500);
                               // console.log(item[0]);
//                            } else {
//                                item[0].setVisible(false);
//                                setTimeout(function(){ item[0].setAnimation(null); }, 1500);
//                                console.log(item[0]);
//                            }
//                        });


                        item[0].setVisible(true);
                       // setTimeout(function(){ item[0].setAnimation(null); }, 1500);

                        $('#tiendas p').each(function(index, element ) {
                            if(element.id == item[2]){
                                item[0].setVisible(false);
//                              setTimeout(function(){ item[0].setAnimation(null); }, 1500);

                            }
//                            else {
//                                item[0].setVisible(true);
//                            }
                        });


                    }
                });
            }else{

                $.each(_markersCompany, function(i,item){
                    if(id == item[1] ){

                            item[0].setVisible(false);
//                            $('#tiendas p').each(function(index, element ) {
//                                if(element.id == item[2]){
//                                    find_store=true;
//                                } else {
//                                    find_store=false;
//                                }
//                            });
                    }
                });
            }
        });

        $(".visit_id").click(function(){
            visit_id=$(this).val();
            company_id = $(this).attr("companyId");
            // var total_store = $('#tiendas p').length;
            if($(this).is(':checked')){
                $.each(_markersCompany, function(i,item){
                    if((visit_id == item[4]) && (company_id == item[1]) ){
                        item[0].setVisible(true);
                        $('#tiendas p').each(function(index, element ) {
                            if(element.id == item[2]){
                                item[0].setVisible(false);
                            }
                        });
                    }
                });
            }else{

                $.each(_markersCompany, function(i,item){
                    if((visit_id == item[4]) && (company_id == item[1]) ){
                        item[0].setVisible(false);
                    }
                });
            }
        });

    }
    init();

    /**
     * Muestra el boton de guardar cuando 1 elemento selecionado
     * @param elemetSelected
     **/
    function showHiendeButtonSave(elemetSelected){
        if(elemetSelected>0){
            $('#guardar').show();
        } else{
            $('#guardar').hide();
        }
    }



    $( function() {
        $( "#datepicker" ).datepicker(
            { disabled: false,
                dateFormat: "yy-mm-dd",
                setDate: "10/12/2012"}
        );
    } );

    // -------------------------------PANEL--------------------------------
    //select all the a tag with name equal to modal
    $('#guardar').click(function(e) {
        e.preventDefault();
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: false
        }).show() ;

    });

    ///-------------------------------- Save Road-----------------------------------
    $('#guarda_ruta').click(function(e) {
        e.preventDefault();
        var company_id ;
        var nombre = $('#name_ruta').val();
        var date_ = $('#datepicker').val();
        var data_store = [];
        //var str_datos="";
        $('#tiendas p').each(function(index, element ) {
            company_id = $(this).attr("company-id");
            //console.log($(this).attr("company-id"));
            data_store[index]= element.id + "|" + company_id ;
            //str_datos = str_datos + element.id + "|" + company_id  ;
            //console.log(str_datos);
        });

        if(data_store.length < 1  ) {
            alert("Debe seleccionar al menos una ruta");
            return;
        }  else if(nombre.trim() == "" || date_.trim() == "" ){
            alert("Debe ingresar un nombre de ruta y una fecha");
            return;
        } else {

            $("#guarda_ruta").prop( "disabled", true );
            $("#mensaje").text("Espere se está guardando la ruta ...");
            // console.log(date);
            var response = $.post("{{ asset('/') }}" + 'ajaxInsertRoutingVisits',  { nombreRuta : nombre, user_id : {{ $user[0]->id }} , id_store : data_store , date: date_ },
                function(data){
                    //if (item.latitud != 0 && item.longitud != 0){
                    //console.log(data);
                    if(data.success==1 ){
                        location.reload();
                    } else if(data.success==0) {
                        alert( "No se pudo guardar los datos inténtelo nuevamente" );
                        location.reload();
                    }

                } );

            response.fail(function() {
                alert( "Error no pudo recibir respuesta del servidor" );
                location.reload();
            })
        }


    });

//  ------  Panel .site-skintools ----------------
    var visibility = true ;
    $( ".site-skintools-toggle" ).on( "click", function() {
        var pos;
        if(visibility == true){
             pos =  $('.site-skintools').width()  //- $('.site-skintools-content').offset().top;
            visibility = false;
        } else {
            pos=0;
            visibility = true;
        }

        // console.log(pos);
        $('.site-skintools').animate({
            right: - pos + 'px',
        }, 100 );


    });
});




</script>

@endsection
