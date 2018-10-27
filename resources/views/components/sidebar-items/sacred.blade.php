<li class="nav-item dropdown">
    <div class="accordion-sacred">
        <a class="nav-link dropdown-toggle {{ Request::is('dioceses*') || Request::is('foranias*') ? 'active' : null }}" href="#"
           data-toggle="collapse" data-target="#dropdown-sacred" aria-expanded="true">
            <i class="fas fa-cross"></i> <span class="label">{{  __('validation.attributes.config_sacred') }}</span>
        </a>
        <div id="dropdown-sacred" class="submenu-items collapse {{ Request::is('dioceses*') || Request::is('foranias*') ? 'show' : null }}">
            <a class="nav-link {{ Request::is('dioceses*') ? 'active' : null }}"
               href="{{ route('dioceses.index') }}">
                <i class="fas fa-place-of-worship"></i>&nbsp;&nbsp;{{ __('dioceses/views.dioceses') }}
            </a>

            <a class="nav-link {{ Request::is('foranias*') ? 'active' : null }}"
               href="{{ route('foranias.index') }}">
                <i class="fas fa-place-of-worship"></i>&nbsp;&nbsp;{{ __('foranias/views.foranias') }}
            </a>
        </div>
    </div>
</li>
