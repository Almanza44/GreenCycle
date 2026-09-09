@extends('layouts.app')

@section('title', 'Iniciar sesión | ' . config('app.name'))

@section('content')

    <section class="login-page">

        <div class="login-container">

            <!-- FORMULARIO -->
            <div class="login-form">

                <div class="login-heading">
                    <p class="login-eyebrow">
                        GREENCYCLE
                    </p>

                    <h1>
                        Iniciar sesión
                    </h1>

                    <p>
                        Bienvenido de nuevo. Continúa cuidando tu vivero.
                    </p>
                </div>

                <form action="#" method="POST">

                    <div class="form-group">
                        <label for="email">
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="ejemplo@correo.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Contraseña
                        </label>

                        <div class="password-field">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Ingresa tu contraseña"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password"
                                aria-label="Mostrar contraseña"
                            >
                                Mostrar
                            </button>

                        </div>
                    </div>

                    <div class="login-options">
                        <label class="remember-me">
                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>Recordarme</span>
                        </label>

                        <a href="#">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="button button--primary login-button"
                    >
                        Iniciar sesión
                    </button>

                </form>

                <p class="login-register">
                    ¿No tienes una cuenta?
                    <a href="{{ route('register') }}">
                        Crear una cuenta
                    </a>
                </p>

            </div>


            <!-- IMAGEN -->
            <div class="login-visual">

                <img
                    src="{{ asset('images/arbol.jpg') }}"
                    alt="Árbol de GreenCycle"
                >

            </div>

        </div>

    </section>

@endsection