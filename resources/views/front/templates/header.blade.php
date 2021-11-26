<div class="col-12">
    <header class="row">
        <!-- Top Nav -->
        <div class="col-12 bg-dark py-2 d-md-block d-none">
            <div class="row">
                <div class="col-auto me-auto">
                    <ul class="top-nav">
                        <li>
                            <a href="tel:+123-456-7890"><i class="fa fa-phone-square me-2"></i>+123-456-7890</a>
                        </li>
                        <li>
                            <a href="mailto:mail@ecom.com"><i class="fa fa-envelope me-2"></i>mail@ecom.com</a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <ul class="top-nav">
                        @guest
                        <li>
                            <a href="{{ route('register') }}"><i class="fas fa-user-edit me-2"></i>Register</a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('front.user.index') }}"><i class="fas fa-user-circle me-2"></i>{{ auth()->user()->full_name }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" id="logout-link"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
                        </li>
                        <form action="{{ route('logout') }}" method="post" id="logout-form">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
        <!-- Top Nav -->

        <!-- Header -->
        <div class="col-12 bg-white pt-4">
            <div class="row">
                <div class="col-lg-auto">
                    <div class="site-logo text-center text-lg-left">
                        <a href="{{ route('front.home.index') }}">Online Shop</a>
                    </div>
                </div>
                <div class="col-lg-5 mx-auto mt-4 mt-lg-0">
                    <form action="{{ route('front.home.search') }}" method="get">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="search" name="term" class="form-control border-dark" placeholder="Search..." value="{{ request()->term }}" required>
                                <button class="btn btn-outline-dark" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-auto text-center text-lg-left header-item-holder">
                    <a href="#" class="header-item">
                        <i class="fas fa-heart me-2"></i><span id="header-favorite">0</span>
                    </a>
                    <a href="{{ route('front.cart.index') }}" class="header-item" id="header-item" data-url="{{ route('front.cart.total') }}">
                        <i class="fas fa-shopping-bag me-2"></i><span id="header-qty" class="me-3">0</span>
                        <i class="fas fa-money-bill-wave me-2"></i><span id="header-price">Rs. 0</span>
                    </a>
                </div>
            </div>

            <!-- Nav -->
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
                    <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('front.home.index') }}">Home</a>
                            </li>
                            @foreach($categories as $category)
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('front.home.category', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                            @endforeach
                    </div>
                </nav>
            </div>
            <!-- Nav -->

        </div>
        <!-- Header -->

    </header>
</div>
