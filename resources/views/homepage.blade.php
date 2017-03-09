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
                        <a href="#">Build <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Barracks</a></li>
                            <li><a href="#">Storehouse</a></li>
                        </ul>
                    </li>

<!--                    <li><a href="#">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">A long sub menu <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Action</a></li>
                                            <li><a href="#">Something else here</a></li>
                                            <li class="disabled"><a class="disabled" href="#">Disabled item</a></li>
                                            <li><a href="#">One more link</a></li>
                                            <li><a href="#">Menu item 1</a></li>
                                            <li><a href="#">Menu item 2</a></li>
                                            <li><a href="#">Menu item 3</a></li>
                                            <li><a href="#">Menu item 4</a></li>
                                            <li><a href="#">Menu item 5</a></li>
                                            <li><a href="#">Menu item 6</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Another link</a></li>
                                    <li><a href="#">One more link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>


            </div><!--/.nav-collapse -->
        </div>

        <div id="map"></div>

        <!-- Modal -->
        <div id="win-register" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Register</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('register') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="register-name">Ingame name</label>
                                <input type="text" name="name" required autofocus id="register-name"  class="form-control" value="{{ old('name') }}"/>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="register-email">E-mail</label>
                                <input type="email" name="email" required id="register-email"  class="form-control" value="{{ old('email') }}"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="register-password">Password</label>
                                <input type="password" name="password" required id="register-password"  class="form-control"/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="register-password-confirm">Confirm password</label>
                                <input type="password" name="password_confirmation" required id="register-password-confirm"  class="form-control"/>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="win-login" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('login') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="register-email">E-mail</label>
                                <input type="email" name="email" required id="register-email"  class="form-control" value="{{ old('email') }}"/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="register-password">Password</label>
                                <input type="password" name="password" required id="register-password"  class="form-control"/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/jquery.smartmenus.js"></script>
        <script src="/js/jquery.smartmenus.bootstrap.js"></script>
        <script src="/js/custom.js"></script>
    </body>
</html>