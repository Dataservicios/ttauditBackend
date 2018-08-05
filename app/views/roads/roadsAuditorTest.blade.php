@extends('layouts/adminLayout')

@section('content')
    <section>
        @include('roads/partials/menuLeft')

        <div class="cuerpo">
            <div class="cuerpo-content">
                <h4>Listado de Rutas Programadas</h4>
                <!--Lista de usuario-->

                <!-- FIn de  Alerta para filtros -->
                <!--Filtros con combos-->
                {{Form::open(['route' => 'roadMapTest', 'method' => 'POST', 'role' => 'form','id'=>'roads-form','target'=>'_blank'])}}
                <div class="row">

                    <div class="col-sm-3" >
                        <div class="form-group">
                            <label for="select-users">Auditor</label>

{{--                            {{Form::select('user_id', array('0' => 'Seleccionar'), '0', ['id'=>'user_id','class' => 'form-control','style'=>'display:none']);}}--}}
{{--                            {{Form::select('user_id', array('0' => 'Seleccionar'), '0', ['id'=>'user_id','class' => 'form-control']);}}--}}
{{--                            {{Form::select('user_id', $auditors , '0', ['id'=>'user_id','class' => 'form-control']);}}--}}

                            <select id="select-users" class="form-control" name="user_id" >
                                <option value="0" >--- Seleccione un Auditor ---</option>
                                @foreach ($auditors as $auditor)
                                        <option value="{{$auditor->id}}">{{$auditor->fullname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="select-city">Ciudad</label>

                            <select id="select-city" class="form-control"  name="city">
                                <option value="0" >--- Seleccione una ciudad ---</option>
                                @foreach ($departaments as $departament)

                                    <option value="{{$departament->ubigeo}}">{{$departament->ubigeo}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="rubro">&emsp;</label>
                            <button class="btn btn-default" type="submit">Crear Ruta</button>
                        </div>

                    </div>

                </div>


                {{ Form::close() }}

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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop
@section('scripts_ajax')
<script type="application/javascript">
        $('#alertaFiltro').on('closed.bs.alert', function () {
            $('.alertaFiltro').hide("slow");
        })


//        $(document).ready(function() {
//            $("#select-users").change(function () {
//               // alert($( this ).val() + $( "select option:selected" ).text() );
//
//            }).change();
//        });


        $( "#roads-form" ).submit(function( event ) {
            //alert( "Handler for .submit() called." );

            if( $("#select-users").val() == 0 ) {
                //alert( "Handler for .submit() called." );
                event.preventDefault();
                $('.modal-title').text("Auditor");
                $('.modal-body').html("<p >Debe seleccionar un auditor</p>");
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).show() ;
                return;
            }

            if( $("#select-city").val() == 0 ) {
                event.preventDefault();
                $('.modal-title').text("Ciudad");
                $('.modal-body').html("<p >Debe seleccionar una ciudad</p>");
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                }).show() ;
                return;
            }

           //$( "#roads-form" ).submit();
            //return ;
        });


    </script>
@endsection
