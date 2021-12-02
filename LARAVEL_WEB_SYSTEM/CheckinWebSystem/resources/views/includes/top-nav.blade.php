<div class="nav-overlay" id="nav_overlay"></div>
<div class="top-nav" id="top_nav">
    <div class="hamburger" id="hamburger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
    </div>
    <div class="dash-user-info">
        <div class="user-text">
            <p>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
        </div>
        <div class="user-pic">
            <img src="{{ asset('./images/logo_png.png') }}" alt="" />
        </div>
    </div>
</div>