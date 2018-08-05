@extends('layouts/layout')

@section('content')
    <style>
        .logo-bayer{

            width: 100%;
        }
        .logo-bayer img {
            text-align: center;
            max-width: 22%;
            display: block;
            margin: auto;
        }
        .report-marco {

            background-color: #5eb6de;
            color: white;
            border: 1px solid #74afca;
        }

        .report-marco .bayer-study a {
            color: white;
        }
        .report-marco .bayer-study a:hover {

            color: #b7edff;
        }
        .bayer-study li{
            list-style:none;
        }

    </style>
<section>
    <div class="row pt pb">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="logo-bayer">
                        <img class="" src="http://ttaudit.com/media/images/bayer/logoBayer.jpg" alt="">
                    </div>

                </div>
            </div>
            
            <div class="row pt pb">
                <div class="col-sm-12">
                    <div class="report-marco pl pr">
                        <div class="bayer-study">
                            <h4> Seleccionar Estudio</h4>
                            <ul>
                                @foreach($studies as $study)
                                    @if($study->id==1)
                                        <li><a href="{{ route('reportBayer') }}" target="_blank"> <span class="glyphicon glyphicon-book" aria-hidden="true"></span> {{$study->fullname}}</a> </li>
                                    @endif
                                    @if($study->id==2)
                                        <li><a href="{{ route('mercaResume') }}" target="_blank"> <span class="glyphicon glyphicon-book" aria-hidden="true"></span> {{$study->fullname}}</a> </li>
                                    @endif
                                    @if($study->id==13)
                                        <li><a href="{{ route('transResume') }}" target="_blank"> <span class="glyphicon glyphicon-book" aria-hidden="true"></span> {{$study->fullname}}</a> </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="col-sm-4"></div>
    </div>

</section>
@stop
@section('report')
    {{ HTML::script('lib/amcharts/amcharts.js') }}
    {{ HTML::script('lib/amcharts/serial.js') }}
    {{ HTML::script('lib/amcharts/pie.js') }}

    <!-- Export plugin includes and styles -->
    {{ HTML::script('lib/amcharts/plugins/export/export.js') }}
    {{ HTML::script('lib/amcharts/plugins/export/export.config.default.js') }}

    {{ HTML::script('js/graficos/Bayer-chart.js') }}


@endsection