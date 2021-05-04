@extends('layouts.app')

@section('content')
<div class="container pt-4 pb-1 bg-light">
    <div class="row align-items-md-stretch">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('atc') }}" class="link-dark">Основные операции</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Обновление списка Террористов и Экстремистов</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row align-items-md-stretch justify-content-center">
        <div class="col-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Обнавить с файла (Excel)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Обнавить онлайн (NBT)</button>
                </li>
            </ul>
            <div class="tab-content border border-secondary rounded" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container py-5">
                        <div class="row align-items-md-stretch justify-content-center">
                            <form method="post" action="{{ route('atc_update_post') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <input class="form-control form-control-lg" name="excel_file" type="file" id="formFile">
                                    </div>
                                    <div class="col-3">
                                        <select class="form-select form-select-lg" name="status" id="floatingSelectGrid" aria-label="Floating label select example">
                                           @foreach($statuses as $status)                                              
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2 d-flex justify-content-end">
                                        <button class="btn btn-lg btn-dark mx-2" type="submit" name="import">Импорт</button>
                                        <a class="btn btn-lg btn-outline-dark" href="{{ route('atc') }}">Назад</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container py-5">
                        <div class="row align-items-md-stretch justify-content-center">
                            <form method="post" action="{{ route('atc_update_post') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-9">
                                        <select class="form-select form-select-lg" name="status" id="floatingSelectGrid" aria-label="Floating label select example">
                                            @foreach($statuses as $status)
                                                @if($status->id !== 3)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end">
                                        <button class="btn btn-lg btn-dark mx-3" type="submit" name="update">Обнавить</button>
                                        <a class="btn btn-lg btn-outline-dark" href="{{ route('atc') }}">Назад</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection