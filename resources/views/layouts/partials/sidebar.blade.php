<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/images/logo.jpg')}}" alt="Eam.Watch Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Eam.Watch</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="nav-icon fas fa-user"></i>
            </div>
            <div class="info">
                <a class="text-sm-center" href="#" style="word-break-wrap:break-word">
                    @auth
                        {{Auth::user()->name}}
                    @else
                        Guest
                    @endauth
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ name: 'message-listing'}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Message Listing</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ name: 'message-add'}">
                        <i class="nav-icon fas fa-plus-square"></i>
                        <p>Add Message</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ name: 'skyking-listing'}">
                        <i class="nav-icon fas fa-fighter-jet"></i>
                        <p>Skyking Messages</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link tag="a" class="nav-link" :to="{ name: 'message-listing'}">
                        <i class="nav-icon fas fa-microphone-alt"></i>
                        <p>Automated Recordings</p>
                    </router-link>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Logout</p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="nav-icon fas fa-key"></i>
                            <p>Login</p>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
