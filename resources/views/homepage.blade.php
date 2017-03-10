<!DOCTYPE html>
<html>
    <head>
        <title>Wargame</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link rel="stylesheet" href="/css/styles.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link href="/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
        <link href="/css/animate.css" rel="stylesheet">

    </head>
    <body>
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    @if (Auth::check())
                    Wargame - {{ Auth::user()->name }}
                    @else
                    Wargame
                    @endif
                </a>
            </div>
            <div class="navbar-collapse collapse">

                <!-- Left nav -->
                <ul class="nav navbar-nav">
                    <!--<li><a href="#">Link</a></li>-->
                    <li>
                        @if (Auth::check())
                        <a href="/logout">Logout</a>
                        @else
                        <a href="#" data-toggle="modal" data-target="#win-register">Register</a>
                        <a href="#" data-toggle="modal" data-target="#win-login">Login</a>
                        @endif
                    </li>
                    <li>
                        @if (Auth::check())
                        <a href="#">Build <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Barracks</a></li>
                            <li><a href="#">Storehouse</a></li>
                        </ul>
                        @endif
                    </li>
                </ul>

            </div><!--/.nav-collapse -->
        </div>

        <div id="map"></div>

        @if (Auth::check())
        <div class="sidebar-nav-fixed affix" id='resource-bar'>
            <div class="well">
                <table class='table table-bordered table-condensed'>
                    <tr><td>F:</td><td><span id='resources-food'>{{ Auth::user()->food }}</span></td></tr>
                    <tr><td>W:</td><td><span id='resources-wood'>{{ Auth::user()->wood }}</span></td></tr>
                    <tr><td>S:</td><td><span id='resources-stone'>{{ Auth::user()->stone }}</span></td></tr>
                    <tr><td>G:</td><td><span id='resources-gold'>{{ Auth::user()->gold }}</span></td></tr>
                </table>
<!--                <ul class="nav ">
                    <li class="nav-header">Res.</li>
                    <li>F: <span id='resources-food'>0</span></li>
                    <li>W: <span id='resources-wood'>0</span></li>
                    <li>S: <span id='resources-stone'>0</span></li>
                    <li>G: <span id='resources-gold'>0</span></li>
                </ul>-->
            </div>
            <!--/.well -->
        </div>
        @endif

        <!-- Modal -->
        @include('dialogs.register')
        @include('dialogs.login')


        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/Leaflet.MakiMarkers.js"></script>
        <script src="/js/jquery.smartmenus.js"></script>
        <script src="/js/jquery.smartmenus.bootstrap.js"></script>
        <script src="/js/bootstrap-notify.js"></script>
        <script src="/js/custom.js"></script>
    </body>
</html>