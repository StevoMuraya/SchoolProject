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
        <h1 class="page-title">{{ $unit->unit_code }} Lecturers</h1>

        @if (session('status'))
        <div class="login-session-message" style="background-color: #c92727;font-size:0.8em;color:white;">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('units-assign.store') }}" method="post" enctype="multipart/form-data"
            class="form-action">
            @csrf
            <div class="search-holder">
                <input type="text" name="unit_id" value="{{ $unit->unit_id }}" style="display:none;" />
                <input type="text" list="html_elements" class="search-input" placeholder="Lec Name/ Number"
                    name="lec_code" />
                <datalist id="html_elements">
                    @if (count($lecturers))
                    @foreach ($lecturers as $lecturer)
                    <option value="{{ $lecturer->lec_code }}">
                        {{ $lecturer->lec_firstname }} {{ $lecturer->lec_lastname }} {{ $lecturer->lec_code }}
                    </option>
                    @endforeach
                    @endif
                </datalist>
                <button class="search-btn">ADD TO UNIT</button>
            </div>
            @error('lec_code')
            <p class="input-error" style="width:100%;padding:0 0 0 1em;">{{ $message }}</p>
            @enderror
        </form>
        <div class="dash-row">
            @if (count($unit->units_unit_relation))
            @foreach ($unit->units_unit_relation as $i => $unit_lec)
            <div class="unit-card">
                <div class="unit-info">
                    <p>
                        <span>Lec Name: <br /></span>
                        <span>
                            {{ $unit_lec->unit_lectuer_relation->lec_firstname }}
                            {{ $unit_lec->unit_lectuer_relation->lec_lastname }}
                        </span>
                    </p>
                </div>
                <div class="unit-info">
                    <p>
                        <span>Lec Code: <br /></span>
                        <span>
                            {{$unit_lec->unit_lectuer_relation->lec_code }}
                        </span>
                    </p>
                </div>
                <form action="{{ route('units-assign.destroy',$unit_lec->id) }}" method="post" class="form-action"
                    style="flex: 1">
                    @method('DELETE')
                    @csrf
                    <button class="unit-option" onclick="return confirm('Are you sure?')"
                        style="background-color: #c42323;border:none;cursor:pointer;">Remove
                        Lecturer</button>
                </form>
                {{-- <a href="" class="unit-option">Remove Lecturer</a> --}}
                <div class="unit-info" style="display: none">{{ $unit->unit_id }}</div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@endsection