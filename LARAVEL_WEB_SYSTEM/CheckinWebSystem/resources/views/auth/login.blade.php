@extends('auth.format')

@section('dash_content')
<div class="login-container">
    <div class="login-panel">
        <div class="login-panel-top">
            <div class="login-top-logo">
                <img src="./images/logo_png.png" alt="" />
            </div>
        </div>
        <div class="login-panel-body">
            <form action="{{ route('login') }}" method="post" class="form-action">
                @csrf
                <p class="form-text-desc">
                    fill in the form to login to the system
                </p>
                <div class="input-holder">
                    <input type="email" placeholder="Email Address" name="email" value="{{ old('email') }}"
                        autocomplete="email" autofocus id="email" class="input-space  
                    @error('email')
                    error
                @enderror" />

                    @error('email')
                    <p class="input-error">{{ $message }}</p>
                    @enderror

                </div>
                <div class="input-holder">
                    <input type="password" name="password" id="password" placeholder="Password" class="input-space 
                        @error('password')
                        error
                    @enderror
                    " />

                    @error('password')
                    <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="remember-me-holder">
                    <input id="remember" name="remember" type="checkbox" class="remember-check" {{ old('remember')
                        ? 'checked' : '' }} />
                    <label for="remember">Remember Me</label>
                </div>
                <div class="login-btn-holder">
                    <button class="btn btn-login">Login</button>
                </div>

                @if (Route::has('password.request'))
                <div class="forget-pass">
                    <a href="" class="forget-password-link">Forgot Your Password?</a>
                </div>
                @endif

                <p class="form-text-desc bottom">
                    Facing problems while logging in? Contact the system admin through
                    <a href="">admin@checkinsystem.com</a>
                </p>
            </form>
        </div>
    </div>
</div>

@endsection