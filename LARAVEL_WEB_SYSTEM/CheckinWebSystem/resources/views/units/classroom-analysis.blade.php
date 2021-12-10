@extends('format')

@section('content-holder')
<?php
    $doc_name=
    $class_room->classes_held_classes_relation->classes_unit_relation->unit_code."_".
    $class_room->classes_held_classes_relation->classes_unit_relation->unit_name."_".
    Carbon\Carbon::parse($class_room->class_start)->format('jS F Y')."_Analysis";
?>
<div class="print-button-holder">
    <a onclick="exportTableToExcel('example','{{ $doc_name }}')" class="print-button">Generate Excel</a>
</div>
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
                <input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search Student"
                    class="search-input" />
                <button class="search-btn" onclick="myFunction()">Search</button>
            </div>

            <table class="info-list-table" id="example">
                <thead>
                    <tr>
                        <th>Student Reg No.</th>
                        <th>Student Name</th>
                        <th>Time Scanned</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    <?php  $student_present =  array();?>
                    @if (count($class_room->class_held_attendance_relation))
                    @foreach ($class_room->class_held_attendance_relation as $i => $room_attendance)
                    <tr
                        onclick="document.location='{{ route('students.show',$room_attendance->attendance_students_relation->student_id) }}'">
                        <td>
                            {{ $room_attendance->attendance_students_relation->student_regNo }}
                        </td>
                        <td>
                            <?php  $student_present[] =  $room_attendance->attendance_students_relation->student_id;?>
                            {{ $room_attendance->attendance_students_relation->student_firstname }}
                            {{ $room_attendance->attendance_students_relation->student_lastname }}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($room_attendance->scan_time)->format('g:i a') }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
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