<li class="nav-item dropdown">
    <div class="accordion-family">
        <a style="padding-left: 0.7rem;" class="nav-link dropdown-toggle {{ Request::is('family_settings*') ? 'active' : null }}" href="#"
           data-toggle="collapse" data-target="#dropdown-family" aria-expanded="true">
            <svg style="width:24px;height:24px;" viewBox="0 0 24 24">
                <path fill="{{ Request::is('family_settings*') ? '#ffc107' : '#fff' }}" d="M2,12L12,3L22,12H19V20H5V12H2M12,18L12.72,17.34C15.3,15 17,13.46 17,11.57C17,10.03 15.79,8.82 14.25,8.82C13.38,8.82 12.55,9.23 12,9.87C11.45,9.23 10.62,8.82 9.75,8.82C8.21,8.82 7,10.03 7,11.57C7,13.46 8.7,15 11.28,17.34L12,18Z" />
            </svg> <span class="label">{{  __('family_settings/views.family') }}</span>
        </a>
        <div id="dropdown-family" class="submenu-items collapse {{ Request::is('family_settings*') ? 'show' : null }}">
            <a class="nav-link {{ Request::is('family_settings*') ? 'active' : null }}"
               href="{{ route('family_settings.index') }}">
                    <i class="fas fa-user"></i>&nbsp;&nbsp;{{ __('family_settings/views.family_setting_short') }}
            </a>
        </div>
    </div>
</li>
