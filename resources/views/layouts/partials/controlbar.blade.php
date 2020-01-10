<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-2">
        <h5>
            @guest
                {{\App\Models\Guest::current()->id}}
            @elseguest
                {{Auth::user()->name}}
            @endguest
        </h5>
        @auth
            <a class="d-block" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth
    </div>
</aside>
