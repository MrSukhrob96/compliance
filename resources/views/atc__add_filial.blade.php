@extends('layouts.app')

@section('content')

<div class="container pt-4 pb-1 bg-light">
    <div class="row align-items-md-stretch">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('atc') }}" class="link-dark">Основные операции</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавление подразделений (Филлиал, ЦБО...)</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12">
            <form method="post" action="{{ route('atc_add_filial_post') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="name_filial" id="floatingInputGrid">
                            <label for="floatingInputGrid">Наимнование подразделений <i>(МХБ Абраш...)</i> </label>
                        </div>
                    </div>                 
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="podr_filial" id="floatingInputGrid">
                            <label for="floatingInputGrid">Код подразделений <i>(0001)</i> </label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="podsetka" id="floatingInputGrid">
                            <label for="floatingInputGrid">Подцетка IP подразделений <i>(11)</i></label>
                        </div>
                    </div>
                </div>
                <div class="col-sm mt-3">
                    <div class="form-floating d-flex justify-content-end">
                        <button class="btn btn-lg btn-dark mx-3" type="submit">Добавить</button>
                        <a class="btn btn-lg btn-outline-dark" href="{{ route('atc') }}">Назад</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection