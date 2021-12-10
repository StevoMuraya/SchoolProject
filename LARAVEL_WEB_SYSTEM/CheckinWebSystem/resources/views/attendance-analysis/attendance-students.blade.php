@extends('format')

@section('content-holder')
<?php
    $sem_ordinal=date('S',mktime(1,1,1,1,(
            (($class_sem>=10)+($class_sem>=20)+($class_sem==0))*10
            +
            $class_sem%10)));

    $doc_name=$class_details->classes_unit_relation->unit_code."_".
    $class_sem."".
    $sem_ordinal."_semester_".
    $class_year."_Analysis";
?>
<div class="print-button-holder">
  <a onclick="exportTableToExcel('example','{{ $doc_name }}')" class="print-button">Generate Excel</a>
</div>
<div class="dash-split">
  <div class="dash-col content" id="data_col_content">

    <div class="breadcrumbs">
      <a href="{{ route('dashboard.index') }}" class="bread-link">Dashboard</a>
      <i class="fas fa-chevron-right"></i>
      <a href="{{ route('attendance-analysis.index') }}" class="bread-link">Attendance-Analysis</a>
      <i class="fas fa-chevron-right"></i>
      <a href="{{ route('attendance-analysis-pick',['class_year'=>$class_year,'class_sem'=>$class_sem]) }} "
        class="bread-link">
        {{ $class_year }} {{ $class_sem }}{{
        date('S',mktime(1,1,1,1,(
        (($class_sem>=10)+($class_sem>=20)+($class_sem==0))*10
        +
        $class_sem%10)))
        }}
        Semester
      </a>
      <i class="fas fa-chevron-right"></i>
      <a href="" class="bread-link active">{{ $class_details->classes_unit_relation->unit_name }}</a>
    </div>
    <h1 class="page-title">{{ $class_details->classes_unit_relation->unit_code }}
      {{ $class_sem }}{{
      date('S',mktime(1,1,1,1,(
      (($class_sem>=10)+($class_sem>=20)+($class_sem==0))*10
      +
      $class_sem%10)))
      }}
      Semester
      {{ $class_year }} Analysis</h1>

    <div class="dash-row">
      <div class="search-holder">
        <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Unit" class="search-input" />
        <button class="search-btn" onclick="myFunction()">Search</button>
      </div>

      <table class="info-list-table" id="example">
        <thead>

          <?php
                  $classes_held_top=Illuminate\Support\Facades\DB::table('classes_held')
                  ->where('class_id', '=', $class_id)
                  ->get(); 

                  $total_classes_top  =   count($classes_held_top);
          ?>
          <tr>
            <th>Name.</th>
            <th>Reg No.</th>
            <th>Classes Attended</th>
            <th>Total Classes</th>
            <th>Attendance(%)</th>
          </tr>
        </thead>

        <tbody id="myTable">
          @if (count($students_list))
          @foreach ($students_list as $student)
          <tr
            onclick="document.location='{{ route('students.show',$student->unit_students_students_relation->student_id) }}'">
            <td>
              {{ $student->unit_students_students_relation->student_firstname }}
              {{ $student->unit_students_students_relation->student_lastname }}
            </td>
            <td>
              {{ $student->unit_students_students_relation->student_regNo }}
            </td>
            <?php
                                $student_classes=Illuminate\Support\Facades\DB::table('attendance_list')
                                ->where('student_id', '=', $student->unit_students_students_relation->student_id)
                                ->where('class_id', '=', $class_id)
                                ->get()
                        ?>
            <?php
                                $classes_held=Illuminate\Support\Facades\DB::table('classes_held')
                                ->where('class_id', '=', $class_id)
                                ->get(); 

                                $total_classes  =   count($classes_held);
                                $student_classes_  =   count($student_classes);

                                $percentage =  ($student_classes_/$total_classes)*100;
                                $percentage = number_format((float)$percentage, 2, '.', '')
                        ?>
            <td>{{ $student_classes_ }}</td>
            <td>{{ $total_classes }}</td>
            <td>{{ $percentage }}%</td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <script>
    function myFunction() {
        var search, filter, found, table, tr, td, i, j;
        search = document.getElementById("search_input");
        filter = search.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td");
          for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
              found = true;
            }
          }
          if (found) {
            tr[i].style.display = "";
            found = false;
          } else {
            tr[i].style.display = "none";
          }
        }
      }

      
      function exportTableToExcel(tableID, filename) {
        var downloadLink;
        var dataType = "application/vnd.ms-excel";
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, "%20");
        // specify file name
        filename = filename ? filename + ".xls" : "excel_data.xls";
        //create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        
        if (navigator.msSaveOrOpenBlob) {
          var blob = new Blob(["\ufeff", tableHTML], {
            type: dataType,
          });
          navigator.msSaveOrOpenBlob(blob, filename);
        } else {
          //create a link to the file
          downloadLink.href = "data:" + dataType + "," + tableHTML;
          //setting the file name
          downloadLink.download = filename;
          //triggering the function
          downloadLink.click();
        }
      }
  </script>
  @endsection