@extends('format')
@section('content-holder')

<div class="dash-split">
    <div class="dash-col content" id="data_col_content">
        <div class="register-popup 
        @error('firstname') show @enderror  
        @error('lastname') show @enderror
        @error('email') show @enderror" id="register_popup">
            <div class="reg-popup-container">
                <div class="close-reg-pop" id="close_reg_pop"></div>
                <form action="{{ route('admin-users.store') }}" method="post" enctype="multipart/form-data"
                    class="form-action pop-up">
                    @csrf
                    <h2 class="new-lec-title">New Admin Registration</h2>
                    <p class="lec_subtitle">Fill out the form below to proceed</p>
                    <div class="input-holder pop-up">
                        <input type="text" placeholder="First name" value="{{ old('firstname') }}" name="firstname"
                            class="input-space  @error('firstname') error @enderror" />

                        @error('firstname')
                        <p class="input-error">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class=" input-holder pop-up">
                        <input type="text" placeholder="Last name" value="{{ old('lastname') }}" name="lastname"
                            class="input-space  @error('lastname') error @enderror" />

                        @error('lastname')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" input-holder pop-up">
                        <input type="email" value="{{ old('email') }}" placeholder=" Email Address" name="email"
                            class="input-space  @error('email') error @enderror" />

                        @error('email')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-holder">
                        <button class="btn">Register</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="breadcrumbs">
            <a href="dashboard.html" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="users.html" class="bread-link active">Admin-Users</a>
        </div>
        <h1 class="page-title">Admin-Users</h1>
        <a id="trigger" class="btn-new-pop">New Admin</a>

        <div class="dash-row">
            @if (count($users))
            @foreach ($users as $user)
            <div class="person-card">
                <div class="person-image-holder">
                    <img src="./images/logo_png.png" alt="" class="person-image" />
                </div>
                <div class="person-info" style="height: auto;justify-content:center">
                    <p class="person-name">{{ $user->firstname }} {{ $user->lastname }}</p>
                    {{-- <p class="person-department">Physics and Atomic Principles</p> --}}
                    <p class="person-email"><a>{{ $user->email }}</a></p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    {{-- <div class="dash-col user-pop-info" id="user_pop_info">
        <div class="user-pop-close" id="user_pop_close">
            <div class="user-pop-close-glow"></div>
        </div>
    </div> --}}
</div>
<script src="./js/popup-click.js"></script>
@endsection