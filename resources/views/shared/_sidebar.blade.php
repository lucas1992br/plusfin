<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <x-sidebar-item :href="route('dashboard.index')" :active="request()->routeIs('dashboard')">
        <i class="fas fa-fw fa-chart-pie"></i>
        <span>Home</span>
    </x-sidebar-item>

   

    <x-sidebar-item :href="route('clientes')" :active="request()->routeIs('clientes')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Clientes</span>
    </x-sidebar-item>

    <x-sidebar-item :href="route('entradas.index')" :active="request()->routeIs('entradas')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Entradas</span>
    </x-sidebar-item>

    <x-sidebar-item :href="route('saidas.index')" :active="request()->routeIs('saidas')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Saidas</span>
    </x-sidebar-item>

   
    <!--
    <x-sidebar-item :href="route('centro-de-custo.index')" :active="request()->routeIs('centro-de-custo')">
        <i class="fas fa-fw fa-door-closed"></i>
        <span>Centro de custo</span>
    </x-sidebar-item>

    <x-sidebar-item :href="route('forma-pagamento.index')" :active="request()->routeIs('forma-pagamento')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Forma de Pagamento</span>
    </x-sidebar-item>

    <x-sidebar-item :href="route('fonte-pagante.index')" :active="request()->routeIs('fonte-pagante')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Fonte Pagante</span>
    </x-sidebar-item>

    <x-sidebar-item :href="route('origem.index')" :active="request()->routeIs('origem')">
        <i class="fas fa-fw fa-user-alt"></i>
        <span>Origem</span>
    </x-sidebar-item>
    -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#gerenciamento"
            aria-expanded="true" aria-controls="gerenciamento">
            <i class="fas fa-fw fa-cog"></i>
            <span>Gerenciamento</span>
        </a>
        <div id="gerenciamento" class="collapse" aria-labelledby="gerenciamento" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="text-light collapse-item" href="{{route('atualizar-saidas.index')}}">Atualizar Saidas</a>
            </div>
        </div>

        <div id="gerenciamento" class="collapse" aria-labelledby="gerenciamento" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('aprovar-saidas.index') }}">Aprovar Saidas</a>
            </div>
        </div>

        <div id="gerenciamento" class="collapse" aria-labelledby="gerenciamento" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('envio-documentos.index') }}">Envio de Documentos</a>
            </div>
        </div>

        <div id="gerenciamento" class="collapse" aria-labelledby="gerenciamento" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('pagamento-saidas.index') }}">Pagamento Saidas</a>
            </div>
        </div>
        <div id="gerenciamento" class="collapse" aria-labelledby="gerenciamento" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('entradas-documentos.index') }}">Efetivar Entradas</a>
            </div>
        </div>   
    </li>

    <!-- Divider --> <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Configurações
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Cadastros</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('atividade.index')}}">Atividades</a>
            </div>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{ route('centro-de-custo.index') }}">Centro de Custo</a>
            </div>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('origem.index')}}">Origem</a>
            </div>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('fonte-pagante.index')}}">Fonte Pagante</a>
            </div>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner rounded">
                <a class="collapse-item text-light" href="{{route('forma-pagamento.index')}}">Forma de Pagamento</a>
            </div>
        </div>
    </li>

    

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none">

    <!-- Heading -->
    <div class="sidebar-heading d-none">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item d-none">
        <a class="nav-link" href="cpr/charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item d-none">
        <a class="nav-link" href="cpr/tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none">

    <!-- Sidebar Toggler (Sidebar) 
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> -->

    <!-- Sidebar Message -->
    {{-- <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
<!-- End of Sidebar -->
