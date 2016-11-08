@extends('layouts.auth')

@section('content')

<div class="container-alt" id="app">
    <div class="row">
        <div class="col-sm-12">

            <div class="wrapper-page">

                <div class="m-t-40 account-pages">
                    <div class="text-center account-logo-box" style="background-color: #efefef">
                        <img src="/images/logo.png" alt="" height="36">
                    </div>
                    <div class="account-content">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input class="form-control" name="email" type="email" required="" placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <input class="form-control" name="password" type="password" required="" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <div class="checkbox checkbox-success">
                                        <input id="checkbox-signup" type="checkbox" checked>
                                        <label for="checkbox-signup" name="remember">
                                            Remember me
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group account-btn text-center m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                        </form>

                        <div class="clearfix"></div>

                    </div>
                </div>
                <!-- end card-box-->


                <div class="row m-t-50">
                    <div class="col-sm-12 text-center">
                        <p class="text-muted">Forget Password? <span class="text-primary m-l-5"><b>Contact Admin</b></span></p>
                    </div>
                </div>

            </div>
            <!-- end wrapper -->

        </div>
    </div>
</div>
@stop
