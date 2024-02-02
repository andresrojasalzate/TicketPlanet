<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ public_path('css/styles.css') }}" type="text/css">
    <title>Document</title>
</head>
<body>
    <div class="entrada">
        <div class="cabezera-entrada">
            <img src="{{ public_path('images/LogoNombre.png') }}" alt="">
        </div>
        <div class="cuerpo-entrada">
            <table class="contenedor-entrada">
                <tr>
                    <td>
                        <div class="img-evento-etrada">
                            <img src="{{ public_path('images/fotos-subidas/event_default.jpeg') }}" alt="">
                        </div>
                     </td>
                    <td class="info-entrada">
                        <div class="info-entrada">
                            <p class="titulo-entrada">Nombre Evento</p>
                            <table>
                                <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/location.png') }}" alt=""></td>
                                    <td class="texto-entrada"><p>Direccion del evento</p> </td>
                                </tr>
                                 <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/calendar.png') }}" alt=""></td>
                                    <td class="texto-entrada"><p>00/00/0000</p></td>
                                 </tr>
                                <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/ticket.png') }}" alt=""></td>
                                    <td class="texto-entrada"><p>Entrada general</p></td>
                                </tr>
                                 <tr>
                                    <td class="imagenes-info-entrada"><img src="{{ public_path('images/entradas/dollar.png') }}" alt=""></td>
                                    <td class="texto-entrada"><p>00.00€</p></td>
                                 </tr>    
                                <tr>
                                    <td></td>
                                    <td class="texto-entrada"><p>Nombre Apellido</p></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="texto-entrada"><p>12345678D</p></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="texto-entrada"><p>12345678890</p></td>
                                </tr> 
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
</body>
</html>