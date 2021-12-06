@extends('format')

@section('content-holder')

<div class="dash-split">
    <div class="dash-col content" id="data_col_content">
        <div class="register-popup 
        @error('firstname') show @enderror  
        @error('lastname') show @enderror
        @error('email') show @enderror
        @error('phone') show @enderror
        @error('stud_code') show @enderror
        @error('department') show @enderror" id="register_popup">
            <div class="reg-popup-container">
                <div class="close-reg-pop" id="close_reg_pop"></div>
                <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data"
                    class="form-action pop-up">
                    @csrf
                    <h2 class="new-lec-title">New Student Registration</h2>
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
                        <input type="text" value="{{ old('stud_code') }}" placeholder=" Student's Reg No."
                            name="stud_code" class="input-space  @error('stud_code') error @enderror" />

                        @error('stud_code')
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
            <a href="{{ route('students.index') }}" class="bread-link active">Students</a>
        </div>
        <h1 class="page-title">Students</h1>
        <a id="trigger" class="btn-new-pop">New Student</a>
        <div class="search-holder">
            <input type="text" id="search_input" onkeyup="myFunction()" placeholder=" Search Student"
                class="search-input" />
            <button class="search-btn" onclick="myFunction()">Search</button>
        </div>
        <div class="dash-row">
            @if (count($students))
            @foreach ($students as $student)
            <div class="person-card" onclick="document.location='{{ route('students.show',$student->student_id) }}'">
                <div class="person-info">
                    <p class="person-name">{{ $student->student_firstname }} {{ $student->student_lastname }}</p>
                    <p class="person-email"><a>{{ $student->student_email }}</a></p>
                    <p class="person-id">{{ $student->student_regNo }}</p>
                    <p class="person-department">{{ $student->student_phone }}</p>
                </div>
            </div>
            @endforeach
            @endif
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
<script src="./js/popup-click.js"></script>
@endsection