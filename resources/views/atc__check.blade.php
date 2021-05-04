@extends('layouts.app')

@section('content')

<div class="container pt-4 pb-1 bg-light">
    <div class="row align-items-md-stretch">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('atc') }}" class="link-dark">Основные операции</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ЛОГ действия операторов банка</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@if(!isset($results))
<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12">
            <form method="post" action="{{ route('atc_check_post') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-lg">
                        <div class="form-floating">
                            <input type="date" name="date_op" class="form-control" id="floatingInputGrid">
                            <label for="floatingInputGrid">Дата проверки</label>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="form-floating">
                            <select class="form-select" name="filial" id="floatingSelectGrid" aria-label="Floating label select example">

                                @foreach($filails as $filail)
                                <option> {{ $filail->name_podr }} </option>
                                @endforeach

                            </select>
                            <label for="floatingSelectGrid">Филиали и ЦБО</label>
                        </div>
                    </div>
                </div>
                <div class="col-sm mt-3">
                    <div class="form-floating d-flex justify-content-end">
                        <button class="btn btn-lg btn-dark mx-3" type="submit">Поиск</button>
                        <a class="btn btn-lg btn-outline-dark" href="{{ route('atc') }}">Назад</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@isset($results)
<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">ip</th>
                        <th scope="col">дата</th>
                        <th scope="col">время</th>
                        <th scope="col">тект поиска</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $result->ip_address }}</td>
                        <td>{{ $result->date_in }}</td>
                        <td>{{ $result->time_in }}</td>
                        <td>{{ $result->fio_search }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="toggle_btn"> <a href="{{ route('atc') }}">Назад</a> </div>

@endisset
@endsection