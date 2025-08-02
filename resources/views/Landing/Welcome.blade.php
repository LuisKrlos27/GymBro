<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sistema de Gestión para Gimnasios</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">

    @if(session('success'))
    <div class="alert alert-success shadow-lg my-4">
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error shadow-lg my-4">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- HERO -->
    <section class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-7">
        <div class="max-w-4xl mx-auto text-center px-4">
            <img src="{{ asset('images/interface-control-svgrepo-com.svg') }}" alt="Icono gimnasio" class="mx-auto mb-4 w-40" />
            <h1 class="text-4xl font-bold mb-4">
                Controla tu gimnasio de forma fácil e inteligente
            </h1>
            <p class="text-lg mb-6">Registra pagos, controla asistencias y genera facturas sin esfuerzo.</p>
            <a href="{{ route('asistencias.index') }}" class="bg-white text-indigo-600 font-bold py-2 px-6 rounded-full hover:bg-gray-200">Inicar demo</a>
        </div>
    </section>

    <!-- BENEFICIOS -->
    <section class="py-20 bg-gray-200">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <img src="{{ asset('images/buy-discount-repeat-order-svgrepo-com.svg') }}" alt="Pagos" class="mx-auto w-24 mb-4" />
                <h3 class="text-xl font-semibold mb-2">🧾 Registro de pagos</h3>
                <p>Factura automáticamente y conoce el estado de cada cliente.</p>
            </div>
            <div>
                <img src="{{ asset('images/attendance-svgrepo-com.svg') }}" alt="Asistencias" class="mx-auto w-24 mb-4" />
                <h3 class="text-xl font-semibold mb-2">📅 Control de asistencias</h3>
                <p>Registra quién vino cada día con solo un clic.</p>
            </div>
            <div>
                <img src="{{ asset('images/presentation-financial-svgrepo-com.svg') }}" alt="Reportes" class="mx-auto w-24 mb-4" />
                <h3 class="text-xl font-semibold mb-2">📈 Reportes y vencimientos</h3>
                <p>Visualiza planes activos y próximas fechas de renovación.</p>
            </div>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="bg-gray-100 py-20">
        <div class="max-w-3xl mx-auto text-center">
            <img src="{{ asset('images/cha-bubbles-two-svgrepo-com.svg') }}" alt="Feedback" class="mx-auto w-20 mb-6" />
            <h2 class="text-2xl font-bold mb-6">Lo que dicen nuestros usuarios</h2>
            <blockquote class="italic text-gray-700">
                “Gracias a este sistema, dejé de usar Excel. Todo lo tengo sistematizado y controlo los pagos al instante.”<br />
                <span class="font-bold mt-2 block">— Luis Escobar, Administrador</span>
            </blockquote>
        </div>
    </section>

    <!-- FORMULARIO -->
    <section id="demo" class="py-16 bg-white">
        <div class="max-w-xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">¿Listo para digitalizar tu gimnasio?</h2>
            <p class="mb-6">Déjanos tus datos y agenda una demo gratuita</p>
            <form action="#" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre completo" required class="input input-bordered w-full p-3 rounded border">
                <input type="email" name="email" placeholder="Correo electrónico" required class="input input-bordered w-full p-3 rounded border">
                <input type="tel" name="telefono" placeholder="Número de WhatsApp" class="input input-bordered w-full p-3 rounded border">
                <button type="submit" class="bg-indigo-600 text-white py-3 rounded hover:bg-indigo-700">Solicitar Demo</button>
            </form>



        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <p>&copy; {{ date('Y') }} SistemaFit. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
