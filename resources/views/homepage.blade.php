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
                <a class="navbar-brand" href="#">Wargame</a>
            </div>
            <div class="navbar-collapse collapse">

                <!-- Left nav -->
                <ul class="nav navbar-nav">
                    <!--<li><a href="#">Link</a></li>-->
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

        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="/js/jquery.smartmenus.js"></script>
        <script src="/js/jquery.smartmenus.bootstrap.js"></script>
        <script src="/js/custom.js"></script>
    </body>
</html>