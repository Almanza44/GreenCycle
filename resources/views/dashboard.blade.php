@extends('layouts.app')

@section('title', 'Mi vivero | ' . config('app.name'))

@section('content')

<section class="dashboard">

    <div class="dashboard-header">

        <div>
            <h1>
                Mi vivero
            </h1>

            <p>
                Cuida tus árboles y haz crecer tu mundo.
            </p>
        </div>

        <div class="dashboard-actions">

            <div class="coins">
                <span class="coins-label">
                    Green Coins
                </span>

                <strong class="coins-value">
                    0
                </strong>
            </div>

            <button
                type="button"
                class="button button--primary"
            >
                Plantar árbol
            </button>

        </div>

    </div>


    <div class="trees-section">

        <div class="trees-section__header">

            <h2>
                Mis árboles
            </h2>

            <p>
                Aquí podrás ver y cuidar todos los árboles de tu vivero.
            </p>

        </div>


        <div class="trees-grid">

            <div class="empty-state">

                <h3>
                    Tu vivero está vacío
                </h3>

                <p>
                    Planta tu primer árbol y comienza a construir tu vivero.
                </p>

                <button
                    type="button"
                    class="button button--primary"
                >
                    Plantar mi primer árbol
                </button>

            </div>

        </div>

    </div>

</section>

@endsection
