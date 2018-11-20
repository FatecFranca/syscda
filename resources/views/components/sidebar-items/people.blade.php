<li class="nav-item dropdown">
    <div class="accordion-people">
        <a class="nav-link dropdown-toggle {{ Request::is('people*') ? 'active' : null }}" href="#"
           data-toggle="collapse" data-target="#dropdown-people" aria-expanded="true">
            <i class="fas fa-users"></i> <span class="label">{{  __('default/views.people') }}</span>
        </a>
        <div id="dropdown-people" class="submenu-items collapse {{ Request::is('people*') ? 'show' : null }}">
            <a class="nav-link {{ Request::is('people*') ? 'active' : null }}"
               href="{{ route('people.index') }}">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;{{ __('people/views.people') }}
            </a>
        </div>
    </div>
</li>
