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
                id="open-plant-modal"
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
            id="open-plant-modal-empty"
        >
            Plantar mi primer árbol
        </button>

    </div>

</div>

</div>

    </section>

    <div
    class="plant-modal"
    id="plant-modal"
    aria-hidden="true"
>

    <div class="plant-modal__overlay"></div>

    <div
        class="plant-modal__content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="plant-modal-title"
    >

        <button
            type="button"
            class="plant-modal__close"
            id="close-plant-modal"
            aria-label="Cerrar ventana"
        >
            ×
        </button>

        <div class="plant-modal__header">

            <p class="plant-modal__eyebrow">
                NUEVO ÁRBOL
            </p>

            <h2 id="plant-modal-title">
                Planta un nuevo árbol
            </h2>

            <p>
                Elige el tipo de árbol que quieres cultivar en tu vivero.
            </p>

        </div>

        <form id="plant-tree-form">

            <div class="form-group">

                <label for="tree-name">
                    Nombre del árbol
                </label>

                <input
                    type="text"
                    id="tree-name"
                    name="name"
                    placeholder="Ej. Mi roble"
                    maxlength="255"
                    required
                >

            </div>

            <div class="form-group">

                <label for="tree-type">
                    Tipo de árbol
                </label>

                <select
                    id="tree-type"
                    name="seed_type_id"
                    required
                >
                    <option value="1">
                        Roble
                    </option>
                </select>

            </div>

            <button
                type="submit"
                class="button button--primary plant-modal__submit"
            >
                Plantar árbol
            </button>

        </form>

    </div>

</div>

@endsection
