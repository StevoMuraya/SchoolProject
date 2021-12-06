@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('students.index') }}" class="bread-link active">Attendance-Analysis</a>
        </div>
        <h1 class="page-title">
            {{-- {{ $student->student_firstname }}
            {{ $student->student_lastname }} Analysis --}}
        </h1>

        <div class="dash-row">
            <div class="search-holder">
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Year"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>
            @if (count($class_years))
            <div class="class-year-holder">
                @foreach ($class_years as $class_year)
                <div class="class-year-date">
                    <h3 class="class-year-prev">{{ $class_year->class_year }}</h3>
                    <div class="dash-row">
                        <?php
                        $class_sems=Illuminate\Support\Facades\DB::table('classes')
                        ->select(DB::raw('class_sem'))
                        ->where('class_year', '=', $class_year->class_year)
                        ->orderBy('class_sem')
                        ->groupBy('class_sem')
                        ->get()
                        ?>
                        @foreach ($class_sems as $class_sem)
                        <div class="class-card"
                            onclick="document.location='{{ route('attendance-analysis-pick',['class_year'=>$class_year->class_year,'class_sem'=>$class_sem->class_sem]) }}'">
                            <div class="unit-text bold">
                                {{ $class_sem->class_sem }}{{
                                date('S',mktime(1,1,1,1,(
                                (($class_sem->class_sem>=10)+($class_sem->class_sem>=20)+($class_sem->class_sem==0))*10
                                +
                                $class_sem->class_sem%10)))
                                }}
                                Semester
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <script>
        function myFunction() {
        var input = document.getElementById("search_input");
        var filter = input.value.toLowerCase();
        // var data_holder = document.getElementById("teachers-list-holder");
        var nodes = document.getElementsByClassName("class-year-date");
        var nodes_inner = document.getElementsByClassName("class-year-prev");

        for (i = 0; i < nodes.length; i++) {
            node2 =nodes[i].getElementsByClassName("class-year-prev")[0].innerText;
            console.log(node2);
          if (nodes[i].getElementsByClassName("class-year-prev")[0].innerText.toLowerCase().includes(filter)) {
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