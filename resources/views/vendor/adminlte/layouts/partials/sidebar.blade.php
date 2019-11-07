<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>Principal</span></a></li>
            @can('menu.admin')
            <li class="treeview">
                    <a href="#"><i class="fa fa-cogs"></i><span>Configuracion Sistema</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="{{ url('/Sedes') }}"><span>Sedes</span></a></li>
                            <li><a href="{{ url('/Departamentos') }}"><span>Departamentos</span></a></li>
                            <li><a href="{{ url('/Dependencias') }}"><span>Dependencias</span></a></li>
                            <li><a href="{{ url('/Jefedependencia') }}"><span>Jefe dependencias</span></a></li>
                        </ul> 
            </li>
            <li class="treeview">
                    <a href="#"><i class="glyphicon glyphicon-blackboard"></i><span>Configuracion Equipos</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="{{ url('/Tipequipo') }}"><span>Tipo de  Equipo</span></a></li>
                            <li><a href="{{ url('/Marcaequi') }}"><span>Marca Equipo</span></a></li>
                            <li><a href="{{ url('/Modelequi') }}"><span>Modelo de Equipo</span></a></li>
                            <li><a href="{{ url('/Proveedores') }}"><span>Proveedores</span></a></li>
                            <li><a href="{{ url('/Equipos') }}"><span>Equipos</span></a></li>
                            <li><a href="{{ url('/Responsables') }}"><span>Responsables Equipo</span></a></li>
                            <li><a href="{{ url('/Localizacion') }}"><span>Localizacion</span></a></li>
                    </ul> 
            </li>
            
            <li class="treeview">
                    <a href="#"><i class="glyphicon glyphicon-user"></i><span>Configuracion Usuarios</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="{{ url('/Cargo') }}"><span>Crear Cargos</span></a></li>
                            <li><a href="{{ url('/Empleados') }}"><span>Crear Empleados</span></a></li>
                            <li><a href="{{ url('/Roles') }}"><span>Roles</span></a></li>
                            <li><a href="{{ url('/Permisos') }}"><span>Permisos</span></a></li>
                            <li><a href="{{ url('/Permisosxrol') }}"><span>Permisos por rol</span></a></li>
                            <li><a href="{{ url('/Rolxuser') }}"><span>Rol por usuario</span></a></li>

                            <li><a href="{{ url('/Usuarios') }}"><span>Usuarios del sistema</span></a></li>

                    </ul> 
            </li>

            <li class="treeview">
                    <a href="#"><i class="fa fa-cogs"></i><span>Configuracion Mantenimientos</span><i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                            <li><a href="{{ url('/Tipcomponente') }}"><span>Tipo de Componentes</span></a></li>
                            <li><a href="{{ url('/Componentes') }}"><span>Componentes</span></a></li>
                            <li><a href="{{ url('/Tipmante') }}"><span>Tipo de Mantenimiento</span></a></li>
                            <li><a href="{{ url('/Programas') }}"><span>Programas</span></a></li>
                            <li><a href="{{ url('/Cronomantenimiento') }}"><span>Cronograma Mantenimiento</span></a></li>

                    </ul> 
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-cogs"></i><span>Reportes</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                </ul> 
            </li>
             
            </li>
            @else

            @endcan
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
