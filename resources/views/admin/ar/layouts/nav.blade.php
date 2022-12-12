<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('dashboard') }}" class="nav-link">الرئيسية</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">

      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3" method="POST" action="{{ route('admin.logout') }}">
        @csrf
      <div class="input-group input-group-sm">

        <div class="input-group-append">
          <button class="btn btn-danger" type="submit">
            تسجيل الخروج
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->

  </nav>
