@extends('layouts.app')

@section('content')

<div class="container pt-4 pb-1 bg-light">
    <div class="row align-items-md-stretch">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('check') }}" class="link-dark">Проверка клиентов банка</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Проверка клиенты банка</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12">
            <form method="post" action="{{ route('atc_clients_bank_post') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-9">
                        <input class="form-control form-control-lg" name="excel_file" type="file" id="floatingInputGrid">
                    </div>
                    <div class="col-1">
                        <select class="form-select form-select-lg" name="percent" id="select_input" aria-label="Floating label select example">

                        </select>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <button class="btn btn-lg btn-dark mx-3" type="submit">Поиск</button>
                        <a class="btn btn-lg btn-outline-dark" href="{{ route('check') }}">Назад</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@isset($result)
<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        @if(count($result) > 0)
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">фио(файл)</th>
                        <th scope="col">дата рождение(файл)</th>
                        <th scope="col">% сходство</th>
                        <th scope="col">фио(атц)</th>
                        <th scope="col">дата рождение(атц)</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>

                    @foreach($result as $item)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $item['fio_xml'] }}</td>
                        <td>{{ $item['date_birth_xml'] }}</td>
                        <td>{{ $item['percent'] }}</td>
                        <td>{{ $item['fio_sql'] }}</td>
                        <td>{{ $item['date_birth_sql'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="container">
            <div class="row align-items-md-stretch justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10 p-4 p-md-5 text-white mt-5 rounded bg-dark">
                    <div class="px-0 text-center">
                        <p class="lead my-5 text-center">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                        <button class="btn btn-outline-light px-3" type="button">OK</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endisset
@endsection