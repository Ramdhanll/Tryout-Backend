<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="{{ route('dashboard.index')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
            </li>
            <li class="menu-title">Masters</li><!-- /.menu-title -->
            <li>
                <a href="{{ route('student.index')}}"> <i class="menu-icon ti-user"></i>Student </a>
            </li>
            <li>
                <a href="{{ route('teacher.index')}}"> <i class="menu-icon ti-user"></i>Teacher </a>
            </li>
            <li>
                <a href="{{ route('exam.index')}}"> <i class="menu-icon ti-ruler-pencil"></i>Exam </a>
            </li>
            {{-- <li>
                <a href="{{ route('question.index')}}"> <i class="menu-icon ti-notepad"></i>Question </a>
            </li> --}}
            <li>
                <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="menu-icon ti-power-off"></i>Logout 
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
</aside>
<!-- /#left-panel -->