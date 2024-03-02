<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/styleSASS.css') }}" type="text/css">
    <title>Document</title>
</head>
<body class="pdfEntradas">
    @foreach($compra->assistants as $assistant)
    <div class="entrada">
            
        <div class="cabezera-entrada">
            <img src="{{ public_path('images/LogoNombre.png') }}" alt="" loading="lazy">
        </div>
        <div class="cuerpo-entrada">
            <table class="contenedor-entrada">
                <tr>
                    <td>
                        <div class="img-evento-etrada">
                            <img src="http://127.0.0.1:9000/api/images/retrieve/medium/{{json_decode($compra->session->event->image)[0]}}" alt="" loading="lazy">
                        </div>
                     </td>
                    <td class="info-entrada">
                        <div class="info-entrada">
                            <p class="titulo-entrada">{{$compra->session->event->name}}</p>
                            <table>
                                <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/location.png') }}" alt="" loading="lazy"></td>
                                    <td class="texto-entrada"><p>{{$compra->session->event->address }} {{$compra->session->event->city }} {{$compra->session->event->name_site }}</p> </td>
                                </tr>
                                 <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/calendar.png') }}" alt="" loading="lazy"></td>
                                    <td class="texto-entrada"><p>{{$compra->session->date }}</p></td>
                                 </tr>
                                <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/ticket.png') }}" alt="" loading="lazy"></td>
                                    <td class="texto-entrada"><p>{{$assistant->ticket->name }}</p></td>
                                </tr>
                                 <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/dollar.png') }}" alt=""></td>
                                    <td class="texto-entrada"><p>{{$assistant->ticket->price }}€</p></td>
                                 </tr>
                                 @isset($assistant->nameAssistant)    
                                    <tr>
                                        <td></td>
                                        <td class="texto-entrada"><p>{{$assistant->nameAssistant}}</p></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="texto-entrada"><p>{{$assistant->dniAssistant}}</p></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="texto-entrada"><p>12345678890</p></td>
                                    </tr> 
                                @endisset
                            </table>
                        </div>
                    </td>
                    <td>
                        <div class="qr-entrada">
                            <img src="data:image/png;base64,{!! base64_encode($qr) !!}" />
                            
                        </div>
                    </td>
                </tr>
            </table>
        </div>
   
    </div>
    @endforeach
</body>
</html>