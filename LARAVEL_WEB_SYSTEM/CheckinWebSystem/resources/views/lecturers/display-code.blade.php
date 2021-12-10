@extends('auth.format')

@section('dash_content')
<div class="login-container">
    <div class="login-panel qr_show">
        <div class="login-panel-top">
            <div class="login-top-logo">
                <img src="{{ asset('./images/logo_png.png') }}" alt="" />
            </div>
        </div>
        <div class="login-panel-body qr_show">
            <input type="text" id="qr_data" value="{{ $class->class_code }}" />
            <div class="qr_code_lec_disp">
                <div id="qrimage"></div>
            </div>
            <div class="login-btn-holder qr_show">
                <button class="btn btn-login" id="exportImageQRCodeOutputBtn">
                    Export as image
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('./js/qr_js.js') }}"></script>
@endsection