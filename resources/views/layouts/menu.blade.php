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
    @if (\App\Helpers\AdminHelper::mostrarMenu('configuraciones'))
    <li class="{{ Request::is('configuraciones.s3*') ? 'active' : '' }}">
      <a href="{!! route('configuraciones.s3') !!}"><i class="fa fa-user"></i><span>Credenciales S3</span></a>
    </li>
    @endif    
  </ul>
</li>
@endif
<li><div class="separador"></div></li>
@if (\App\Helpers\AdminHelper::mostrarMenu('contenidos-predefinidos'))    
<li class="{{ Request::is('custom-mails*') ? 'active' : '' }}">
    <a href="{!! route('custom-mails.index') !!}"><i class="fa fa-edit"></i><span>Piezas</span></a>
</li>
@endif
@if (\App\Helpers\AdminHelper::mostrarMenu('piezas'))    
<li class="{{ Request::is('contenido-predefinidos*') ? 'active' : '' }}">
    <a href="{!! route('contenido-predefinidos.index') !!}"><i class="fa fa-edit"></i><span>Contenido Predefinidos</span></a>
</li>
@endif
<li><div class="separador"></div></li>
@if (\App\Helpers\AdminHelper::mostrarMenu('piezas-slots'))    
<li class="{{ Request::is('piezas-slots*') ? 'active' : '' }}">
    <a href="{!! route('slot-mails.index') !!}"><i class="fa fa-edit"></i><span>Piezas (Slots)</span></a>
</li>
@endif

@if (\App\Helpers\AdminHelper::mostrarMenu('contenidos-predefinidos'))    
<li class="{{ Request::is('custom-mails*') ? 'active' : '' }}">
  <a href="{!! route('slot-contenido-predefinidos.index') !!}"><i class="fa fa-edit"></i><span>Contenido Predefinidos (Slots)</span></a>
</li>
@endif