<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="/">
                <img src="{{ asset(getLogoUrl()) }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">

            </a>
           {{ getAppName() }}
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/categories*') ? 'active-sidebar' : '' }}" href="{{ route('categories.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-list">
                      </span>
                      <span class="nav-link-title">
                        Category
                      </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/users*') ? 'active-sidebar' : '' }}" href="{{ route('users.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-users">
                      </span>
                        <span class="nav-link-title">
                        Users
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/bookings*') ? 'active-sidebar' : '' }}" href="{{ route('bookings.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-book">
                      </span>
                        <span class="nav-link-title">
                        Bookings
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/reviews*') ? 'active-sidebar' : '' }}" href="{{ route('reviews.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-eye">
                      </span>
                        <span class="nav-link-title">
                        Reviews
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/contacts*') ? 'active-sidebar' : '' }}" href="{{ route('contacts.index') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-address-book">
                      </span>
                        <span class="nav-link-title">
                        Contact Us
                      </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link sidebar-title {{ Request::is('admin/settings*') ? 'active-sidebar' : '' }}" href="{{ route('settings.edit') }}">
                      <span class="nav-link-icon d-md-none d-lg-inline-block fa fa-chain">
                      </span>
                        <span class="nav-link-title">
                        Settings
                      </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
