@extends('layouts.app')

@section('content')
@auth
<div class="container text-white rounded bg-dark">
    <div class="row align-items-md-stretch">
        <div class="p-5">
            <div class="col-12 px-0 text-center">
                <h1 class="display-4 fst-italic py-5">Compliance System</h1>
                <p class="display-6 fst-italic pb-5">
                    Данная система позволяет обновить базу данных террористов и экстримистов. Также имеется возможность проверит базу клиентов Банковской системы и системы СбербанкОнлайн на наличие террористов.
                </p>
            </div>
        </div>
    </div>
</div>
@endauth

@endsection