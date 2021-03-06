<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <style>
        @page {
            margin: 1cm 1cm;
            font-family: Helvetica, sans-serif;
        }
        .titulo{
            text-align:center;
            color:black;
        }

        body{
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            border: 1px solid black;
        } 
        th{
            border: 1px solid black;
        }
        table {
            table-layout: fixed; width: 180px;
            width: 100%;
        }
        .tit1{
            width:75%;
            
        }
        .tit22{
            width:40%;
        }
        .tit23{
            width:40%;
        }.tit34{
            width:20%;
        }
        .color-fondo{
            background-color: #E4E0FB;
        }
        .tit1color{
            color:#FF0000;
        }
        .colorLetra{
            color:black;
        }
        .div1{
            width:50%;
        }
        .div2{
            width:50%;
        }
        .divx3{
            width:33,3%;
        }
        .allado{
            float:left;
        }

        .letraT{
            font-size:80%;
        }
        .letraE{
            font-size:85%;
        }
        .letraC{
            font-size:70%;
        }
        .textIZQ{
            text-align: left;
        }
        .textDER{
            text-align: right;
        }
        .divI{
            border: 1px solid black;
            Height:97px;
            /* display: flex; */
            align-items: center;
            
        }
        .textM{
            line-height:10%;
            margin-left:25%;
        }
        .textM2{
            line-height: 400%;
            /* margin-left:26%; */
            /* //position: absolute; */
            text-align:center;
        }

        .tablanominacol1{
            width:5%;
        }
        .tablanominacol2{
            width:10%;
        }
        .tablanominacol3{
            width:60%;
        }
        .tablanominacol4{
            width:25%;
        }

        .tablanominaextcol1{
            width:5%;
        }
        .tablanominaextcol2{
            width:10%;
        }
        .tablanominaextcol3{
            width:45%;
        }
        .tablanominaextcol4{
            width:20%;
        }
        .tablanominaextcol5{
            width:10%;
        }
        .tablanominaextcol6{
            width:10%;
        }
        .margenSuperiorImagen{
            margin-top:3%;
            margin-left:43%;
        }
        .margenSuperiorImagenSN{
            margin-top:3%;
            margin-left:43%;
        }

        .qrcodes{
          /* margin-right:40px; */
          margin-top:1px;
          margin-left:8px;
          width:85px;
          
          }
    </style>
</head>
<body>
@php
        
@endphp
@foreach($certificado as $cert)
   
<img src="spa.png" width="150" height="40">
    <hr>
    <div  class="titulo">
        <label class="letraT">Rut: 76.393.817 - 4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }}</label>
    </div>
    <hr>
    <!-- tabla 1 -->
    <label class="letraE">Identificaci??n Empresa Verificada</label>
    <table>
        <thead>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Nombre o Raz??n Social Cliente</label> </th>
                <th class="color-fondo"><label class="colorLetra letraT">N?? Rut</label></th>
                <th class="color-fondo"><label class="colorLetra letraT">Tel??fono</label></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><label class="letraC">{{ $cert->estructura->empresa->nombre }}</label></th>
                <th><label class="letraC">{{ $cert->estructura->empresa->rut }} </label></th>
                <th><label class="letraC">{{ $cert->estructura->empresa->telefonos }}</label></th>
            </tr>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Direcci??n</label> </th>
                <th class="color-fondo " colspan="2"><label class="colorLetra letraT">N?? Contacto</label></th>
                <!-- <th class="color-fondo"><label class="colorLetra">Tel??fono</label></th> -->
            </tr>
            <tr>
                <th><label class="letraC">{{ $cert->estructura->empresa->direccion }}</label></th>
                <th colspan="2"><label class="letraC">{{ $cert->estructura->empresa->fonContacto }}</label></th>
                
            </tr>

        </tbody>
    </table>
    <!-- --tabla 2 -->
    <label class="letraE">Identificaci??n del Proyecto</label>
    <table>
            <thead>
                <tr>
                    <th class="color-fondo tit24"><label class="colorLetra letraT">N?? Contrato</label> </th>
                    <th class="color-fondo tit22"><label class="colorLetra letraT">Centro de Costo</label></th>
                    <th class="color-fondo tit23"><label class="colorLetra letraT">Divisi??n</label></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><label class="letraC">{{ $cert->estructura->contrato }}</label></th>
                    <th><label class="letraC">{{ $cert->estructura->proyecto->proyecto }}</label></th>
                    <th></th>
                </tr>
                <tr>
                    <th colspan="3" class="color-fondo"><label class="colorLetra letraT">Descripci??n del Servicio</label></th>
                </tr>
                <tr>
                    <th colspan="3">??
                    </th>
                </tr>
            
            </tbody>
        </table>
        <!-- tabla 3 -->
        <label class="letraE">Identificaci??n Empresa Mandante</label>
        <table>
            <thead>
                <tr>
                    <th class="tit1 color-fondo"><label class="colorLetra letraT">Raz??n Social Empresa Principal</label> </th>
                    <th class="color-fondo"><label class="colorLetra letraT">N?? Rut</label></th>
                    <th class="color-fondo"><label class="colorLetra letraT">Tel??fono</label></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><label class="letraC">{{ $cert->estructura->proyecto->empresa->nombre }}</label></th>
                    <th><label class="letraC">{{ $cert->estructura->proyecto->empresa->rut }}</label></th>
                    <th><label class="letraC">{{ $cert->estructura->proyecto->empresa->telefonos }}</label></th>
                </tr>
                <tr>
                    <th class="tit1 color-fondo"><label class="colorLetra letraT">Direcci??n</label> </th>
                    <th class="color-fondo " colspan="2"><label class="colorLetra letraT">N?? Contacto</label></th>
                    <!-- <th class="color-fondo"><label class="colorLetra">Tel??fono</label></th> -->
                </tr>
                <tr>
                    <th><label class="letraC">{{ $cert->estructura->proyecto->empresa->direccion }}</label></th>
                    <th colspan="2"><label class="letraC">{{ $cert->estructura->proyecto->empresa->telefonos }}</label></th>
                    
                </tr>

            </tbody>
        </table>
        <!-- tabla 4 -->
        <label class="letraE">Identificaci??n Empresa Contratista</label>
         <!-- tabla 5 -->
        
        <table>
            <thead>
                <tr>
                    <th class="tit1 color-fondo"><label class="colorLetra letraT">Nombre Empresa</label> </th>
                    <th class="color-fondo"><label class="colorLetra letraT">N?? Rut</label></th>
                    <th class="color-fondo"><label class="colorLetra letraT">Tel??fono</label></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th><label class="letraC">{{ $cert->estructura->contratistasubcontrato->nombre }}</label></th>
                    <th><label class="letraC">{{ $cert->estructura->contratistasubcontrato->rut }}</label></th>
                    <th><label class="letraC">{{ $cert->estructura->contratistasubcontrato->telefonos }}</label></th>
                </tr>
                <tr>
                    <th class="tit1 color-fondo"><label class="colorLetra letraT">Direcci??n</label> </th>
                    <th class="color-fondo " colspan="2"><label class="colorLetra letraT">N?? Contacto</label></th>
                    <!-- <th class="color-fondo"><label class="colorLetra">Tel??fono</label></th> -->
                </tr>
                <tr>
                    <th><label>{{ $cert->estructura->empresa->direccion }}</label></th>
                    <th colspan="2"><label class="letraC">{{ $cert->estructura->contratistasubcontrato->fonContacto }}</label></th>
                    
                </tr>

            </tbody>
        </table>
    <!-- --tabla 5 -->
     <!-- tabla 6 -->
     <div>
    <label class="letraE">Movimiento de Personal Mensual</label>
    </div>
    <div class="row">
        <div class="div1 allado">
            <table>
                <thead>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Mes Revisado</label> </th>
                        <th class=""><label class="letraC">@if($cert->mes==1) ENERO @elseif($cert->mes==2) FEBRERO @elseif($cert->mes==3) MARZO @elseif($cert->mes==4) ABRIL @elseif($cert->mes==5) MAYO @elseif($cert->mes==6) JUNIO @elseif($cert->mes==7) JULIO @elseif($cert->mes==8) AGOSTO @elseif($cert->mes==9) SEPTIEMBRE @elseif($cert->mes==10) OCTUBRE @elseif($cert->mes==11) NOVIEMBRE @elseif($cert->mes==12) DICIEMBRE  @endif</label></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Vigentes ??ltimo per??odo certificado</label></th>
                        <th><label class="letraC">{{ $cert->empleadosMesAnterior}}</label> </th>
                        
                    </tr>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Nuevos ingresos</label> </th>
                        <th class=""><label class="letraC">{{ $cert->empleadoNuevos}}</label></th>
                        
                    </tr>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Total Revisados</label></th>
                        <th><label class="letraC">{{ $cert->totalRevizados}}</label> </th>
                        
                    </tr>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Desvinculados</label> </th>
                        <th class=""><label class="letraC">{{ $cert->retirosFiniquitos}}</label></th>
                        
                    </tr>
                    <tr>
                        <th class="color-fondo textIZQ"><label class="colorLetra letraT">Dotaci??n Final del Periodo </label></th>
                        <th><label class="letraC">{{ $cert->dotacionFinal}}</label> </th>
                        
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="div2 allado">
            <table>
                <thead>
                    <tr>
                    <th class="">
                            <!-- //<img src="asset('img/sello.png')"> -->
                            <img src="selloOficial.png" width="85" height="85" >
                        </th>
                        <th class="">
                        @php
                        $codigoQR = QrCode::format('png')->size(200)->backgroundColor(233,229,255)->generate('texto');
                        @endphp
                            <!-- <img src='qrcode.svg' class="qrcodes"> -->
                            <img class="qrcodes" src="data:image/svg+xml;base64,{{ base64_encode($codigoQR) }}">
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <!-- --tabla 6 -->
    <!-- tabla 7 -->
    </br>
    </br>
    <label class="letraE">1.- Observaci??n parte Remuneracional</label>
    <table>
        <thead>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Descripci??n </label> </th>
                <th class="color-fondo"><label class="colorLetra letraT">Deuda Rem.</label></th>
                <!-- <th class="color-fondo"><label class="colorLetra">Tel??fono</label></th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="textIZQ"><label label class="letraC">{{ $cert->obs1 }}</label></th>
                <th><label label class="letraC">{{ $cert->montoRemuneracional }}</label></th>
                
            </tr>
           

        </tbody>
    </table>
    <!-- fin tabla 7  -->
    <!-- tabla 8 -->
    </br>
    </br>
    <label class="letraE">2.- Observaci??n parte Previsional</label>
    <table>
        <thead>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Descripci??n </label> </th>
                <th class="color-fondo"><label class="colorLetra letraT">Deuda Prev.</label></th>
                <!-- <th class="color-fondo"><label class="colorLetra">Tel??fono</label></th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="textIZQ"><label label class="letraC">{{ $cert->obs2 }}</label></th>
                <th><label label class="letraC">{{ $cert->montoRemuneracional }}</label></th>
                
            </tr>
           

        </tbody>
    </table>
    <!-- fin tabla 8  -->
    <!-- tabla 9-->
    </br>
    </br>
    <label class="letraE">3.- No presentaci??n de documentos</label>
    <table>
        <thead>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Descripci??n </label> </th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="textIZQ"><label label class="letraC">{{ $cert->obs3 }}</label></th>
                
                
            </tr>
           

        </tbody>
    </table>
    <!-- fin tabla 9  -->
    <!-- tabla 9-->
    </br>
    </br>
    <label class="letraE">4.- Observaciones Administrativas</label>
    <table>
        <thead>
            <tr>
                <th class="tit1 color-fondo"><label class="colorLetra letraT">Descripci??n </label> </th>
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="textIZQ"><label label class="letraC">{{ $cert->obs4 }}</label></th>
                
                
            </tr>
           

        </tbody>
    </table>
    <!-- fin tabla 9  -->
    <!-- texto cliente -->
    <p class="letraT">Declaraci??n del Cliente<br>
????????????El Cliente declara que toda informaci??n y antecedentes para emisi??n de este Certificado, son fidedignos y completos, asumiendo toda responsabilidad legal, en caso de
ocultamiento intencionado y/o adulteraci??n maliciosa de estos.</p>
<!-- fin texto cliente -->
<!-- tabla 10 -->
<div class="row">
    <div class="divx3 allado">
        <table>
            
                <tr>
                    <th class="color-fondo"><label class="letraT colorLetra">Fecha Emisi??n</label></th>
                </tr>
           
                <tr>
                    <th>02/02/2021</th>
                </tr>
                <tr>
                    <th class="color-fondo"><label class="letraT colorLetra">Fecha Inicio Inspecci??n</label></th>
                </tr>
                <tr>
                    <th>02/02/2021</th>
                </tr>
                <tr>
                    <th class="color-fondo"><label class="letraT colorLetra">Fecha Termino Inspecci??n</label></th>
                </tr>
                <tr>
                    <th>02/02/2021</th>
                </tr>
           
        </table>
    </div>
        
    <!-- fin tabla 10 -->
    <!-- tabla 12 -->
    <div class="divx3 allado divI">
        <div class="textM2">
            <h3 class="letraT">@foreach ($insp as $insp) {{$insp->user->name}} @endforeach</h3>
        </div>
      <label class="textM">Inspector Responsable</label
    </div>    
    <div class="divx3 allado divI textM2">
        <img src="selloOficial.png" width="112" height="97" >
    </div>    
</div>   
<!-- fin tabla 11 -->
<p class="letraT">En caso de existir alguna disconformidad informada en el certificado, el mandante puede realizar las retenciones necesarias para cubrir las
diferencias de pagos detectados, y efectuar directamente el pago a las personas ?? instituciones que correspondan</p>
<p><strong>Serres Verificadora SpA. EV-019. Diagonal Cervantes N?? 683 Of. 207, Santiago</strong></p>

<p style="page-break-before: always;"></p>
<img src="spa.png" width="150" height="40">
    <hr>
        <div  class="titulo">
            <label class="letraT">Rut:76.393.817-4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }} - <strong>VIG. Y DESV. DEL PERIODO</strong></label>
        </div>
    <hr>
    
    @if ($cert->nominaExtendida!='S')
    
            <!-- tabla de nomina normal -->
            <table>
                <tr>
                    <th class="tablanominacol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                    <th class="tablanominacol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                    <th class="tablanominacol3 color-fondo"><label class="colorLetra letraT">NOMBRE</label></th>
                    <th class="tablanominacol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                </tr>
                    <tbody>
                        @php 
                            $num=1;
                            $totalH=0;
                            $totalI=0;
                            $numPos=1;
                        @endphp
                        @foreach($cert->empleadoscertificado as $empleadosActuales)
                            @if ($empleadosActuales->hojaNomina==1)
                                <tr>
                                    <th><label label class="letraC"><?php echo $num++; $numPos++; ?></label></th>
                                    <th><label label class="letraC">{{ $empleadosActuales->rut }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->nombre }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->estado }}</label></th>
                                                                                                    
                                </tr>

                                <!-- crear segunda hoja de la primera nomina sin extender -->
                                @if($numPos==55)
                                </tbody>
                                </table>
                                            @if($num<$cert->dotacionFinal)
                                                <img src="selloOficial.png" class="margenSuperiorImagen" width="85" height="85" >
                                                <p style="page-break-before: always;"></p>
                                                <img src="spa.png" width="150" height="40">
                                                    <hr>
                                                        <div  class="titulo">
                                                            <label class="letraT">Rut:76.393.817-4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }} - <strong>VIG. Y DESV. DEL PERIODO</strong></label>
                                                        </div>
                                                    <hr>
                                <table>
                                                    <tr>
                                                        <th class="tablanominacol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                                                        <th class="tablanominacol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                                                        <th class="tablanominacol3 color-fondo"><label class="colorLetra letraT">NOMBRE</label></th>
                                                        <th class="tablanominacol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                                                    </tr>
                                                    <tbody>
                                            @endif
                                    <?php $numPos=1; ?>
                                @endif
                                    <!-- fin segunda hoja -->
                            @endif
                        @endforeach 
                        

                    </tbody>
            </table>
                                <img src="selloOficial.png" class="margenSuperiorImagen" width="85" height="85">
            <!-- fin tabla normal -->
            @endif


            @if ($cert->nominaExtendida!='N')
                <!-- tabla de nomina extendida -->
                    <table>
                        <tr>
                            <th class="tablanominaextcol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                            <th class="tablanominaextcol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                            <th class="tablanominaextcol3 color-fondo"><label class="colorLetra letraT">NOMBRE</label></th>
                            <th class="tablanominaextcol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                            <th class="tablanominaextcol5 color-fondo"><label class="colorLetra letraT">HABER</label></th>
                            <th class="tablanominaextcol6 color-fondo"><label class="colorLetra letraT">IMPONIBLE</label></th>
                        </tr>
                            <tbody>
                        @php 
                            $num=1;
                            $totalH=0;
                            $totalI=0;
                            $numPos=1;
                        @endphp
                    @foreach($cert->empleadoscertificado as $empleadosActuales)
                            @if ($empleadosActuales->hojaNomina==1)
                                <tr>
                                    <th><label label class="letraC"><?php echo $num++; $numPos++; ?></label></th>
                                    <th><label label class="letraC">{{ $empleadosActuales->rut }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->nombre }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->estado }}</label></th>

                                    <th class="textDER"><label label class="letraC">{{ $empleadosActuales->totalHaberes }}</label></th>                                                                

                                    <th class="textDER"><label label class="letraC">{{ $empleadosActuales->totalImponibles }}</label></th>   
                                </tr>
                            
                                <!-- segunda hoja de la primera nomina extendida-->
                                @if($num==55)
                                </tbody>
                                </table>
                                    @if($num<$cert->dotacionFinal)
                                        <img src="selloOficial.png" class="margenSuperiorImagen" width="85" height="85" >
                                        <p style="page-break-before: always;"></p>
                                        <img src="spa.png" width="150" height="40">
                                            <hr>
                                                <div  class="titulo">
                                                    <label class="letraT">Rut: 76.393.817 - 4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }} - <strong>VIGENTES Y DESVINCULADOS DEL PERIODO</strong></label>
                                                </div>
                                            <hr>
                                        <table>

                                            <tr>
                                                <th class="tablanominaextcol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                                                <th class="tablanominaextcol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                                                <th class="tablanominaextcol3 color-fondo"><label class="colorLetra letraT">{{$empleadosActuales->nombre}}</label></th>
                                                <th class="tablanominaextcol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                                                <th class="tablanominaextcol5 color-fondo"><label class="colorLetra letraT">HABER</label></th>
                                                <th class="tablanominaextcol6 color-fondo"><label class="colorLetra letraT">IMPONIBLE</label></th>
                                            </tr>
                                            <tbody>
                                    @endif
                                    <?php $numPos=1; ?>
                                @endif
                            @endif    
                            <!-- fin segunda hoja -->

                    @endforeach 

                                    </tbody>
                                </table>
                                <img src="selloOficial.png" class="margenSuperiorImagen" width="85" height="85" >
            <!-- fin tabla extedndida -->
    @endif

<!-- hojas de segunda nomina solo desvinculados -->
    @if ($cert->segundaNomina=='S')
            <p style="page-break-before: always;"></p>
            <img src="spa.png" width="150" height="40">
            <hr>
                <div  class="titulo">
                    <label class="letraT">Rut: 76.393.817 - 4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }} - <strong>DESVINCULADOS</strong></label>
                </div>
            <hr>
            <!-- tabla de nomina sin informacion -->
            <table>
                <tr>
                    <th class="tablanominacol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                    <th class="tablanominacol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                    <th class="tablanominacol3 color-fondo"><label class="colorLetra letraT">NOMBRE</label></th>
                    <th class="tablanominacol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                </tr>
                    <tbody>
                        @php 
                            $num=1;
                            $totalH=0;
                            $totalI=0;
                            $numPos=1;
                        @endphp
                        @foreach($cert->empleadoscertificado as $empleadosActuales)
                            @if ($empleadosActuales->hojaNomina==2)
                                <tr>
                                    <th><label label class="letraC"><?php echo $num++; $numPos++; ?></label></th>
                                    <th><label label class="letraC">{{ $empleadosActuales->rut }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->nombre }}</label></th>
                                
                                    <th class="textIZQ"><label label class="letraC">{{ $empleadosActuales->estado }}</label></th>
                                                                                                    
                                </tr>
                          
                            <!-- segunda hoja -->
                                    @if($numPos==55)
                                    </tbody>
                                    </table>
                                                <img src="selloOficial.png" class="margenSuperiorImagen" width="85" height="85" >
                                                <p style="page-break-before: always;"></p>
                                                <img src="spa.png" width="150" height="40">
                                                    <hr>
                                                        <div  class="titulo">
                                                            <label class="letraT">Rut: 76.393.817 - 4 CERTIFICADO DE CUMPLIMIENTO DE OBLIGACIONES LABORALES Y PREVISIONALES N?? {{$cert->id }} - <strong>DESVINCULADOS</strong></label>
                                                        </div>
                                                    <hr>
                                    <table>
                                                    <tr>
                                                        <th class="tablanominacol1 color-fondo"><label class="colorLetra letraT">N??</label></th>
                                                        <th class="tablanominacol2 color-fondo"><label class="colorLetra letraT">RUT</label></th>
                                                        <th class="tablanominacol3 color-fondo"><label class="colorLetra letraT">NOMBRE</label></th>
                                                        <th class="tablanominacol4 color-fondo"><label class="colorLetra letraT">ESTADO</label></th>
                                                     </tr>
                                                     <tbody>
                                        <?php $numPos=1; ?>
                                    @endif
                                    <!-- fin segunda hoja -->
                                @endif
                        @endforeach 
                                
                                
                        

                    </tbody>
            </table>
            <img src="selloOficial.png" class="margenSuperiorImagenSN" width="85" height="85" >
    <!-- fin tabla sin informaci??n -->
        @endif


@endforeach
</body>
</html>