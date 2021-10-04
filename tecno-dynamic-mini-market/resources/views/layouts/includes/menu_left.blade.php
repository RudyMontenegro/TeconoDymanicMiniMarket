 <!-- Navigation -->
 <style>
.active {
    background-color: lightblue;

}
 </style>

 <h6 class="navbar-heading text-muted">Gestionar Datos</h6>
 <ul class="navbar-nav">
     <li class="nav-item" >
         <a class="nav-link" href="{{ url('/')}}">
             <i class="ni ni-tv-2 text-primary"></i> Dashboard
         </a>
     </li>
     <li
     style="display: none;" class="nav-item {{ request()->is('sucursal') || request()->is('sucursal/create*') || request()->is('sucursal/editar*')?  'active' : ''}}">
         <a class="nav-link" href="{{ url('/sucursal')}}">
             <i class="ni ni-shop text-blue"></i> Sucursales
         </a>
     </li>
     <li style="display: none;"
         class="nav-item {{ request()->is('transferencia') || request()->is('transferencia/registrarTransferencia*') || request()->is('transferencia/create*') || request()->is('transferencia/editar*')?  'active' : ''}}">
         <a class="nav-link" href="{{ url('/transferencia')}}">
             <i class="fas fa-sync-alt text-blue"></i> Transferencias
         </a>
     </li>
     <li
         class="nav-item {{ request()->is('producto') || request()->is('producto/registrarCategoria*')||request()->is('producto/registrarProducto*') || request()->is('producto/editar*')? 'active' : ''}}">
         <a class="nav-link" href="{{url('producto')}}">
             <i class="fab fa-product-hunt text-blue"></i> Productos
         </a>
     </li>
     <li
         class="nav-item {{ request()->is('venta') || request()->is('venta/create*') || request()->is('venta/{venta}*')?  'active' : ''}}">
         <a class="nav-link" href="{{ url('/venta')}}">
             <i class="ni ni-basket text-blue"></i> Ventas
         </a>
     </li>
     
     <li
     style="display: none;" class="nav-item {{ request()->is('proveedor') || request()->is('proveedor/create*') || request()->is('proveedor/{proveedor}*')?  'active' : ''}}">
         <a class="nav-link" href="{{ url('/proveedor')}}">
             <i class="ni ni-delivery-fast text-blue"></i> Proveedores
         </a>
     </li>
     <li
     style="display: none;" class="nav-item {{ request()->is('cliente') || request()->is('cliente/registrarCliente*') || request()->is('cliente/editar*')? 'active' : ''}}">
         <a class="nav-link" href="{{url('cliente')}}">
             <i class="ni ni-single-02 text-blue"></i> Clientes
         </a>
     </li>

     <li class="nav-item {{ request()->is('compra') || request()->is('compra/registrarCompra*') ? 'active' : ''}}">
         <a class="nav-link" href="{{url('compra')}}">
             <i class="ni ni-cart text-blue"></i> Compras
         </a>
     </li>
     <li
         class="nav-item {{ request()->is('reportes') }}">
         <a class="nav-link" href="{{url('reporte')}}">
            <i class="fas fa-file-contract text-blue"></i> Reportes
         </a>
     </li>
     <li class="nav-item" style="display: none;">
         <a class="nav-link" href="./examples/register.html">
             <i class="ni ni-circle-08 text-blue"></i> Registrar usuarios
         </a>
     </li>
 </ul>
 