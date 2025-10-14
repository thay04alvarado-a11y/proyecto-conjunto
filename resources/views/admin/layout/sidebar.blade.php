<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <!-- <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" /> -->
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">DIGALES - ADMIN</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                    </ul>
                </li>
                
                <li class="nav-header">NOTICIAS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>Noticias</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('noticias') }}" class="nav-link">
                                <i class="nav-icon bi bi-list"></i>
                                <p>Listas Noticias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('noticias-form') }}" class="nav-link">
                                <i class="nav-icon bi bi-newspaper"></i>
                                <p>Crear Noticia</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-header">SITIO WEB</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Sitio Web</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('website-form') }}" class="nav-link">
                                <i class="nav-icon bi bi-house"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('website-form') }}" class="nav-link">
                                <i class="nav-icon bi bi-newspaper"></i>
                                <p>Noticias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('website-form') }}" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Quienes Somos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-header">CONFIGURACIONES</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person"></i>
                        <p>Usuarios</p>
                        <i class="nav-arrow bi bi-chevron-right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('usuarios') }}" class="nav-link">
                                <i class="nav-icon bi bi-list"></i>
                                <p>Listas de Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('usuarios-form') }}" class="nav-link">
                                <i class="nav-icon bi bi-person-plus"></i>
                                <p>Crear Usuario</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>