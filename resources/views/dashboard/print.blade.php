<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <?php $style_path = '/css/pdf.min.css'; ?>
    <link rel="stylesheet" href="{{ public_path() . $style_path}} ">
    <style>
        .chartData {
            height: 40px;
        }

        .tablepay {
            height: 25px;
        }

        label {
            white-space: normal;
            word-wrap: break-word;
        }

        .img2 {
            height: 100px;
        }

        .img3 {
            height: 80px;
        }

        center {
            font-size: smaller;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body class="border border-dark border-5 rounded pl-3 pr-3 pt-3 m-0">
    <div id="app">
        <div class="border border-dark border-5 rounded text-center m-1 p-3 pb-1 mb-3">

            <table class="col-lg-12 p-0">

                <tbody>
                    <tr>
                        <td class="text-center w-50">
                            <?php $style_path = '/images/favicon.ico'; ?>
                            <img class="img2 " src="{{ public_path() . $style_path }}">

                        </td>
                        <td class="w-75">
                            <h4 class="text-center font-weight-bold">Chispots</h4>
                            <h5 class="text-center font-weight-bold">"Servicios hospitalarios"</h5>
                            <h6 class="text-center">Atención de alta calidad a nuestros clientes</h6>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="border border-dark border-5 rounded text-center m-1  mt-4">
            <h6 class="m-2 ">
                <center class="font-weight-bold h6">Información del reporte</center>
            </h6>
            <div class="container col-sm-12 row text-center m-2 mt-3">
                <table class="col-lg-12 p-0">

                    <body>
                        <tr>
                            <td class="w-50 ">
                                <div class="border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                                    <label class="text h6 small">Solicitado por:{{$username}} </label>
                                </div>
                            </td>
                            <td>
                                <div class=" border chartData col-sm-12 rounded border-dark text-left m-1 mb-1">
                                    <label class="text h6 small">Fecha: {{$dates}}</label>
                                </div>
                            </td>
                        </tr>
                    </body>
                </table>


            </div>
        </div>


        <div class="border border-dark border-5 rounded text-center m-1 p-3 pb-1 mb-5 mt-3">
            <h6>
                <center class="font-weight-bold h6">Horarios</center>
            </h6>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th class="text h6 small font-weight-bold">Id</th>
                        <th class="text h6 small font-weight-bold">Nombre</th>
                        <th class="text h6 small font-weight-bold">Área</th>
                        <th class="text h6 small font-weight-bold">No.Usuarios</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedule as $s)
                    <tr>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->id}}</p>
                        </td>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->name}}</p>
                            </th>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->area->name}}</p>
                        </td>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{sizeof($s->users)}}</p>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border border-dark border-5 rounded text-center m-1 p-3 pb-1 mb-5 mt-3">
            <h6>
                <center class="font-weight-bold h6">Inventario</center>
            </h6>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th class="text h6 small font-weight-bold">Id</th>
                        <th class="text h6 small font-weight-bold">Nombre</th>
                        <th class="text h6 small font-weight-bold">Cantidad</th>
                        <th class="text h6 small font-weight-bold">Área</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventary as $s)
                    <tr>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->id}}</p>
                        </td>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->name}}</p>
                            </th>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->quantity}}</p>
                        </td>
                        <td class="p-2 m-0">
                            <p class="text h6 small p-0 m-0">{{$s->area->name}}</p>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <h6>
                <center class="font-weight-bold h6">Aviso de Privacidad</center>
            </h6>
            <p class="text-justify">


                Empresa S.A. con domicilio en Av. Francisco González Bocanegra No. 1300, Colonia Centro, San Luis
                Potosí, S.L.P. C.P. 78350, conforme a lo establecido en la Ley Federal de Protección de Datos en
                Posesión de Particulares, pone a disposición de nuestros clientes, proveedores, empleados y público en
                general, nuestro Aviso de Privacidad.
                <br />
                Los datos personales que nos proporciona son utilizados estrictamente en la realización de funciones
                propias de nuestra empresa y por ningún motivo serán transferidos a terceros.
                <br />
                A nuestros clientes les solicitamos los siguientes datos personales:
                <br /><br />
                Nombre, teléfono, correo electrónico y domicilio para facilitar el proceso de contratación de nuestro
                servicio y/o compra de nuestros productos.
                Datos financieros como número de tarjeta de débito o crédito, nombre del titular, nombre de la
                institución bancaria, fecha de vencimiento y código de seguridad para efectuar los pagos de contratación
                y/o compra correspondientes.
                RFC para completar los datos de facturación y realizar el proceso en cuestión.
                A nuestros proveedores solicitamos los siguientes datos personales:
                <br />
                Nombre, teléfono, correo electrónico y domicilio para facilitar el proceso de contratación de servicio
                y/o compra de productos.
                A nuestros empleados solicitamos los siguientes datos personales:
                <br />
                Nombre, teléfono, correo electrónico, domicilio, fecha y lugar de nacimiento.
                Antecedentes laborales, puesto, sueldo y motivo de terminación laboral en los últimos cinco empleos.
                En caso de realizar modificaciones al presente Aviso de Privacidad, le informaremos mediante correo
                electrónico, nuestro sitio web oficial, medios impresos y nuestros operadores telefónicos.
            </p>
        </div>
    </div>

</body>

</html>