@extends('layouts/adminFull')
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">

            <div class="report-marco ">
                <div class="contenedor-report">
                    <!--Filtros con combos-->
                    {{ Form::hidden('user_id', $user_id, ['id'=>'user_id']) }}
                    {{ Form::hidden('company_id', $company_id, ['id'=>'company_id']) }}
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="form-group">
                                {{ Form::label('store_id', 'Ingresar Id del punto: ',['class' => 'control-label']) }}
                                {{ Form::text('store_id', ' ', ['id'=>'store_id','class' => 'form-control','placeholder' => 'Ingrese Id del punto']) }}
                            </div>
                        </div>

                        <div class="col-sm-3 text-center">
                            <div class="form-group">
                                <button class="btn btn-default" type="button" onclick="getResultsSearch()">Buscar</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="report-marco ">
                <div id="load"></div>
                <div class="contenedor-report" id="pdvs">

                </div>
            </div>

        </div>
    </div>
</section>
@stop
@section('report')
    <script>
        var url_base =  "{{ URL::to('/') }}" ;
        var url = url_base + "/searchOrdersResults" ;
        function getResultsSearch(){
            $("#pdvs").empty();
            var company_id = $('#company_id').val();
            var user_id = $('#user_id').val();
            var store_id = $('#store_id').val();
            var message = 'Problemas o el id del punto no existe en tus rutas';
            var divLoading = 'load';
            var params = JSON.parse('{"company_id":"' + company_id + '","user_id":"' + user_id + '","store_id":"' + store_id + '"}');
            //alert(city_select+" - "+poll_id_select);
            var loading= "<div class='" + divLoading +"'><img src='" + url_base +  "/img/loading.gif" + "' ></div>";

            $("#"+divLoading).html(loading);
            $.post(url , params,  function(data) {
                console.log (data.toString());

            })
                .done(function(data) {
                    // alert( "second success" );
                    console.log (data);

                    var html;
                    var datos = data.regs;
                    html = "<div class=\"panel-group\" id=\"accordion\" role=\"tablist\" aria-multiselectable=\"true\">";
                    $.each(datos, function(i, item){
                        var details = item.order_details;
                        html = html + "<div class=\"panel panel-default\">";
                        html = html + "<div class=\"panel-heading\" role=\"tab\" id=\"headingOne"+i+"\">";
                        html = html + "<h4 class=\"panel-title\">";
                        if (i == 0){
                            html = html + "<a role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" aria-expanded=\"false\" href=\"#collapseOne"+i+"\" aria-controls=\"collapseOne"+i+"\">";
                        }else{
                            html = html + "<a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" aria-expanded=\"false\" href=\"#collapseOne"+i+"\" aria-controls=\"collapseOne"+i+"\">";
                        }

                        html = html + "Order ID: " + item.id + " Distribuidor " + item.provider + "(" + item.provider_id + ")" + " Punto: " + item.punto + "(" + item.store_id + ")" + " Auditor: " + item.auditor;
                        html = html + "</a>";
                        html = html + "</h4>";
                        html = html + "</div>";
                        html = html + "<div id=\"collapseOne"+i+"\" class=\"panel-collapse collapse in  table-responsive\" role=\"tabpanel\" aria-labelledby=\"headingOne"+i+"\">";

                        html = html + "<table class=\"table table-bordered\"> <thead> <tr> <th>#</th> <th>Producto</th> <th>Cantidad</th> <th>Precio</th> <th>Monto</th> </tr> </thead> ";
                        $.each(details, function(j, item1){
                            html = html + "<tbody> <tr> <th scope=\"row\">1</th> <td>" + item1.product + "(" + item1.product_id + ")" + "</td> <td>" + item1.cantidad + "</td> <td>"+item1.precio+"</td> <td>"+item1.monto +"</td></tr></tbody>";
                        });
                        html = html + " </table>";

                        html = html + "</div>";
                        html = html + "</div>";
                    });
                    html = html + "</div>";
                    $('#pdvs').append(html);
                })
                .fail(function() {
                    // alert( "error" );
                    $("#"+divLoading).html("<div class='" + divLoading +"'>" + message + "</div>");

                })
                .always(function() {
                    // alert( "finished" );
                    $("."+divLoading + " > img ").hide();
                });
        }

    </script>
@endsection