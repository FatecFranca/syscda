<li class="nav-item dropdown">
    <div class="accordion-types">
        <a class="nav-link dropdown-toggle {{ Request::is('type_people*') ? 'active' : null }}" href="#"
           data-toggle="collapse" data-target="#dropdown-types" aria-expanded="true">
            <i class="fas fa-dice"></i> <span class="label">{{  __('default/views.types') }}</span>
        </a>
        <div id="dropdown-types" class="submenu-items collapse {{ Request::is('type_people*') ? 'show' : null }}">
            <a class="nav-link {{ Request::is('type_people*') ? 'active' : null }}"
               href="{{ route('type_people.index') }}">
                <i class="fas fa-users"></i>&nbsp;&nbsp;{{ __('types/people/views.type_people') }}
            </a>
        </div>
    </div>
</li>
