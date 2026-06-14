<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('admin.profile.index') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">MAIN</li>
          <li class="nav-item {{ request()->routeIs('admin.slide-shows.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.slide-shows.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slide Shows
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.slide-shows.index') }}" class="nav-link {{ request()->routeIs('admin.slide-shows.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.slide-shows.create') }}" class="nav-link {{ request()->routeIs('admin.slide-shows.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->routeIs('admin.pets.*') || request()->routeIs('admin.pet-colors.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.pets.*') || request()->routeIs('admin.pet-colors.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-paw"></i>
              <p>
                Pets
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.pets.create') }}" class="nav-link {{ request()->routeIs('admin.pets.create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pets.index') }}" class="nav-link {{ request()->routeIs('admin.pets.index') || request()->routeIs('admin.pets.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pet-colors.index') }}" class="nav-link {{ request()->routeIs('admin.pet-colors.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Colors</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.about-us.index') }}" class="nav-link {{ request()->routeIs('admin.about-us.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>About Us</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.achievements.index') }}" class="nav-link {{ request()->routeIs('admin.achievements.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-trophy"></i>
              <p>Achievements</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.content-pages.index') }}" class="nav-link {{ request()->routeIs('admin.content-pages.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Content Pages</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.reservation-applications.index') }}" class="nav-link {{ request()->routeIs('admin.reservation-applications.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Reservation Applications</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.inquiries.index') }}" class="nav-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Inquiries
                @php
                  $unreadCount = \App\Models\Inquiry::where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                  <span class="badge badge-warning right">{{ $unreadCount }}</span>
                @endif
              </p>
            </a>
          </li>

          <li class="nav-header">WEBSITE SETTINGS</li>
          <li class="nav-item {{ request()->routeIs('admin.website-settings.*') || request()->routeIs('admin.seo-settings.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.website-settings.*') || request()->routeIs('admin.seo-settings.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Site Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.website-settings.index') }}" class="nav-link {{ request()->routeIs('admin.website-settings.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Website Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.seo-settings.index') }}" class="nav-link {{ request()->routeIs('admin.seo-settings.*') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO Settings</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Edit Credentials</p>
            </a>
          </li>

          <li class="nav-item">
            <form action="{{ route('admin.logout') }}" method="POST" id="logout-form">
              @csrf
              <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
