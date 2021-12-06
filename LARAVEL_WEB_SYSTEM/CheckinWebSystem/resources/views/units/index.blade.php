@extends('format')

@section('content-holder')

<div class="dash-split">
    <div class="dash-col content" id="data_col_content">
        <div class="register-popup 
        @error('unit_code') show @enderror  
        @error('unit_name') show @enderror
        @error('unit_department') show @enderror" id="register_popup">
            <div class="reg-popup-container">
                <div class="close-reg-pop" id="close_reg_pop"></div>
                <form action="{{ route('units.store') }}" method="post" enctype="multipart/form-data"
                    class="form-action pop-up">
                    @csrf
                    <h2 class="new-lec-title">New Unit Registration</h2>
                    <p class="lec_subtitle">Fill out the form below to proceed</p>
                    <div class="input-holder pop-up">
                        <input type="text" placeholder="Unit code" value="{{ old('unit_code') }}" name="unit_code"
                            class="input-space  @error('unit_code') error @enderror" />

                        @error('unit_code')
                        <p class="input-error">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class=" input-holder pop-up">
                        <input type="text" placeholder="Unit name" value="{{ old('unit_name') }}" name="unit_name"
                            class="input-space  @error('unit_name') error @enderror" />

                        @error('unit_name')
                        <p class="input-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=" input-holder pop-up">
                        <input type="text" value="{{ old('unit_department') }}" placeholder="Unit department"
                            name="unit_department" class="input-space  @error('unit_department') error @enderror" />

                        @error('unit_department')
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
            <a href="units.html" class="bread-link active">Units</a>
        </div>
        <h1 class="page-title">Units Management</h1>
        <a id="trigger" class="btn-new-pop">New Unit</a>
        <div class="search-holder">
            <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                class="search-input" />
            <button class="search-btn" onclick="myFunction()">Search</button>
        </div>

        <div class="dash-row">
            @if (count($units))
            @foreach ($units as $unit)
            <div class="unit-card">
                <div id="update_link" style="display: none">http://127.0.0.1:8000/units/</div>
                <div id="analysis_link" style="display: none">http://127.0.0.1:8000/units-analysis/</div>
                <div class="unit-info">
                    <p>
                        <span>Unit Code: <br /></span>
                        <span>{{ $unit->unit_code }}</span>
                    </p>
                </div>
                <div class="unit-info">
                    <p>
                        <span>Unit Name: <br /></span>
                        <span>{{ $unit->unit_name }}</span>
                </div>
                <div class="unit-info">
                    <p>
                        <span>Unit Department: <br /></span>
                        <span>{{ $unit->unit_department }}</span>
                    </p>
                </div>
                <a href="{{ route('units-assign.show',$unit->unit_id) }}" class="unit-option">Assign Lecturers</a>
                <div class="unit-info" style="display: none">{{ $unit->unit_id }}</div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="dash-col user-pop-info 
    @error('unit_code_edit') show @enderror
    @error('unit_name_edit') show @enderror
    @error('unit_department_edit') show @enderror
    " id="user_pop_info">
        <div class="user-pop-close" id="user_pop_close">
            <div class="user-pop-close-glow"></div>
        </div>
        <div class="user-pop-fixed">
            <div class="user-pop-top">
                <div class="user-pop-top-info">
                    <p class="user-pop-name" id="user_pop_name">
                        Unit Information
                    </p>
                    <form id="update_form_action" action="" method="post" enctype="multipart/form-data"
                        class="form-action">
                        @method('PUT')
                        @csrf
                        <div class=" input-holder">
                            <input type="number" style="display: none" placeholder="Unit Code" class="input-space"
                                id="unit_id" />
                        </div>
                        <div class=" input-holder">
                            <input type="text" value="{{ old('unit_code_edit') }}" placeholder="Unit Code"
                                name="unit_code_edit" class="input-space  @error('unit_code_edit') error @enderror"
                                id="unit_code" />

                            @error('unit_code_edit')
                            <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" input-holder">
                            <input type="text" value="{{ old('unit_name_edit') }}" placeholder="Unit Name"
                                name="unit_name_edit" class="input-space  @error('unit_name_edit') error @enderror"
                                id="unit_name" />

                            @error('unit_name_edit')
                            <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" input-holder">
                            <input type="text" value="{{ old('unit_department_edit') }}" placeholder="Unit Department"
                                name="unit_department_edit"
                                class="input-space  @error('unit_department_edit') error @enderror"
                                id="unit_department" />

                            @error('unit_department_edit')
                            <p class="input-error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="popup-options-holder">
                            <button class="popup-options-link">Update</button>
                        </div>
                    </form>

                    <div class="popup-options-holder">
                        <a href="" id="unit_analysis" class="popup-options-link"
                            style="background-color: #00a858">Analysis</a>
                        <form id="delete_action" action="" method="post" class="form-action">
                            @method('DELETE')
                            @csrf
                            <button class="popup-options-link delete" onclick="return confirm('Are you sure?')"
                                style="padding:0.75em 2em">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
    var input = document.getElementById("search_input");
    var filter = input.value.toLowerCase();
    // var data_holder = document.getElementById("teachers-list-holder");
    var nodes = document.getElementsByClassName("unit-card");

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
<script src="./js/unit-click.js"></script>
<script src="./js/popup-click.js"></script>
@endsection