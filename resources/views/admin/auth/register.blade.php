@extends('layouts.admin')
@section('content')
<h4>Admin register</h4>
<div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="../Admin/img/adminn.png" width="400px;" height="500px;" class="img-fluid" alt="Sample image">
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

            <form method="POST" action="{{ route('register') }}" class="user">
                @csrf
                <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                    <h4>INSCRIPTION</h4>
                </div>
                <input type="hiden" name="code_unique" value="{{$code_unique}}" style="display:none;" >
                <div class="row mb-3">
                    <input type="text" style="height:40px;"  class="form-control"  value="" placeholder="Nom & Prenoms(ou Username)"  name="name">
                </div>
                <div class="row mb-3">
                    <input type="email" id="telephone_client"  style="height:40px;"   class="form-control" value=""  placeholder="Adresse email" name="email">
                </div>
                <div class="row mb-3">
                    <input type="tel" id="telephone_client"   style="height:40px;"   class="form-control" value="" placeholder="Enter N° telephone" name="numero">
                </div>
                <div class="row mb-3">
                    <input type="adresse" id="telephone_client"  style="height:40px;"    class="form-control" value="" placeholder="Adresse" name="adresse">
                </div>
                <div class="row mb-3">
                    <input type="password" id="telephone_client"  style="height:40px;"    class="form-control" value="" placeholder="password"  name="password" placeholder="Password">
                </div>
                <div class="row mb-3">
                    <input type="password" id="telephone_client"  style="height:40px;"    class="form-control" value="" placeholder="confirmé password"  name="password_confirmation">
                </div>
                <div class="row mb-3">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">
                        ENREGISTRER
                    </button>
                </div>
                
            </form>
        </div>
    </div>
</div>
    @endsection
