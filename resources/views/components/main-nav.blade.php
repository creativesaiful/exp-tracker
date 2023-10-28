<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
      
        <span class="ms-1 font-weight-bold text-white">Expense Tracker</span>
      </a>
    </div>


 @php
    $route = Route::currentRouteName();


@endphp

    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link text-white {{ ($route == 'dashboard') ? 'active' : '' }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Dashboards</span>
          </a>
          
        </li>

        <li class="nav-item">
          <a href="{{ route('categories') }}" class="nav-link text-white  {{  $route == 'categories' ? 'active' : ''  }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Expense Category</span>
          </a>
          
        </li>

        <li class="nav-item">
          <a href="{{ route('budgets') }}" class="nav-link text-white  {{  $route == 'budgets' ? 'active' : ''  }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Budgets</span>
          </a>
          
        </li>


        <li class="nav-item">
          <a href="{{ route('expenseView') }}" class="nav-link text-white  {{  $route == 'expenseView' ? 'active' : ''  }}" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Expenses</span>
          </a>
          
        </li>



        
     



        <hr class="horizontal light mt-0">
       
       
      


        <li class="nav-item mb-2 mt-0">
          <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
            <img src="{{  Auth::user()->profile_photo_path ? asset('storage/uploads/' .  Auth::user()->profile_photo_path) : asset('assets/img/placeholder.png') }}" class="avatar">
            <span class="nav-link-text ms-2 ps-1"> {{ Auth::user()->name }}</span>
          </a>


          <div class="collapse" id="ProfileNav" style="">
            <ul class="nav ">
              <li class="nav-item">
                <a class="nav-link text-white" href="{{route('profile')}}">
                  <span class="sidenav-mini-icon"> MP </span>
                  <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="../../pages/pages/account/settings.html">
                  <span class="sidenav-mini-icon"> S </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Settings </span>
                </a>
              </li>
              <li class="nav-item">

                <form method="POST" action="{{ route('logout') }}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <a class="nav-link text-white " href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit(); ">
                  <span class="sidenav-mini-icon"> L </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                </a>


              </form>

              </li>
            </ul>
          </div>
        </li>
       
      </ul>
    </div>
  </aside>