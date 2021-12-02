@extends('format')

@section('content-holder')
<div class="dash-split">
    <div class="dash-col content" id="data_col_content">

        <div class="breadcrumbs">
            <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('units.index') }}" class="bread-link">Units</a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('units-analysis.show',$class->classes_unit_relation->unit_id) }}" class="bread-link">
                {{ $class->classes_unit_relation->unit_code }}
            </a>
            <i class="fas fa-chevron-right"></i>
            <a class="bread-link active">
                {{ $class->classes_unit_relation->unit_name }}
                (
                {{ $class->classes_lecturer_relation->lec_firstname }}
                {{ $class->classes_lecturer_relation->lec_lastname }}
                )
            </a>
        </div>
        <h1 class="page-title">
            {{ $class->classes_unit_relation->unit_code }}
            {{ $class->classes_unit_relation->unit_name }}
            (
            {{ $class->classes_lecturer_relation->lec_firstname }}
            {{ $class->classes_lecturer_relation->lec_lastname }}
            ) Analysis</h1>

        <div class="dash-row">
            <form action="" method="post" class="form-action">
                <div class="search-holder">
                    <input type="text" placeholder="Search class" class="search-input" />
                    <button class="search-btn">Search</button>
                </div>
            </form>
            @if (count($class->classes_relation))
            @foreach ($class->classes_relation as $i => $unit_class)
            <div class="class-card"
                onclick="document.location='{{ route('classroom-analysis.show',$unit_class->id) }}'">
                <div class="unit-text bold">{{ Carbon\Carbon::parse($unit_class->class_start)->format('jS F
                    Y') }}</div>
                <div class="unit-text bold">{{ Carbon\Carbon::parse($unit_class->class_start)->format('g:i a') }}</div>
                <div class="unit-text"> {{ $class->classes_unit_relation->unit_code }}</div>
                <div class="unit-text"> {{ $class->created_at }}</div>
                <div class="unit-text" style="margin-top: 0.5em;font-style">
                    {{ count($unit_class->class_held_attendance_relation) }}
                    out of {{count($class->students_unit_students_relation) }}
                    {{ Str::plural('student',count($class->students_unit_students_relation)) }}
                    were present
                </div>
                <?php
                        $students_present = count($unit_class->class_held_attendance_relation);
                        $total_students = count($class->students_unit_students_relation);
                        $percent  = "No students";
                        if ($total_students!=0||$total_students!=null) {
                            $percent =  ($students_present/$total_students)*100;
                            $percent = ("Attendance".PHP_EOL .number_format((float)$percent, 2, '.', '')."%".PHP_EOL);
                        }
                    ?>

                <div class="unit-text bold" style="color:#00a858;">
                    {{ $percent }}
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection