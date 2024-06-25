 <nav id="sidebar" class="sidebar js-sidebar fixed bg-primary">
     <div class="sidebar-content js-simplebar bg-primary">
         <a class="sidebar-brand" href="#">
            <span class="align-middle text-capitalize">Panel {{ Auth::user()->role }}</span>
         </a>

         <ul class="sidebar-nav">
             <li class="sidebar-item @if (request()->routeIs('dashboard')) active @endif">
                 <a class="sidebar-link bg-transparent fw-bold" href="{{ route('dashboard') }}">
                     <i class="align-middle fa fa-home"></i> <span class="align-middle">Dashboard</span>
                 </a>
             </li>
             {{-- if role admin --}}
                @if (Auth::user()->role == 'admin')
                    <li class="sidebar-item @if (request()->routeIs('admin.books.*')) active @endif">
                        <a class="sidebar-link bg-transparent fw-bold" href="{{ route('admin.books.index') }}">
                            <i class="align-middle fa fa-book"></i> <span class="align-middle">Buku</span>
                        </a>
                    </li>
                    <li class="sidebar-item @if (request()->routeIs('admin.rents.*')) active @endif">
                        <a class="sidebar-link bg-transparent fw-bold" href="{{ route('admin.rents.index') }}">
                            <i class="align-middle fa fa-users"></i> <span class="align-middle">Peminjaman</span>
                        </a>
                    </li>
                @endif
             {{-- <li class="sidebar-item @if (request()->routeIs('seller.product.*')) active @endif">
                <a class="sidebar-link bg-transparent fw-bold" href="{{ route('seller.product.index') }}">
                    <i class="align-middle fa fa-box"></i> <span class="align-middle">Produk</span>
                </a>
            </li>
            <li class="sidebar-item @if (request()->routeIs('seller.store.*')) active @endif">
                <a class="sidebar-link bg-transparent fw-bold" href="{{ route('seller.store.index') }}">
                    <i class="align-middle fa fa-store"></i> <span class="align-middle">Informasi Toko</span>
                </a>
            </li> --}}
         </ul>
     </div>
 </nav>
