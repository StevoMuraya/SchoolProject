@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('students.index') }}" class="bread-link">Students</a>
            <i class="fas fa-chevron-right"></i>
            <a href="" class="bread-link active">
                {{ $student->student_firstname }}
                {{ $student->student_lastname }}
            </a>
        </div>
        <h1 class="page-title">
            {{ $student->student_firstname }}
            {{ $student->student_lastname }} Analysis</h1>

        <div class="dash-row">
            <div class="search-holder">
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>
            @if (count($student->students_unit_students_relation))
            @foreach ($student->students_unit_students_relation as $i => $unit_students)
            <div class="class-card">
                <div class="unit-text">{{
                    $unit_students->unit_students_class_relation->classes_unit_relation->unit_code }}
                </div>
                <div class="unit-text bold">{{
                    $unit_students->unit_students_class_relation->classes_unit_relation->unit_name }}
                </div>
                <div class="unit-text">
                    Out of {{
                    count($unit_students->unit_students_class_relation->classes_relation) }}
                    {{ Str::plural('class', count($unit_students->unit_students_class_relation->classes_relation)) }}
                    {{ $student->student_firstname }}
                </div>

                <?php $attendance_count = 0; ?>

                @foreach ($unit_students->unit_students_class_relation->classes_relation as $i => $present)

                @foreach ($present->class_held_attendance_relation as $j => $presents)
                @if ($presents->student_id==$student->student_id)
                <?php $attendance_count++;?>
                @endif
                @endforeach
                @endforeach
                <div class="unit-text">
                    Attended {{ $attendance_count }} {{ Str::plural('class', $attendance_count) }}
                </div>
                <?php
                        $classes_held = count($unit_students->unit_students_class_relation->classes_relation);
                        $classes_attended = $attendance_count;

                        $percent =  ($classes_attended/$classes_held)*100;
                        $percent = number_format((float)$percent, 2, '.', '');
                    ?>

                <div class="unit-text bold" style="margin-top: 0.5em;color:#00a858;">
                    Attendance <br />
                    {{ $percent }}%
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <script>
        function myFunction() {
        var input = document.getElementById("search_input");
        var filter = input.value.toLowerCase();
        // var data_holder = document.getElementById("teachers-list-holder");
        var nodes = document.getElementsByClassName("class-card");

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