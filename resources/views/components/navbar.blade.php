<nav class="navbar navbar-dark bg-primary">

    <span>CDA</span>
    <a class="menu-hamburger" href="#"><i class="fas fa-list-ul"></i></a>

    <!-- Lado direito da Navbar -->
    <div class="navbar-nav ml-auto">
        <div class="nav-item" style="font-size: 20px; color: white;">
            <a class="nav-item" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt" style="color: white;"></i>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
</nav>