@extends('layouts.app')
@section('title', 'New Password')
@section('content')
        <hr>

        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form method="post">
                    @csrf
                        <div class="card-header text-center">
                            <h3 class="display-5">New Password</h3>
                        </div>
                        <div class="card-body">   

                            <div class="control-grup col-12">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                        <div class="text-danger mt-2">
                                        {{$errors->first('password')}}
                                        </div>       
                                @endif
                            </div>
                            <div class="control-grup col-12">
                                <label for="password_c">Confirm Mot de passe</label>
                                <input type="password" id="password_c" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-grid mx-auto">
                                <input type="submit" class="btn btn-success btn-block" value="Save password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection