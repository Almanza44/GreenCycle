@extends('layouts.app')

@section('title', 'Crear cuenta | ' . config('app.name'))

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
                        Crear cuenta
                    </h1>

                    <p>
                        Crea tu cuenta y comienza a construir tu propio vivero.
                    </p>
                </div>

                <form action="#" method="POST">

                    <div class="form-group">
                        <label for="name">
                            Nombre
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Tu nombre"
                            required
                        >
                    </div>

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
                                placeholder="Crea una contraseña"
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

                    <div class="form-group">
                        <label for="password_confirmation">
                            Confirmar contraseña
                        </label>

                        <div class="password-field">

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repite tu contraseña"
                                required
                            >

                            <button
                                type="button"
                                class="password-toggle"
                                data-target="password_confirmation"
                                aria-label="Mostrar contraseña"
                            >
                                Mostrar
                            </button>

                        </div>
                    </div>

                    <button
                        type="submit"
                        class="button button--primary login-button"
                    >
                        Crear cuenta
                    </button>

                </form>

                <p class="login-register">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}">
                        Iniciar sesión
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