<html lang="en"><head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Skills</title>

        <!-- Bootstrap Core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/portfolio-item.css" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <!-- Square card -->
        <style>
            body {
                background-color: #FAFAFA;
                color : #ff4081;
            }
            .demo-card-square.mdl-card {
                max-width: 200px;        
                margin:8px;
            }
            .demo-card-square > .mdl-card__title {
                color: #fff;
            }

            .demo-card-wide.mdl-card {
                max-width: 200px;  
                margin:8px;
            }
            .demo-card-wide > .mdl-card__title {
                color: #fff;
                height: 176px;

            }
            .demo-card-wide > .mdl-card__menu {
                color: #fff;
            }
            .mdl-button.mdl-button--colored {
                color: #ff4081;
            }
            .mdl-chip {
                margin: 4px 0px;
                background-color: rgba(30, 142, 233, 0.13);
                box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
            }
            .mdl-button--icon {
                font-size: 15px;
            }
            h1, h2, h3, h1 small{
                color: #00BCD4;
            }

            h4{
                margin: 5px 0 16px;
            }
            .well{
                background: #fff;
                border-radius: 2px;
                box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
            }
        </style>
    </head>

    <body>

        <!-- Page Content -->
        <div class="container">

            <!-- Portfolio Item Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> {{strtoupper($selectedSkill)}}
                        <small>Top Related Skills based on {{ $totalPosts }} posts</small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <!-- Portfolio Item Row -->
            <div class="row">
                <div class="col-md-7">
                    @if(isset($selectedSkill))
                    @foreach (array_slice($relatedSkills, 0,6) as $relatedSkill)
                    <div class="col-sm-4 col-xs-4" >
                        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title" style=" background: url('/img/{{$relatedSkill->get('skillname')}}-original.svg') center / cover;">
                                <!--                            <h2 class="mdl-card__title-text">Welcome</h2>-->
                            </div>
                            <!--                        <div class="mdl-card__supporting-text">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                        Mauris sagittis pellentesque lacus eleifend lacinia...
                                                    </div>-->
                            <div class="mdl-card__actions mdl-card--border">
                                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/index.php/stats/{{$relatedSkill->get('skillname')}}">
                                    {{strtoupper($relatedSkill->get('skillname'))}} ({{$relatedSkill->get('skillweight')}})
                                </a>
                            </div>
                            <div class="mdl-card__menu">
                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
    <!--                                <i class="material-icons">share</i>-->
                                    {{ round($relatedSkill->get('skillweight') / $totalPosts * 100)}}%
                                </button>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif
                </div>

                <div class="col-md-5">
                    <div class="well">
                        <h4>Search skill</h4>
                        <div class="form-group">

                            <select class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = '/index.php/stats/' + this.options[this.selectedIndex].value)">
                                <option>Select...</option>
                                @foreach($skillsArr as $skill)
                                <option vlaue="{{ $skill }}" > {{ $skill }}  </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.input-group -->
                    </div>

                    <img class="img-responsive" src="/img/{{$selectedSkill}}-original.svg" alt="" style="max-width: 750px; max-height: 300px;">
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
                @foreach (array_slice($relatedSkills, 6) as $relatedSkill)

                <div class="col-sm-2 col-xs-6">
                    <span class="mdl-chip mdl-chip--contact mdl-chip--deletable">
                        <a href="/index.php/stats/{{$relatedSkill->get('skillname')}}" >
                            <img onerror="this.src=''" class="mdl-chip__contact" src="/img/{{$relatedSkill->get('skillname')}}-original.svg"></img>
                            <span class="mdl-chip__text"> {{ $relatedSkill->get('skillweight') }} {{ $relatedSkill->get('skillname') }} {{ round($relatedSkill->get('skillweight') / $totalPosts * 100)}}%</span>
                            <a class="mdl-chip__action"></a>
                        </a>
                    </span>
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

        <!--https://getmdl.io -->
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    </body></html>
