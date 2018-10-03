<nav class="bg-primary sidebar">
    <div class="sidebar-sticky">
        <div id="toggle-menu">
            <span class="fa fa-angle-left"></span>
            <span class="fa fa-angle-right"></span>
        </div>
        <ul class="nav flex-column">
            @include('components.sidebar-items.products')
            <li class="nav-item">
                <a class="nav-link" href="">
                    <span class="fas fa-shopping-cart"></span> <span class="label">Produtos</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
