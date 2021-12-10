@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('units.index') }}" class="bread-link">Units</a>
            <i class="fas fa-chevron-right"></i>
            <a class="bread-link active">{{ $unit->unit_code }}</a>
        </div>
        <h1 class="page-title">{{ $unit->unit_code }} {{ $unit->unit_name }} Analysis</h1>

        <div class="dash-row">
            <div class="top-card">
                <div class="top-card-text">
                    <h4>Classes</h4>
                    <h2>{{ count($unit->unit_classes_relation) }}</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-school"></i>
                </div>
            </div>
            <div class="top-card">
                <div class="top-card-text">
                    <?php $student_taken = 0;?>
                    <h4>Students Undertaken</h4>
                    @foreach ($unit->unit_classes_relation as $i => $unit_classs)

                    @foreach ($unit_classs->students_unit_students_relation as $i => $unit_class_s)
                    <?php $student_taken++;?>
                    @endforeach
                    @endforeach
                    <h2>{{ $student_taken}}</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
            <div class="top-card">
                <div class="top-card-text">
                    <h4>Lecturers in unit</h4>
                    <h2>{{ count($unit->units_unit_relation) }}</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>

        <div class="dash-row">
            <div class="search-holder">
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>
            @if (count($unit->unit_classes_relation))
            @foreach ($unit->unit_classes_relation as $i => $unit_class)
            <div class="unit-card">
                <div class="unit-info" style="flex: 3;">
                    <p>
                        <span>Date Created: <br /></span>
                        {{ Carbon\Carbon::parse($unit_class->created_at)->format('jS F
                        Y') }}
                    </p>
                </div>
                <div class="unit-info" style="flex: 3;">
                    <p>
                        <span>Semester: <br /></span>
                        {{ $unit_class->class_sem }}{{
                        date('S',mktime(1,1,1,1,(
                        (($unit_class->class_sem>=10)+($unit_class->class_sem>=20)+($unit_class->class_sem==0))*10 +
                        $unit_class->class_sem%10)))
                        }}
                        Semester
                    </p>
                </div>
                <div class="unit-info" style="flex: 3;">
                    <p>
                        <span>Lecturer name: <br /></span>
                        {{ $unit_class->classes_lecturer_relation->lec_firstname }}
                        {{ $unit_class->classes_lecturer_relation->lec_lastname }}
                    </p>
                </div>
                <div class="unit-info" style="flex: 3;">
                    <p>
                        <span>Total Classes: <br /></span>
                        {{ count($unit_class->classes_relation) }}
                        {{ Str::plural('lecture', count($unit_class->classes_relation)) }}
                    </p>
                </div>
                <a href="{{ route('class-analysis.show',$unit_class->class_id) }}" class="unit-option">View</a>
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
@endsection