<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('clearboard.sitename') }} - @yield('title')</title>

        <link rel="stylesheet" type="text/css" href="{{ theme_asset('css/main.css') }}">

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js" type="text/javascript"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>

        <script type="text/javascript">
            window.base_path = "{{ url() }}";
            window.isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};
            window.csrf_token = "{{ csrf_token() }}";
        </script>

        @yield('head')
    </head>
    <body>
        <!-- Page specific assets -->
        @yield('page_assets')

        <div id="cover"></div>

        <div class="promptbox" id="promptbox">
            <div class="promptbox-header">Prompt Header</div>
            <p class="promptbox-message">Prompt Body</p>
            <div class="promptbox-buttons"></div>
        </div>

        <div id="header">
            <div class="content-width">
                <a href="{{ url('/') }}"><img src="{{ asset('header.png') }}" alt="{{ config('clearboard.sitename') }}" id="header-img"></a>
                <div id="header-rightside">
                    <div id="header-rightside-inner">
                        <div id="userbox" class="{{ Auth::check() ? 'userbox-loggedin' : 'userbox-notloggedin' }}">
                            @if (Auth::check())
                                <img id="userbox-img" alt="Mitchfizz05"
                                    src="{{ Auth::user()->avatarUrl() }}">
                                <span id="userbox-name">{{ Auth::user()->name }}</span>
                                <div id="userbox-dropdown">
                                    <div class="userbox-dropdown-item">My Profile</div>
                                    <div class="userbox-dropdown-item">My Settings</div>
                                    <div class="userbox-dropdown-item">Support</div>
                                    <a href="{{ url('/auth/logout') }}"><div class="userbox-dropdown-item userbox-dropdown-item-warning">Logout</div></a>
                                </div>
                            @else
                                <span class="vertical-align"></span>
                                <span class="button button-green" id="loginbtn">Login</span>
                                <span id="userbox-or">or</span>
                                <a href="{{ url('/register') }}"><span class="button button-green" id="registerbtn">Register</span></a>
                                <div id="userbox-dropdown">
                                    <form id="loginform" action="{{ url('/auth/login') }}" method="POST">
                                        {!! csrf_field(); !!}
                                        <input type="text" class="input-field" id="login-username" name="username" placeholder="Username"><br>
                                        <input type="password" class="input-field" id="login-password" name="password" placeholder="Password"><br>
                                        <input type="submit" id="login-button" class="button" value="Login">
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="wrapper" class="content-width">
            @yield('content')
        </div>
        <div id="footer" class="content-width">
            @include('clearboard.main.footer')
        </div>

        <!-- Low priority assets -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Lato|Merriweather'">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

        <!-- InstantClick -->
        <script type="text/javascript" data-no-instant src="//cdnjs.cloudflare.com/ajax/libs/instantclick/3.0.1/instantclick.min.js"></script>
        <script type="text/javascript" data-no-instant>
            InstantClick.init();
            InstantClick.on("change", function(){
                window.setInterval(init, 0);
            });
        </script>
    </body>
</html>