@extends('format')

@section('content-holder')

<div class="dash-split">
    <div class="dash-col content" id="data_col_content">
        <div class="breadcrumbs">
            <a href="dashboard.html" class="bread-link">Dashboard</a>
        </div>
        <h1 class="page-title">Dashboard</h1>

        <div class="dash-row">
            <div class="top-card">
                <div class="top-card-text">
                    <h4>Lecturers</h4>
                    <h2>{{ count($lecturers) }}+</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
            <div class="top-card">
                <div class="top-card-text">
                    <h4>Students</h4>
                    <h2>{{ count($students) }}+</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
            <div class="top-card">
                <div class="top-card-text">
                    <h4>Units</h4>
                    <h2>{{ count($units) }}+</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-school"></i>
                </div>
            </div>
            {{-- <div class="top-card">
                <div class="top-card-text">
                    <h4>Interactions</h4>
                    <h2>10000+</h2>
                </div>
                <div class="top-card-image">
                    <i class="fas fa-people-arrows"></i>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<script src="./js/main.js"></script>
@endsection