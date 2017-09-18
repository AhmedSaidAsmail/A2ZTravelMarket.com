@if(session('failure'))
<?php
$style = 'style="display:block;"';
$class = "bounceInDown";
?>
@else
<?php
$style = null;
$class = null;
?>
@endif
<div class="login-area" {!! $style !!}>
    <div class="login-box-2 animated {{$class}}">
        <!-- bounceInDown bounceOutUp -->
        <i class="fa fa-times-circle" id="close-login"></i>
        <h2>Log in to A2ZTravel</h2>
        <span class="login-header-span">
            Log in to add things to your wishlist and access your bookings from any device.
        </span>
        <a class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i>Log in with Facebook</a>
        <a class="btn btn-block btn-social btn-default"><i class="fa fa-google"></i>Log in with Google</a>
        <span class="login-or">or</span>
        @if(session('failure'))
        <div class="my-alert">
            <label>Whoops!</label> Looks like your email and password didn't match up. Want to try again?
        </div>
        @endif
        <form method="post" action="{{route('customer.login')}}">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" class="form-control" name="email" value="" placeholder="Email address">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" value="" placeholder="Password">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>

                </div>
                <div class="col-md-6 text-right">
                    <a href="">Forgot your password?</a>
                </div>
            </div>
            <button class="btn btn-info btn-block">Log in</button>
        </form>
        <div class="sign-up-section">
            New here? <a href="">Sign up here!</a> 
        </div>


    </div>
</div>