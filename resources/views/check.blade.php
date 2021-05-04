@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark bg-gradient rounded-3">
                <h2>Проверка клиентов АБС</h2><br />
                <p class="cart_body_sm">Отсюда вы можете проверить, всех клиентов банка (АБС) на черный список</p>
                <a class="btn btn-outline-light" href="{{ route('atc_clients_bank') }}">Далее</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark bg-gradient rounded-3">
                <h2>Проверка клиентов Сбербанк-Онлайн</h2><br />
                <p class="cart_body_sm">Отсюда вы можете проверить всех клиентов Сбербанк-Онлайн на черный список</p>
                <a class="btn btn-outline-light"  href="{{ route('atc_clients_cberbank') }}">Далее</a>
            </div>
        </div>
    </div>
</div>
@endsection