<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (route_name() == 'dashboard.index')?'active':'' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if(auth()->user()->level === 0)
        <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrativo
            </div>

            <li class="nav-item {{ (route_name() == 'course.index' || route_name() == 'course.edit' || route_name() == 'course.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('course.index') }}">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Cursos</span></a>
            </li>

            <li class="nav-item {{ (route_name() == 'student.index' || route_name() == 'student.edit' || route_name() == 'student.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('student.index') }}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Alunos</span></a>
            </li>

            <li class="nav-item {{ (route_name() == 'teacher.index' || route_name() == 'teacher.edit' || route_name() == 'teacher.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('teacher.index') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Professores</span></a>
            </li>
    @endif

    @if(auth()->user()->level !== 2)
        <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Professor
            </div>

            <li class="nav-item {{ (route_name() == 'subject.index' || route_name() == 'subject.edit' || route_name() == 'subject.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('subject.index') }}">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Disciplina</span></a>
            </li>

            <li class="nav-item {{ (route_name() == 'task.index' || route_name() == 'task.edit' || route_name() == 'task.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('task.index') }}">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Atividades</span></a>
            </li>

            <li class="nav-item {{ (route_name() == 'grades.index' || route_name() == 'grades.edit' || route_name() == 'grades.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('grades.index') }}">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Notas</span></a>
            </li>

    @endif

    @if(auth()->user()->level == 2)
        <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Aluno
            </div>

            <li class="nav-item {{ (route_name() == 'enrollment.index' || route_name() == 'enrollment.edit' || route_name() == 'enrollment.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('enrollment.index') }}">
                    <i class="fas fa-fw fa-school"></i>
                    <span>Matricula</span></a>
            </li>

            <li class="nav-item {{ (route_name() == 'grades.index' || route_name() == 'grades.edit' || route_name() == 'grades.create')?'active':'' }}">
                <a class="nav-link" href="{{ route('grades.index') }}">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Notas</span></a>
            </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
