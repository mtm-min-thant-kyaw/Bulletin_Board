<nav class="navbar navbar-expand-lg bg-body-tertiary my-2 sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" disabled>Bulletin_Board</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('user.userlist') }}">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active" href="{{ route('post.postlist') }}">Posts</a>
                </li>

            </ul>
            <ul class="navbar-nav me-5">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.userCreatePage') }}">Create User</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                        <small class="text-success">{{ Auth::user()->type == 0 ? '(Admin)' : '(User)' }}</small>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('user.profilePage') }}">Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
