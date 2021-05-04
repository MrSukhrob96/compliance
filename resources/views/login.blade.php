@extends('layouts.app')

@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-5 py-5">
        <div class="col-10 mx-auto col-lg-5">
            <form class="p-5 border rounded-3 bg-light" method="post" action="{{ route('signin') }}">
            @csrf
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Логин</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Парол</label>
                </div>
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me" name="remember_me"> Запомни меня
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-dark" type="submit">Войти</button>
            </form>
        </div>
    </div>
</div>
@endsection