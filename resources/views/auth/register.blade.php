@extends('/layouts.Client')

@section('content')
<div class="container-fluid h-custom" style="margin-top: 100px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif    
        <form method="POST" action="{{route('register') }}" class="user">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <p class="lead fw-normal mb-0 me-3">REGISTER</p>
                </div>
                <br>
                <!-- Name input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="name" id="form3Example3" class="form-control form-control-lg"
                        :value="__('name')"
                        name="name" :value="old('name')"
                        required autofocus autocomplete="username"
                        placeholder="Enter un nom..." />
                    <label class="form-label" for="form3Example3">Nom d'Utilisateur</label>
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="form3Example3" class="form-control form-control-lg"
                        :value="__('Email')"
                        name="email" :value="old('email')"
                        required autofocus autocomplete="username"
                        placeholder="Enter Email Address...">
                    <label class="form-label" for="form3Example3">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <input type="password" id="form3Example4" class="form-control form-control-lg"
                        :value="__('password')" name="password"
                        required autocomplete="current-password"
                        id="exampleInputPassword" placeholder="Password">
                    <label class="form-label" for="form3Example4">Password</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <input type="password" id="form3Example4" class="form-control form-control-lg"
                        :value="__('password_confirmation')" name="password_confirmation"
                        required autocomplete="current-password"
                        id="exampleInputPassword" placeholder="password_confirmation">
                    <label class="form-label" for="form3Example4">Confirmé Password</label>
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

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{url('/login') }}"
                            class="link-primary">connextion</a></p>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection