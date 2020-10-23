<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
{{--            <li class="nav-title">--}}
{{--                @lang('menus.backend.sidebar.general')--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link {{--}}
{{--                    active_class(Active::checkUriPattern('admin/dashboard'))--}}
{{--                }}" href="{{ route('admin.dashboard') }}">--}}
{{--                    <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                    @lang('menus.backend.sidebar.dashboard')--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="nav-title">--}}
{{--                @lang('menus.backend.sidebar.system')--}}
{{--            </li>--}}

            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
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
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/plan'))}}" href="{{ route('admin.plan.index') }}">
                                Planes
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('admin/log-viewer*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{active_class(Active::checkUriPattern('admin/*')) }}" href="#">
                        <i class="nav-icon fas fa-list"></i> Configuración
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/food-group'))}}" href="{{ route('admin.food-group.index') }}">
                                Grupos de Alimentos
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/food'))}}" href="{{ route('admin.food.index') }}">
                                Alimentos
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/classification'))}}" href="{{ route('admin.classification.index') }}">
                                Clasificaciones
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(Active::checkUriPattern('admin/observation'))}}" href="{{ route('admin.observation.index') }}">
                                Observaciones de Recetas
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item nav-dropdown {{active_class(Active::checkUriPattern('admin/auth*'), 'open')}}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('admin/auth*')) }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        Accesos
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('admin/auth/user*')) }}" href="{{ route('admin.auth.user.index') }}">
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

{{--                <li class="divider"></li>--}}

{{--                <li class="nav-item nav-dropdown {{--}}
{{--                    active_class(Active::checkUriPattern('admin/log-viewer*'), 'open')--}}
{{--                }}">--}}
{{--                        <a class="nav-link nav-dropdown-toggle {{--}}
{{--                            active_class(Active::checkUriPattern('admin/log-viewer*'))--}}
{{--                        }}" href="#">--}}
{{--                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')--}}
{{--                    </a>--}}

{{--                    <ul class="nav-dropdown-items">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                            active_class(Active::checkUriPattern('admin/log-viewer'))--}}
{{--                        }}" href="{{ route('log-viewer::dashboard') }}">--}}
{{--                                @lang('menus.backend.log-viewer.dashboard')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{--}}
{{--                            active_class(Active::checkUriPattern('admin/log-viewer/logs*'))--}}
{{--                        }}" href="{{ route('log-viewer::logs.list') }}">--}}
{{--                                @lang('menus.backend.log-viewer.logs')--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
