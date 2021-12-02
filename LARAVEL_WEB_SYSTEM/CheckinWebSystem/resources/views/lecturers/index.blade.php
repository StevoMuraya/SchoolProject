@extends('format')

@section('content-holder')

<div class="dash-split">
    <div class="dash-col content" id="data_col_content">
        <div class="register-popup 
        @error('firstname') show @enderror  
        @error('lastname') show @enderror
        @error('email') show @enderror
        @error('phone') show @enderror
        @error('lec_code') show @enderror
        @error('department') show @enderror" id="register_popup">
            <div class="reg-popup-container">
                <div class="close-reg-pop" id="close_reg_pop"></div>
                <form action="{{ route('lecturers.store') }}" method="post" enctype="multipart/form-data"
                    class="form-action pop-up">
                    @csrf
                    <h2 class="new-lec-title">New Lecturer Registration</h2>
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
                    <div class=" input-holder pop-up">
                        <input type="tel" value="{{ old('phone') }}" placeholder=" Phone" name="phone"
                            class="input-space  @error('phone') error @enderror" />

                        @error('phone')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" input-holder pop-up">
                        <input type="text" value="{{ old('lec_code') }}" placeholder=" Lecturer's No." name="lec_code"
                            class="input-space  @error('lec_code') error @enderror" />

                        @error('lec_code')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" input-holder pop-up">
                        <input type="text" value="{{ old('department') }}" placeholder=" Department Name"
                            name="department" class="input-space  @error('department') error @enderror" />

                        @error('department')
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
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('lecturers.index') }}" class="bread-link active">Lecturers</a>
        </div>
        <h1 class="page-title">Lecturers</h1>
        <a id="trigger" class="btn-new-pop">New Lecturer</a>
        <div class="search-holder">
            <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                class="search-input" />
            <button class="search-btn" onclick="myFunction()">Search</button>
        </div>
        <div class="dash-row">
            @if (count($lecturers))
            @foreach ($lecturers as $lecturer)
            <div class="person-card">
                {{-- <div class="person-image-holder">
                    <img src="./images/logo_jpg.jpg" alt="" class="person-image" />
                </div> --}}
                <div class="person-info">
                    <p class="person-name">{{ $lecturer->lec_firstname }} {{ $lecturer->lec_lastname }}</p>
                    <p class="person-email"><a>{{ $lecturer->lec_email }}</a></p>
                    <p class="person-id">{{ $lecturer->lec_code }}</p>
                    <p class="person-department">{{ $lecturer->department }}</p>
                    <p class="person-phone">{{ $lecturer->lec_phone }}</p>
                    <div class="user-pop-units-holder">
                        @foreach ($lecturer->lecturer_unit_relation as $i => $unit_lec)
                        <div class="unit-pop-holder"
                            onclick="document.location='{{ route('units-analysis.show',$unit_lec->unit_units_relation->unit_id) }}'">
                            <p>{{ $unit_lec->unit_units_relation->unit_code }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="dash-col user-pop-info" id="user_pop_info">
        <div class="user-pop-close" id="user_pop_close">
            <div class="user-pop-close-glow"></div>
        </div>
        <div class="user-pop-fixed">
            <div class="user-pop-top">
                <div class="user-pop-image-holder">
                    <img src="./images/logo_png.png" alt="" id="user_pop_image" class="user-pop-image" />
                </div>
                <div class="user-pop-top-info">
                    <p class="user-pop-name" id="user_pop_name">John Doe</p>
                    <p class="user-pop-id">Kenyatta University</p>
                    <p class="user-pop-department" id="user_pop_department">
                        Computing &amp; Information Technology
                    </p>
                    <p class="user-pop-id" id="user_pop_id">JKB/243/1E/10983</p>
                </div>
            </div>

            <div class="grey-line"></div>

            <p class="user-pop-mini-title">Contact Information</p>
            <div class="user-pop-row">
                <div class="user-pop-col">
                    <p class="head">Email:</p>
                </div>
                <div class="user-pop-col">
                    <p class="text" id="user_pop_email">somebody@gmail.com</p>
                </div>
            </div>

            <div class="user-pop-row">
                <div class="user-pop-col">
                    <p class="head">Phone:</p>
                </div>
                <div class="user-pop-col">
                    <p class="text" id="user_pop_phone">0712345678</p>
                </div>
            </div>
            {{-- <div class="btn-holder">
                <a href="" class="btn edit">Edit</a>
            </div> --}}
        </div>
    </div>
</div>
<script>
    function myFunction() {
    var input = document.getElementById("search_input");
    var filter = input.value.toLowerCase();
    // var data_holder = document.getElementById("teachers-list-holder");
    var nodes = document.getElementsByClassName("person-card");

    for (i = 0; i < nodes.length; i++) {
      if (nodes[i].innerText.toLowerCase().includes(filter)) {
        nodes[i].style.height = "auto";
        nodes[i].style.display = "flex";
        nodes[i].style.opacity = "1";
        nodes[i].style.pointerEvents = "all";
      } else {
        nodes[i].style.height = "0";
        nodes[i].style.opacity = "0";
        nodes[i].style.display = "none";
        nodes[i].style.pointerEvents = "none";
      }
    }
  }
</script>
<script src="./js/person-click.js"></script>
<script src="./js/popup-click.js"></script>
@endsection