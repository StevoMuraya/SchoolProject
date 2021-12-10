@extends('auth.format')

@section('dash_content')
<div class="login-container">
    <div class="login-panel">
        <div class="login-panel-top">
            <div class="login-top-logo">
                <img src="{{ asset('./images/logo_png.png') }}" alt="" />
            </div>
        </div>
        <div class="login-panel-body">
            <form action="{{ route('display.code',['class_id'=>$class->class_id,'lec_id'=>$lecturer->lec_id]) }}"
                method="post" class="form-action">
                @csrf
                @if (session('status'))
                <div class="login-session-message" style="background-color: #cf3131;color:white;">
                    {{ session('status') }}
                </div>
                @endif
                <h3>{{ $lecturer->lec_firstname }} {{ $lecturer->lec_lastname }}</h3>
                <h5>{{ $class->classes_unit_relation->unit_code }}</h3>
                    <h5>{{ $class->classes_unit_relation->unit_name }}</h3>
                        <p class="form-text-desc" style="margin-top: 2em;">
                            Key in your password to display class QR code
                        </p>
                        <div class="input-holder">
                            <input type="password" name="password" id="password" value="" placeholder="Password"
                                class="input-space  @error('password') error @enderror" />

                            @error('password')
                            <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="login-btn-holder">
                            <button class="btn btn-login">Show Code</button>
                        </div>
            </form>
        </div>
    </div>
</div>
@endsection