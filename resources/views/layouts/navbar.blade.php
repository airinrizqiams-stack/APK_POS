<style>
  :root {
      --nav-primary: #493628;
      --nav-bg: #FFFFFF;
      --nav-muted: #6B5B52;
      --nav-border: #AB886D;
  }

  .custom-navbar {
      background-color: var(--nav-bg) !important;
      border-bottom: 1px solid var(--nav-border);
      padding: 0.75rem 0;
      box-shadow: 0 2px 10px rgba(73, 54, 40, 0.05);
  }

  .custom-navbar .navbar-container {
      max-width: 1140px;
      margin: 0 auto;
      width: 100%;
      padding-left: 15px;
      padding-right: 15px;
      display: flex;
      align-items: center;
      justify-content: space-between;
  }

  .custom-navbar .navbar-brand-custom {
      color: var(--nav-primary) !important;
      font-weight: 800;
      font-size: 1.3rem;
      letter-spacing: 1px;
  }

  .custom-navbar .nav-link-custom {
      color: var(--nav-primary) !important;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.5rem 1rem !important;
      opacity: 0.75;
      transition: all 0.2s ease;
      position: relative;
  }

  .custom-navbar .nav-link-custom:hover {
      opacity: 1;
  }

  .custom-navbar .nav-link-custom.active {
      opacity: 1 !important;
      font-weight: 700;
  }

  .custom-navbar .nav-link-custom.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 1rem;
      right: 1rem;
      height: 3px;
      background-color: var(--nav-primary);
      border-radius: 2px;
  }

  .btn-logout-custom {
      background-color: #dc3545 !important;
      color: #FFFFFF !important;
      font-weight: 600;
      font-size: 0.9rem;
      padding: 0.5rem 1.25rem !important;
      border-radius: 8px !important;
      border: none !important;
      transition: background-color 0.2s ease;
  }

  .btn-logout-custom:hover {
      background-color: #bd2130 !important;
  }
</style>

<nav class="navbar navbar-expand-lg custom-navbar">
  <div class="navbar-container">
    <a class="navbar-brand navbar-brand-custom" href="#">POS SYSTEM</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="border-color: var(--nav-border);">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('admin/users') ? 'active' : ''}}" href="{{ route('admin.users') }}">Pengguna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('produk') ? 'active' : ''}}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom {{ Request::is('penjualan') ? 'active' : ''}}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>
      
      <form class="d-flex align-items-center m-0" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-logout-custom">Keluar</button>
      </form>
    </div>
  </div>
</nav>
