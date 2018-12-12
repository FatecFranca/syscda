<nav class="bg-primary sidebar">
    <div class="sidebar-sticky">
        <div id="toggle-menu">
            <span class="fa fa-angle-left"></span>
            <span class="fa fa-angle-right"></span>
        </div>
        <ul class="nav flex-column">
            @include('components.sidebar-items.addresses')
            @include('components.sidebar-items.sacred')
            @include('components.sidebar-items.family')
            @include('components.sidebar-items.people')
            @include('components.sidebar-items.types')
        </ul>
    </div>
</nav>
