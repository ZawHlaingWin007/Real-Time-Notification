<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('groups.index') }}">{{ __('Groups') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="notification-dropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            Notifications
                            <span class="badge bg-danger" id="notification-count">0</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end px-2 notification-dropdown"
                            aria-labelledby="notification-dropdown">
                            @php
                                $notifications = session()->get('notifications') ?? [];
                                $localStorageNotifications = json_decode($localStorageNotifications ?? '[]');
                                $allNotifications = array_merge($notifications, $localStorageNotifications);
                            @endphp
                            @if (!empty($allNotifications))
                                @foreach ($allNotifications as $notification)
                                    <p class="dropdown-item mb-1 alert alert-primary">
                                        {{ $notification }}
                                    </p>
                                @endforeach
                            @else
                                <p class="dropdown-item mb-1 alert alert-primary">
                                    No notifications.
                                </p>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
