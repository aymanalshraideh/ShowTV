   <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
       <div class="position-sticky pt-3">
           <ul class="nav flex-column">
               <li class="nav-item">
                   <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                       <span data-feather="home"></span>
                       Dashboard
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                       href="{{ route('admin.users.index') }}">
                       <span data-feather="file"></span>
                       Users
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ request()->routeIs('tv-shows') ? 'active' : '' }}"
                       href="{{ route('tv-shows') }}">
                       <span data-feather="file"></span>
                       Tv Show / Series
                   </a>
               </li>
               <li class="nav-item">
                   <a class="nav-link {{ request()->routeIs('episodess-page') ? 'active' : '' }}"
                       href="{{ route('episodess-page') }}">
                       <span data-feather="file"></span>
                       Episodes
                   </a>
               </li>

           </ul>


       </div>
   </nav>
