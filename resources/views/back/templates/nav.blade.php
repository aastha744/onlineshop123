<header class="row">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('back.dashboard.index') }}">Online Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if(auth('admin')->user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'staffs' ? 'active':'' }}" href="{{ route('back.staffs.index') }}">
                            <i class="fas fa-users me-2"></i>Staffs
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'categories' ? 'active':'' }}" href="{{ route('back.categories.index') }}">
                            <i class="fas fa-tags me-2"></i>Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'brands' ? 'active':'' }}" href="{{ route('back.brands.index') }}">
                            <i class="fas fa-star me-2"></i>Brands
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'products' ? 'active':'' }}" href="{{ route('back.products.index') }}">
                            <i class="fas fa-gifts me-2"></i>Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'users' ? 'active':'' }}" href="{{ route('back.users.index') }}">
                            <i class="fas fa-user-friends me-2"></i>Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'reviews' ? 'active':'' }}" href="{{ route('back.reviews.index') }}">
                            <i class="fas fa-comments me-2"></i>Reviews
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $active == 'orders' ? 'active':'' }}" href="{{ route('back.orders.index') }}">
                            <i class="fas fa-shopping-basket me-2"></i>Orders
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $active == 'profile' ? 'active':'' }}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-2"></i>{{ auth('admin')->user()->full_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('back.profile.edit') }}"><i class="fas fa-user-edit me-2"></i>Edit Profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('back.password.edit') }}"><i class="fas fa-asterisk me-2"></i>Change Password</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('back.logout') }}" id="logout-link"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                                <form action="{{ route('back.logout') }}" method="post" id="logout-form"></form>
                                @csrf
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
