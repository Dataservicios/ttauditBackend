@extends('layouts/adminLayout')
@section('scripts_angular')

@stop
@section('content')
    <section>
        @include('audits/partials/menuLeftAudit')
        <div class="cuerpo"  ng-app="MyStoresN">
            <div class="cuerpo-content" ng-controller="SearchCtrl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="report-marco ">
                            <div class="contenedor-report">
                                <h4>Auditoria {{$detailAudit->fullname}}</h4>
                                <div class="btn-group" role="group" aria-label="...">
                                    <div   class="btn btn-default btn-si">Cliente:</div>
                                    <div   class="btn btn-default btn-valor">{{$customer->fullname}}</div>
                                </div>
                                <div class="btn-group" role="group" aria-label="...">
                                    <div   class="btn btn-default btn-si">Campaña:</div>
                                    <div   class="btn btn-default btn-valor">{{$campaigne->fullname}}</div>
                                </div>
                                <div class="btn-group" role="group" aria-label="...">
                                    <div   class="btn btn-default btn-si">PDV totales:</div>
                                    <div   class="btn btn-default btn-valor">{{$QStoresForCompany}}</div>
                                </div>
                                <div class="btn-group" role="group" aria-label="...">
                                    <div   class="btn btn-default btn-si">PDV cerrados:</div>
                                    <div   class="btn btn-default btn-valor">{{$QAuditClose}}</div>
                                </div>
                                <div class="btn-group" role="group" aria-label="...">
                                    @if(($audit_id >=7) and ($audit_id<=11))
                                        <div   class="btn btn-default btn-no">PDV sin Auditar</div>
                                        <div   class="btn btn-default btn-valor">{{$regInsertAudit}}</div>
                                    @else
                                        <div   class="btn btn-default btn-si">PDV auditados:</div>
                                        <div   class="btn btn-default btn-valor">{{$regInsertAudit}}</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        {{ Form::open(['route' => 'mediaDetailPhotofilterVisits', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'pollPhoto' , 'validate']) }}

                        <div class="report-marco ">
                            <div class="contenedor-report">
                                {{ Form::hidden('company_id', $campaigne->id, ['id' => 'company_id']) }}
                                {{ Form::hidden('audit_id', $detailAudit->id) }}
                                {{ Form::hidden('tipo', "0") }}
                                {{ Form::hidden('id', "0") }}
                                {{ Form::hidden('cliente', $customer->fullname) }}

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        {{ Form::label('store_id', 'PDV:',['class' => 'col-sm-4 control-label']) }}
                                    </div>

                                    <div class="col-sm-8">
                                        {{ Form::text('store_id', ' ', ['class' => 'form-control','placeholder'=>'store_id|Visit_id']) }}
                                        <blockquote>
                                            <small>DIGITAR PARA VISITAS: store_id|Visit_id</small>
                                          </blockquote>
                                        {{ $errors->first('store_id', '<div class="alert alert-danger" role="alert">:message</div>') }}
                                    </div>
                                    <div class="col-sm-2 center-block" >
                                        <div class="form-group" id="buttonDetalle" ng-show="menuState.show">
                                            <label for="rubro">&emsp;</label>
                                            <button class="btn btn-default" type="submit" id="guardar">Ver Detalle</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
