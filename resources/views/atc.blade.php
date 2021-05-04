
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row align-items-md-stretch">
        <div class="col-md-4">
            <div class="h-100 p-5 text-white bg-dark bg-gradient rounded-3">
                <h4>ЛОГ действия операторов банка</h4><br />
                <p class="cart_body_lg">Отсюда вы можете увидеть лог действия операторов банка.  </p>
                <a class="btn btn-lg btn-outline-light" href="{{ route('atc_check') }}">Далее</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 p-5 text-white bg-dark bg-gradient rounded-3">
                <h4>Обновление списка Террористов и Экстремистов</h4><br />
                <p class="cart_body_lg">Отсюда вы можете обновить список Террористов и Экстремистов</p>
                <a class="btn btn-lg btn-outline-light" href="{{ route('atc_update') }}">Далее</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="h-100 p-5 text-white bg-dark bg-gradient rounded-3">
                <h4>Добавление подразделений (Филлиал, ЦБО...)</h4><br />
                <p class="cart_body_lg">Отсюда вы можете добавлять новых Подразделений (Филлиал, ЦБО)</p>
                <a class="btn btn-lg btn-outline-light" href="{{ route('atc_add_filial') }}">Далее</a>
            </div>
        </div>
    </div>
</div>
@endsection
