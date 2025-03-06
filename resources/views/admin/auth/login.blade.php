@extends('layouts.admin')

@section('content')
<h4>Admin Login</h4>
<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="../Admin/img/adminn.png" width="300px;" height="400p3;" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="POST" action="{{ route('admin.login') }}" class="user">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <h4>CONNEXION</h4>
                </div>
                <div class="row mb-3">
                    <input type="email" id="telephone_client" class="form-control" value="" placeholder="Adresse Email" name="email" placeholder="Password">
                </div>
                <div class="row mb-3">
                    <input type="password" id="telephone_client" class="form-control" value="" placeholder="password":value="__('password')" name="password" placeholder="Password">
                </div>
                <div class="row mb-3">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">
                        LOGIN
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection