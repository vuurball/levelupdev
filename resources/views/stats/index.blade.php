

<html lang="en"><head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Portfolio Item - Start Bootstrap Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/portfolio-item.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Start Bootstrap</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Page Content -->
        <div class="container">

            <!-- Portfolio Item Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> {{strtoupper($selectedSkill)}}
                        <small>Top Related Skills</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Portfolio Item Row -->
            <div class="row">


                <div class="col-md-5">
                    @if(isset($selectedSkill))

                    @foreach (array_slice($relatedSkills, 0,6) as $relatedSkill)

                    <div class="col-sm-6 col-xs-6">
                        <a href="#"> {{ $relatedSkill->get('skillweight') }} {{ $relatedSkill->get('skillname') }}
                            <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                        </a>
                    </div>

                    @endforeach

                    @endif
                </div>

                <div class="col-md-7">
                    <div class="well">
                        <h4>Search skill</h4>
                        <div class="form-group">

                            <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = '/index.php/stats/' + this.options[this.selectedIndex].value)">
                                <option>Select...</option>
                                @foreach($skillsArr as $skill)
                                <option vlaue="{{ $skill }}" > {{ $skill }} </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.input-group -->
                    </div>

                    <img class="img-responsive" src="http://placehold.it/750x350" alt="">
<!--                    <img class="img-responsive"  width="750" height="350" class="img-responsive" src="/img/php.png" alt="">-->

                </div>

            </div>
            <!-- /.row -->

            <!-- Related Projects Row -->
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header">Other Related Skills</h3>
                </div>

                @if(isset($selectedSkill))


                @foreach (array_slice($relatedSkills, 5) as $relatedSkill)

                <div class="col-sm-2 col-xs-6">
                    <a href="#"> {{ $relatedSkill->get('skillweight') }} {{ $relatedSkill->get('skillname') }}
<!--                        <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">-->
                    </a>
                </div>

                @endforeach
                @endif




            </div>
            <!-- /.row -->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright © Website 2017</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="/js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/js/bootstrap.min.js"></script>




    </body></html>
