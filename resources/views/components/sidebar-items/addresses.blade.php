<li class="nav-item dropdown">
    <div class="accordion-address">
        <a class="nav-link dropdown-toggle {{ Request::is('address*') || Request::is('rgi*')
         ? 'active' : null }}" href="#"
           data-toggle="collapse" data-target="#dropdown-address" aria-expanded="true">
            <i class="fas fa-address-card"></i> <span class="label">{{  __('addresses/views.addresses') }}</span>
        </a>
        <div id="dropdown-address" class="submenu-items collapse {{ Request::is('address*') || Request::is('rgi*')
         ? 'show' : null }}">
            <a class="nav-link {{ Request::is('address*') ? 'active' : null }}"
               href="{{ route('addresses.index') }}">
                <i class="fas fa-address-book"></i>&nbsp;&nbsp;{{ __('addresses/views.address') }}
            </a>
            <a class="nav-link  {{ Request::is('rgi*') ? 'active' : null }}"
               href="{{ route('rgi.index') }}">
                <i class="fas fa-home"></i>&nbsp;&nbsp;{{ __('rgi/views.rgi_short') }}
            </a>
        </div>
    </div>
</li>
