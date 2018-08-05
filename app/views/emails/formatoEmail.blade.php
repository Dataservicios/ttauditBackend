<html lang="en">

<body>
@if($tipo=='BayerMercaderismo')
    <table>
        <tr><td valign="top">
                <table>
                    <tr>
                        <td>Titulo:</td>
                        <td>{{$titulo}}</td>
                    </tr>
                    <tr>
                        <td>Motivo:</td>
                        <td>{{$motivo}}</td>
                    </tr>
                    <tr>
                        <td>Nombre Farmacia:</td>
                        <td>{{$agente}}</td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td>{{$direccion}}</td>
                    </tr>
                    <tr>
                        <td>Distrito:</td>
                        <td>{{$distrito}}</td>
                    </tr>

                    @if($auditor<>'')
                        <tr>
                            <td>Auditor:</td>
                            <td>{{$auditor}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Fecha:</td>
                        <td>{{$fecha}}</td>
                    </tr>
                    <tr>
                        <td>Responder este email a:</td>
                        <td>ellerena@ttaudit.com </td>
                    </tr>
                </table>
            </td>
            <td>
                <?php $fotos = explode('|',$foto);
                if (count($fotos)>0){
                    foreach ($fotos as $foto1) {
                        echo "<img src='".$foto1."'>";
                    }
                }else{
                    echo "<img src='".$foto."'>";
                }
                ?>
            </td>
        </tr>
    </table>
@endif
@if($tipo=='LocalCerrado')
    <table>
        <tr><td valign="top">
                <table>

                    <tr>
                        <td>Titulo:</td>
                        <td>{{$titulo}}</td>
                    </tr>
                    <tr>
                        <td>Motivo:</td>
                        <td>{{$motivo}}</td>
                    </tr>
                    @if($cadena == '')
                        <tr>
                            <td>Agente:</td>
                            <td>{{$agente}}</td>
                        </tr>
                    @else
                        @if($cadena == 'alicorp')
                            <tr>
                                <td>Tienda:</td>
                                <td>{{$agente}}</td>
                            </tr>
                            <tr>
                                <td>Tipo Tienda:</td>
                                <td>{{$tipoLocal}}</td>
                            </tr>
                        @else
                            <tr>
                                <td>Farmacia Tipo:</td>
                                <td>{{$tipoLocal.' - '. $cadena}}</td>
                            </tr>
                            <tr>
                                <td>Nombre Farmacia:</td>
                                <td>{{$agente}}</td>
                            </tr>
                            @if($comentario<>'')
                                <tr>
                                    <td>Atendido por / comentario:</td>
                                    <td>{{$comentario}}</td>
                                </tr>
                            @endif
                        @endif

                    @endif
                    <tr>
                        <td>Dirección:</td>
                        <td>{{$direccion}}</td>
                    </tr>
                    <tr>
                        <td>Distrito:</td>
                        <td>{{$distrito}}</td>
                    </tr>
                    @if($auditor<>'')
                        <tr>
                            <td>Auditor:</td>
                            <td>{{$auditor}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Fecha:</td>
                        <td>{{$fecha}}</td>
                    </tr>
                    <tr>
                        <td>Responder este email a:</td>
                        <td>aguerra@ttaudit.com ó rpulido@ttaudit.com </td>
                    </tr>
                </table>
            </td>
            <td>
                <img src="{{$foto}}">
            </td>
        </tr>
    </table>

@endif

</body>
</html>