<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>

    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        /* Contenedor con todo el cuerpo */
        .container {
            width: 100%;
            margin: 0px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el logo */
        .logo img {
            width: 100%;
            margin-bottom: 20px;
        }

        /* Los titulos h1 h3 y h4 */
        h2, h4 {
            margin: 10px 0;
            text-align: center;
            background-color: #343a40;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        /* Estilo para las 2 columnas */
        .d-flex {
            width: 100%;
            overflow: hidden;
        }

        /* Las 2 columnas */
        .left-column, .right-column {
            width: 45%;
            display: inline-block;
            vertical-align: top;
        }

        .clearfix {
            clear: both;
        }
        /* La descripcion de la columna izquierda */
        .description{
            margin-left: 0px;
        }

        /* Los texto dentro de la descripcion */
        .left-column p {
            text-align: center;
            font-size: 12px;
            margin: 15px;
        }

        /* Los textos de la columna derecha */
        .right-column p{
            text-align: center;
            font-size: 12px;
        }

        /* La fecha por encima de la tabla */
        .date{
            margin-left: 50px;
            font-size: 12px;
        }

        /* Estilo para el titulo de la fecha */
        .title_date{
            margin: 10px 0;
            text-align: center;
            background-color: #343a40;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        /* La tabla con los detalles de la factura */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            padding: 8px 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #d35400;
            color: white;
        }

        td.text-start {
            text-align: left;
        }

        td.text-center{
            text-align: center;
        }

        td.text-end {
            text-align: right;
        }
        /* Estilos para las filas de total */
        .totales{
            margin-top: 20px;
            margin-left: 65%;
            font-size: 14px;
        }

        .totales-izquierda, .totales-derecha{
            display: inline-block;
            width: 45%;
            vertical-align: top;
        }

        .totales-izquierda {
            text-align: left;
        }

        .totales-derecha{
            text-align: center;
        }

    </style>

</head>
<body>
    <div class="container">
        <div class="d-flex clearfix">

            <!-- Columna izquierda con el logo y la descripción del taller -->
            <div class="left-column">

                <div class="logo">
                    <img src="{{ $logo_url }}" alt="Logo">

                </div>

                <div class="description">

                    <p>Ronda del Matadero s/n</p>
                    <p>14650 Bujalance - Córdoba</p>
                    <p>Telefono: 957 170 258</p>
                    <p>Email: taller_repar@gmail.com</p>

                </div>

            </div>
            
            <!-- Columna derecha con los detalles del cliente -->
            <div class="right-column">

                <h2>Factura</h2>

                <h4>Cliente:</h4>

                <p>{{ $cliente_nombre }}</p>
                <p>{{ $cliente_direccion }}</p>

                <h4>Vehículo o Maquinaria</h4>

                <p>{{ $vehiculo }}</p>
                <p>{{ $matricula }}</p>

            </div>

        </div>

        <p class="date">
            <span class="title_date">Fecha:</span> 
            <span>{{ $fecha_emision }}</span>
        </p>

        <table>
            <thead>
                <tr>
                    <th class="text-start">Concepto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Unidad</th>
                    <th class="text-center">Descuento (%)</th>
                    <th class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $detalle)
                    <tr>
                        <td class="text-start">{{ $detalle['descripcion'] }}</td>
                        <td class="text-center">{{ $detalle['cantidad'] }}</td>
                        <td class="text-center">{{ $detalle['precio_unidad'] }}€</td>
                        <td class="text-center">{{ $detalle['descuento_por'] }}</td>
                        <td class="text-end">{{ $detalle['precio_base_imponible'] }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totales">

            <div class="totales-izquierda">

                <p><strong>Base imponible:</strong></p>
                <p><strong>Descuentos:</strong></p>
                <p><strong>IVA {{ $iva_porcentaje }}%:</strong></p>
                <p><strong>Total Factura:</strong></p>

            </div>

            <div class="totales-derecha">

                <p class="text-center">{{ $baseImponible }}€</p>
                <p class="text-center">{{ $total_descuento }}€</p>
                <p class="text-center">{{ $total_iva }}€</p>
                <p class="text-center"><strong>{{ $precio_factura }}</strong></p>

            </div>

        </div>

        <div class="clearfix"></div>

    </div>
    <div class="clearfix"></div>
</body>
</html>
