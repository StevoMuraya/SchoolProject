@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('attendance-analysis.index') }}" class="bread-link">Attendance-Analysis</a>
            <i class="fas fa-chevron-right"></i>
            <a href="" class="bread-link active">
                {{ $class_year }} {{ $class_sem }}{{
                date('S',mktime(1,1,1,1,(
                (($class_sem>=10)+($class_sem>=20)+($class_sem==0))*10
                +
                $class_sem%10)))
                }}
                Semester
            </a>
        </div>
        <h1 class="page-title">{{ $class_sem }}{{
            date('S',mktime(1,1,1,1,(
            (($class_sem>=10)+($class_sem>=20)+($class_sem==0))*10
            +
            $class_sem%10)))
            }}
            Semester
            {{ $class_year }} Analysis</h1>

        <div class="dash-row">
            <div class="search-holder">
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>
            @if (count($classes))
            @foreach ($classes as $class)
            <div class="class-card"
                onclick="document.location='{{ route('class-attendance-analysis',['class_year'=>$class_year,'class_sem'=>$class_sem,'class_id'=>$class->class_id]) }}'">
                <div class="unit-text">
                    {{ $class->classes_unit_relation->unit_code }}
                </div>
                <div class="unit-text bold">
                    {{ $class->classes_unit_relation->unit_name }}
                </div>
                <div class="unit-text" style="margin-top: 0.5em">
                    {{ $class->classes_lecturer_relation->lec_firstname }}
                    {{ $class->classes_lecturer_relation->lec_lastname }}
                </div>
                <div class="unit-text" style="margin-top: 0.5em">
                    <b>{{ count($class->students_unit_students_relation) }}</b> students registered in class
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