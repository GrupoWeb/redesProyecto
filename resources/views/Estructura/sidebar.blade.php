<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-nav">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('/imgRedes/logoChat.png') }}"  class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Chat Online</span>
    </a>
    <div class="sidebar ">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
{{--              <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2" alt="User Image">--}}
          </div>
          <div class="info">
              <a href="#" class="d-block"> {{ auth()->user()->name!=null ? auth()->user()->name : "Administrator" }} </a>
          </div>
      </div>
      <nav class="mt-2 sidebar-nav">
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="../chatSecury" class="nav-link">
                      <i class="nav-icon fa fa-lock" aria-hidden="true" style="color:green"></i>
                      <p>
                          Sala de Chat Seguro
                      </p>
                    </a>
              </li>
              <li class="nav-item">
                  <a href="../chatInsecurity" class="nav-link">
                      <i class="nav-icon fa fa-times" aria-hidden="true" style="color:red"></i>
                      <p>
                          Sala de Chat Inseguro
                      </p>
                    </a>
              </li>

          </ul>
      </nav>
    </div>
</aside>
