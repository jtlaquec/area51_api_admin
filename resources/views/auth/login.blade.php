<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://db.onlinewebfonts.com/c/9fa4d62fc7262d1822351a731e571a81?family=Novecento+CondDemiBold" rel="stylesheet">
</head>
<body>
    <main>
        <div class="logo">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo Area 51">
        </div>
        <div class="loading-gif">
            <img src="{{ asset('img/logo.gif') }}" alt="Marcianito">
        </div>
        <form class="form" action="{{ route('login') }}" method="post">
            @csrf

            <div class="form_input">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form_input">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="form_checkbox">
                <input type="checkbox" name="remember" id="remember_me">
                <label for="remember_me">Mantener sesión activa</label>
            </div>

            <button class="form_submit" type="submit">Ingresar</button>

{{--             @if (Route::has('password.request'))
                <a class="text-sm" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            @endif --}}
        </form>
    </main>
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
