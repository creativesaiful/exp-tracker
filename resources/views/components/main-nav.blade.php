<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard-pro/pages/dashboards/analytics.html " target="_blank">
        <img src="../../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Material Dashboard 2 PRO</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mb-2 mt-0">
          <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
            <img src="../../assets/img/team-3.jpg" class="avatar">
            <span class="nav-link-text ms-2 ps-1">Brooklyn Alice</span>
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
                <a class="nav-link text-white " href="../../pages/authentication/signin/basic.html">
                  <span class="sidenav-mini-icon"> L </span>
                  <span class="sidenav-normal  ms-3  ps-1"> Logout </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <hr class="horizontal light mt-0">
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white active" aria-controls="dashboardsExamples" role="button" aria-expanded="false">
            <i class="material-icons-round opacity-10">dashboard</i>
            <span class="nav-link-text ms-2 ps-1">Dashboards</span>
          </a>
          <div class="collapse  show " id="dashboardsExamples">
            <ul class="nav ">
              <li class="nav-item active">
                <a class="nav-link text-white active" href="../../pages/dashboards/analytics.html">
                  <span class="sidenav-mini-icon"> A </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Analytics </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="../../pages/dashboards/discover.html">
                  <span class="sidenav-mini-icon"> D </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Discover </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="../../pages/dashboards/sales.html">
                  <span class="sidenav-mini-icon"> S </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Sales </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="../../pages/dashboards/automotive.html">
                  <span class="sidenav-mini-icon"> A </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Automotive </span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " href="../../pages/dashboards/smart-home.html">
                  <span class="sidenav-mini-icon"> S </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Smart Home </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">PAGES</h6>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link text-white " aria-controls="pagesExamples" role="button" aria-expanded="false">
            <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">image</i>
            <span class="nav-link-text ms-2 ps-1">Pages</span>
          </a>
          <div class="collapse " id="pagesExamples">
            <ul class="nav ">
              <li class="nav-item ">
                <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#profileExample">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Profile <b class="caret"></b></span>
                </a>
                <div class="collapse " id="profileExample">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a class="nav-link text-white " href="../../pages/pages/profile/overview.html">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal  ms-2  ps-1"> Profile Overview </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white " href="../../pages/pages/profile/projects.html">
                        <span class="sidenav-mini-icon"> A </span>
                        <span class="sidenav-normal  ms-2  ps-1"> All Projects </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white " href="../../pages/pages/profile/messages.html">
                        <span class="sidenav-mini-icon"> M </span>
                        <span class="sidenav-normal  ms-2  ps-1"> Messages </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item ">
                <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#usersExample">
                  <span class="sidenav-mini-icon"> U </span>
                  <span class="sidenav-normal  ms-2  ps-1"> Users <b class="caret"></b></span>
                </a>
                <div class="collapse " id="usersExample">
                  <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                      <a class="nav-link text-white " href="../../pages/pages/users/reports.html">
                        <span class="sidenav-mini-icon"> R </span>
                        <span class="sidenav-normal  ms-2  ps-1"> Reports </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white " href="../../pages/pages/users/new-user.html">
                        <span class="sidenav-mini-icon"> N </span>
                        <span class="sidenav-normal  ms-2  ps-1"> New User </span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            
            </ul>
          </div>
        </li>
       
      </ul>
    </div>
  </aside>