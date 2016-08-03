<header class="main-header">

  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>S</b>I</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SIMAK</b>IPB</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{{ asset("/uploads/avatar.png") }}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            @if(Session::has('studentName'))
            <span class="hidden-xs">{{ Session::get('studentName') }}</span>
            @elseif(Session::has('lectureId'))
            <span class="hidden-xs">{{ Session::get('lectureName') }}</span>
            @else
            <span class="hidden-xs">{{ Session::get('admin') }}</span>
            @endif
          </a>

          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ asset("/uploads/avatar.png") }}" class="img-circle" alt="User Image">
              @if(Session::has('studentName'))
              <p>{{Session::get('studentName')}}</p>
              @elseif(Session::has('lectureId'))
              <p>{{Session::get('lectureName')}}</p>
              @else
                <p>{{ Session::get('admin') }}</p>
              @endif
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                @if (Session::has('studentName'))
                <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                @elseif (Session::has('lectureId'))
                <a href="{{ route('endsession') }}" class="btn btn-default btn-flat">Sign out</a>
                @else
                <a href="{{ route('signout') }}" class="btn btn-default btn-flat">Sign out</a>
                @endif
              </div>
            </li>
          </ul>

        </li>
      </ul>
    </div>
  </nav>
</header>
