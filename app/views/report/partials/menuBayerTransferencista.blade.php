<div class="zona-menu-left">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluidxxxxxx">
            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="#">Brand</a>-->
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li @if ($menu=="resumen") class="active" @endif><a href="{{ route('transResume',$company_id) }}"> <span class="  icon-puntoventa   "></span>  Resumen Período</a>
                    </li>

                    <li @if ($menu=="detalle") class="active" @endif><a href="{{ route('detailPopEncontradoTransf',$company_id) }}"> <span class="   glyphicon glyphicon-list-alt "></span>  Detalle por Material</a></li>

                    {{--<li @if ($menu=="historicoPop") class="active" @endif><a href="{{ route('historyPop') }}"> <span class="  icon-auditoria  "></span>  Histórico Pop</a></li>
                    <li @if ($menu=="historicoFicticios") class="active" @endif><a href="{{ route('ficticioHistory') }}"> <span class="  icon-auditoria  "></span>  Histórico Exhibiciones Ganadas</a></li>--}}

                    <li @if ($menu=="excels") class="active" @endif><a href="{{ route('getExcelsTransf',$company_id) }}"> <span class="  icon-auditoria  "></span>  Reportes Excel</a></li>

                    <li @if ($menu=="rutas") class="active" @endif><a href="{{ route('getRoadsTransf',$company_id) }}"> <span class="  icon-auditoria  "></span>  Rutas Asignadas</a></li>

                </ul>
            </div>


        </div><!-- /.container-fluid -->
    </nav>
</div>