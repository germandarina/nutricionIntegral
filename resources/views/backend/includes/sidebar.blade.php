<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('admin/*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{active_class(Active::checkUriPattern('admin/*')) }}" href="#">
                        <i class="nav-icon fas fa-list"></i> Administración
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/patient'))}}" href="{{ route('admin.patient.index') }}">
                                Pacientes
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/recipe'))}}" href="{{ route('admin.recipe.index') }}">
                                Recetas
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/recipe'))}}" href="{{ route('admin.recipe.indexEdit') }}">
                                Recetas Editadas en Planes
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/plan'))}}" href="{{ route('admin.plan.index') }}">
                                Planes
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('config/*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{active_class(Active::checkUriPattern('config/*')) }}" href="#">
                        <i class="nav-icon fas fa-cogs"></i> Configuración
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('config/food-group'))}}" href="{{ route('config.food-group.index') }}">
                                Grupos de Alimentos
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('config/food'))}}" href="{{ route('config.food.index') }}">
                                Alimentos
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('config/classification'))}}" href="{{ route('config.classification.index') }}">
                                Clasificaciones
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('config/observation'))}}" href="{{ route('config.observation.index') }}">
                                Observaciones de Recetas
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('config/basic-informatión'))}}" href="{{ route('config.basic-information.index') }}">
                                Información Personal
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('info/*'), 'open')}} ">
                    <a class="nav-link nav-dropdown-toggle {{active_class(Active::checkUriPattern('info/*')) }}" href="#">
                        <i class="nav-icon fas fa-info-circle"></i> Manual & Info
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('info.downloadManual') }}">
                                <i class="fas fa-file-word"></i> Descargar Manual
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://www.youtube.com/watch?v=2ThPOm8MCcs&feature=youtu.be">
                                <i style="color: white;" class="fab fa-youtube"></i> Como Crear Un Plan
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="https://drive.google.com/drive/folders/1LXx_af2W4zb3fpCBfmfiwnXoaFL8QGs6">
                                <i style="color: white;" class="fas fa-globe"></i> Webinars
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('access/*'), 'open')}}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('access/auth*')) }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        Accesos
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('access/auth/user*')) }}" href="{{ route('access.auth.user.index') }}">
                                Usuarios
                            </a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/role*')) }}" href="{{ route('admin.auth.role.index') }}">--}}
                        {{--                                Roles--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
