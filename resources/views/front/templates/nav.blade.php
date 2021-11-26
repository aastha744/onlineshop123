<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ $active == 'orders' ? 'active' : '' }}" href="{{ route('front.user.index') }}">
            <i class="fas fa-gifts me-2"></i>My Orders
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active == 'reviews' ? 'active' : '' }}" href="{{ route('front.user.reviews.edit') }}">
            <i class="fas fa-comments me-2"></i>My Reviews
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active == 'profile' ? 'active' : '' }}" href="{{ route('front.user.profile.edit') }}">
            <i class="fas fa-user-edit me-2"></i>Edit Profile
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $active == 'password' ? 'active' : '' }}" href="{{ route('front.user.password.edit') }}">
            <i class="fas fa-asterisk me-2"></i>Change Password
        </a>
    </li>
</ul>
