<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Médico</title>
    <style>
        @page {
            margin: 100px 50px 80px;
        }
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }
        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 80px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }
        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 60px;
            border-top: 1px solid #ccc;
            font-size: 10px;
            color: #777;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            padding: 10px 30px;
        }
        h1 {
            font-size: 20px;
            color: #2a4365;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #000;
        }
        .logo {
            width: 60px;
            height: auto;
            margin-right: 10px;
        }
        .header-title {
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <table width="100%">
            <tr>
                <td width="10%">
                    <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
                </td>
                <td class="header-title">
                    <h3>Consultorio Pediátrico Coral Kids</h3>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <div class="footer-content">
            <p style="margin: 0;">RUC: 12345678910 - Mrscl. Castilla , Chilca</p>
            <p style="margin: 0;">contacto@coralkids.pe | (064) 123-456</p>
            <span>Generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>
            <span>Página <script>document.write(window.pdf ? window.pdf.pageNumber : '1');</script></span>
        </div>
    </footer>

    <main>
        <h1>Historial Médico del Paciente</h1>
    
        <div class="section">
            <table width="100%" style="margin-bottom: 25px;">
                <tr>
                    <td><strong>Nombre del Paciente:</strong></td>
                    <td>{{ $historial->nombre_paciente }} {{ $historial->apellidos_paciente ?? '' }}</td>
                </tr>
                <tr>
                    <td><strong>Doctor Responsable:</strong></td>
                    <td>{{ $historial->nombre_doctor }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha de Atención:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($historial->fecha)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
    
        <div class="section">
            <h3 style="color:#4a5568; margin-bottom: 6px; font-size: 15px;">Motivo de Consulta</h3>
            <div style="border: 1px solid #ccc; padding: 10px; background: #f9f9f9; border-radius: 5px;">
                {!! nl2br(e($historial->motivo_consulta ?: 'No especificado.')) !!}
            </div>
        </div>
    
        <div class="section">
            <h3 style="color:#4a5568; margin-bottom: 6px; font-size: 15px;">Diagnóstico</h3>
            <div style="border: 1px solid #ccc; padding: 10px; background: #fff8dc; border-radius: 5px;">
                {!! nl2br(e($historial->diagnostico)) !!}
            </div>
        </div>
    
        <div class="section">
            <h3 style="color:#4a5568; margin-bottom: 6px; font-size: 15px;">Tratamiento Indicado</h3>
            <div style="border: 1px solid #ccc; padding: 10px; background: #e6fffa; border-radius: 5px;">
                {!! nl2br(e($historial->tratamiento)) !!}
            </div>
        </div>
    </main>    

</body>
</html>