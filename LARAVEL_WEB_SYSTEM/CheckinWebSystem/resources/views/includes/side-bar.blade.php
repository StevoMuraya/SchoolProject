<div class="side-nav" id="side_nav">
    <div class="top-logo">
        <h2 class="top-logo-title">
            KENYATTA UNIVERSITY<br />Checkin System
        </h2>
    </div>
    <div class="line-div"></div>
    <div class="side-lists-holder">
        <ul class="side-lists">
            <li class="side-list">
                <a href="{{ route('dashboard.index') }}" class="side-link @if ($active == 'dashboard') active @endif">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            <li class="side-list">
                <a href="{{ route('lecturers.index') }}" class="side-link @if ($active == 'lecturers') active @endif">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Lecturers
                </a>
            </li>
            <li class="side-list">
                <a href="{{ route('units.index') }}" class="side-link @if ($active == 'units') active @endif">
                    <i class="fas fa-school"></i>
                    Units
                </a>
            </li>
            <li class="side-list">
                <a href="{{ route('students.index') }}" class="side-link @if ($active == 'students') active @endif">
                    <i class="fas fa-user-friends"></i>
                    Students
                </a>
            </li>
            <li class="side-list">
                <a class="side-link" id="data_dropdown">
                    <i class="fas fa-chart-line"></i>
                    Data &amp; Summaries
                    <i class="fas fa-chevron-right chevy"></i>
                </a>
                <ul class="dropdown-lists" id="data_droppeddown">
                    <li class="dropdown-list">
                        <a href="" class="dropdown-link">Link 1</a>
                    </li>
                    <li class="dropdown-list">
                        <a href="" class="dropdown-link">Logs</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="side-list">
                <a href="" class="side-link @if ($active == 'help-support') active @endif">
                    <i class="fas fa-hands-helping"></i>
                    Help &amp; Support
                </a>
            </li> --}}
            <li class="side-list">
                <a href="{{ route('admin-users.index') }}"
                    class="side-link  @if ($active == 'admin-users') active @endif">
                    <i class="fas fa-lock"></i>
                    Admin-Users
                </a>
            </li>
        </ul>
        <ul class="side-lists">
            <li class="side-list">
                <form action="{{ route('logout') }}" method="post" class="form-action">
                    @csrf
                    <button class="side-link logout" style="border: none;cursor: pointer;">
                        <i class="fas fa-hands-helping"></i>
                        Logout
                    </button>
                </form>
                {{-- <a href="{{ route('logout') }}" class="side-link logout">
                    Logout
                </a> --}}
            </li>
        </ul>
    </div>
</div>