@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('units.index') }}" class="bread-link">Units</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('units-analysis.show',$class_room->classes_held_classes_relation->classes_unit_relation->unit_id) }}"
                class="bread-link">
                {{ $class_room->classes_held_classes_relation->classes_unit_relation->unit_code }}
            </a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('class-analysis.show',$class_room->classes_held_classes_relation->class_id) }}"
                class="bread-link">
                {{ $class_room->classes_held_classes_relation->classes_unit_relation->unit_name }}
                (
                {{ $class_room->classes_held_classes_relation->classes_lecturer_relation->lec_firstname }}
                {{ $class_room->classes_held_classes_relation->classes_lecturer_relation->lec_lastname }}
                )
            </a>
            <i class="fas fa-chevron-right"></i>
            <a class="bread-link active">{{ Carbon\Carbon::parse($class_room->class_start)->format('jS F
                Y') }} {{ Carbon\Carbon::parse($class_room->class_start)->format('g:i a') }}</a>
        </div>
        <h1 class="page-title">
            {{ $class_room->classes_held_classes_relation->classes_unit_relation->unit_code }}
            {{ Carbon\Carbon::parse($class_room->class_start)->format('jS F Y') }}
            {{ Carbon\Carbon::parse($class_room->class_start)->format('g:i a') }}
            Analysis</h1>


        <div class="dash-row">
            <div class="search-holder">
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>
            <?php  $student_present =  array();?>
            @if (count($class_room->class_held_attendance_relation))
            @foreach ($class_room->class_held_attendance_relation as $i => $room_attendance)
            <div class="unit-card"
                onclick="document.location='{{ route('students.show',$room_attendance->attendance_students_relation->student_id) }}'">
                <div class="unit-info">{{ $room_attendance->attendance_students_relation->student_regNo }} </div>
                <div class="unit-info">

                    <?php  $student_present[] =  $room_attendance->attendance_students_relation->student_id;?>
                    {{ $room_attendance->attendance_students_relation->student_firstname }}
                    {{ $room_attendance->attendance_students_relation->student_lastname }}
                </div>
                <div class="unit-info">{{ $room_attendance->attendance_students_relation->student_regNo }} </div>
                <div class="unit-info">
                    {{ Carbon\Carbon::parse($room_attendance->scan_time)->format('g:i a') }}
                </div>
            </div>
            @endforeach

            <div class="break" style="margin:1em 0"></div>
            @foreach ($class_room->classes_held_classes_relation->students_unit_students_relation as $i =>
            $class_held_class)
            @if (!(in_array($class_held_class->unit_students_students_relation->student_id, $student_present)))
            <div class="unit-card"
                onclick="document.location='{{ route('students.show',$class_held_class->unit_students_students_relation->student_id) }}'">
                <div class="unit-info">{{ $class_held_class->unit_students_students_relation->student_regNo }} </div>
                <div class="unit-info">
                    {{ $class_held_class->unit_students_students_relation->student_firstname }}
                    {{ $class_held_class->unit_students_students_relation->student_lastname }}
                </div>
                <div class="unit-info">{{ $room_attendance->attendance_students_relation->student_regNo }} </div>
                <div class="unit-option" style="background-color: #ca1e1e">
                    Absent
                </div>
            </div>
            @endif
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