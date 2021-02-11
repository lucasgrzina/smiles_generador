<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
  <a href="{!! route('admin.home') !!}"><i class="fa fa-chevron-right"></i><span>Dashboard</span></a>
</li>
@if (\App\Helpers\AdminHelper::mostrarMenu(['usuarios','roles-y-permisos','clientes']))    
<li class=" treeview menu-open {{ Request::is('users*') || Request::is('roles*') || Request::is('clientes*') ? 'active' : '' }}">
  <a href="#">
    <i class="fa fa-user-shield"></i> <span>Administración</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu" style="">
    @if (\App\Helpers\AdminHelper::mostrarMenu('usuarios'))    
    <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
      <a href="{!! route('usuarios.index') !!}"><i class="fa fa-user"></i><span>Usuarios - Staff</span></a>
    </li>
    @endif
    @if (\App\Helpers\AdminHelper::mostrarMenu('roles-y-permisos'))
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
      <a href="{!! route('roles.index') !!}"><i class="fa fa-user"></i><span>Roles</span></a>
    </li>
    @endif
    @if (\App\Helpers\AdminHelper::mostrarMenu('registrados'))
    <li class="{{ Request::is('registrados*') ? 'active' : '' }}">
      <a href="{!! route('registrados.index') !!}"><i class="fa fa-user"></i><span>Registrados</span></a>
    </li>
    @endif
    @if (\App\Helpers\AdminHelper::mostrarMenu('paises'))
    <li class="{{ Request::is('paises*') ? 'active' : '' }}">
        <a href="{!! route('paises.index') !!}"><i class="fa fa-edit"></i><span>Paises</span></a>
    </li>
    @endif
  </ul>
</li>
@endif


@if (\App\Helpers\AdminHelper::mostrarMenu('banners'))
<li class="{{ Request::is('banners*') ? 'active' : '' }}">
    <a href="{!! route('banners.index') !!}"><i class="fa fa-edit"></i><span>Banners</span></a>
</li>
@endif
<li class="{{ Request::is('tags*') ? 'active' : '' }}">
  <a href="{{ route('tags.index') }}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

@if (\App\Helpers\AdminHelper::mostrarMenu('productos'))
<li class="{{ Request::is('productos*') ? 'active' : '' }}">
    <a href="{!! route('productos.index') !!}"><i class="fa fa-edit"></i><span>Productos</span></a>
</li>
@endif
<li class="{{ Request::is('noticias*') ? 'active' : '' }}">
    <a href="{!! route('noticias.index') !!}"><i class="fa fa-edit"></i><span>Noticias</span></a>
</li>
<li class="{{ Request::is('entrenamientos*') ? 'active' : '' }}">
    <a href="{!! route('entrenamientos.index') !!}"><i class="fa fa-edit"></i><span>Entrenamientos</span></a>
</li>


<li class="{{ Request::is('categorias*') ? 'active' : '' }}">
    <a href="{!! route('categorias.index') !!}"><i class="fa fa-edit"></i><span>Categorias</span></a>
</li>

<li class="{{ Request::is('ofertas*') ? 'active' : '' }}">
    <a href="{!! route('ofertas.index') !!}"><i class="fa fa-edit"></i><span>Ofertas</span></a>
</li>

<li class="{{ Request::is('contenidos*') ? 'active' : '' }}">
    <a href="{!! route('contenidos.index') !!}"><i class="fa fa-edit"></i><span>Contenidos</span></a>
</li>

<li class="{{ Request::is('ofertas-opiniones*') ? 'active' : '' }}">
    <a href="{!! route('ofertas-opiniones.index') !!}"><i class="fa fa-edit"></i><span>Ofertas Opiniones</span></a>
</li>

