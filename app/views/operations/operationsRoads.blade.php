@extends('layouts/publicLayout')

@section('content')
<section>
    <div class="cuerpo" ng-app="MyStores">
        <div class="cuerpo-content" ng-controller="SearchCtrl">
            <div class="row">
                <div class="col-sm-8">
                    <h4>Operaciones Diversas:
                        @if($modulo=='listarRoaddetails')
                            Listar Rutas de un Company y store
                        @endif
                    </h4>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>
    <div class="cuerpo">
        <div class="cuerpo-content">
            @if($modulo=='listarRoaddetails')
                <table class="table table-hover">
                    <thead>
                    <th>#</th>
                    <th>company</th>
                    <th>store</th>
                    <th>audit</th>
                    <th>road_id</th>
                    <th>Date</th>
                    </thead>
                    <tbody>
                    @foreach($objRoadDetails as $c => $objRoadDetail)
                        <tr>
                            <th scope="row">
                                {{$c+1}}
                            </th>
                            <td>
                                {{$objRoadDetail->company_id}}
                            </td>
                            <td>
                                {{$objRoadDetail->store_id}}
                            </td>
                            <td>
                                {{$objRoadDetail->audit}}
                            </td>
                            <td>
                                {{$objRoadDetail->road_id}}
                            </td>
                            <td>
                                {{$objRoadDetail->created_at}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

      </div>
    </div>
</section>
@stop