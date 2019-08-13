<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">BuildTools</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item @if(Request::segment(1) == 'user') active @endif">
                <a class="nav-link" href="{{ route('user.index') }}">User</a>
            </li>
            <li class="nav-item @if(Request::segment(1) == 'task') active @endif">
                <a class="nav-link" href="{{ route('task.index') }}">Task</a>
            </li>
        </ul>
    </div>
</nav>
