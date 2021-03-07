<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href={{route('home')}}>Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <div class="dropdown show navbar-nav ml-auto">
                <a class="btn  dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:white">
                    Menu
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                    @guest
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                <a class="dropdown-item" href="/products/public">Product list for users</a>                        @endif
                    @else
                        @can('isAdmin')
                            <a class="dropdown-item" href={{route('home')}}>Home</a>
                            <a class="dropdown-item" href={{route('products')}}>Product list for admins</a>
                            <a class="dropdown-item" href={{route('orders')}}>Get ordered items list</a>
                            <a class="dropdown-item" href={{route('products/public')}}>Product list for users</a>
                            <a class="dropdown-item" href={{route('new-item')}}>New Product</a>
                            <a class="dropdown-item" href="{{route('handling-users')}}">Handling users</a>
                        @elsecan('isUser')
                            <a class="dropdown-item" href={{route('home')}}>Home</a>
                            <a class="dropdown-item" href={{route('products/public')}}>Product list</a>
                        @endcan

                </div>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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


                </div>
            </div>
        </div>
    </div>
</nav>
