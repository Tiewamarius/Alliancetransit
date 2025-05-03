@extends('layouts.Client')
@section('content')

<div class="container-fluid h-custom" style="margin-top: 150px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-4 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
        </div>
        <!-- col-md-8 col-lg-6 col-xl-4 offset-xl-1 -->
        <div class="col-md-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>

                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('login') }}" class="user">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <p class="lead fw-normal mb-0 me-3">CONNEXION</p>
                </div>
                <br>
                <!-- Email input -->

                <div class="row mb-3">
                    <input type="email" id="telephone_client" style="height:40px;" class="form-control" value="" placeholder="Adresse email" name="email">
                </div>

                <!-- Password input -->
                <div class="row mb-3">
                    <input type="password" id="telephone_client" style="height:40px;" class="form-control" value="" placeholder="password" name="password" placeholder="Password">
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                        <label class="form-check-label" for="form2Example3">
                            Remember me
                        </label>
                    </div>
                    <a href="#!" class="text-body">Forgot password?</a>
                </div>
                
                <div class="row mb-3">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">
                        VALIDER
                    </button>
                </div>
                <p class="small fw-bold mt-2 pt-1 mb-0">Pas de compte? <a href="{{url('/register')}}"class="link-danger">Register</a></p>
            </form>
        </div>
    </div>
</div>


@endsection