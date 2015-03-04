<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#000" />
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/datepicker.css">

    <script src="http:/js/jquery.js"></script>    
    <script type="text/javascript" src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <script type="text/javascript" src="/js/bootstrap.js"></script> 
    <style>
        body { padding-top: 70px;
                margin-bottom: 60px;
         }
    </style>
    <title>
       Expense App
    </title>
    <script>
        $(function() {
            $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd"
    });
        });
    </script>
</head>

<body>      
    @if (Auth::check())     
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{URL::route('home') }}">TechnoCentric Expenses</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li>{{link_to_route('projects.index', 'Projects') }}</li>
                <li>{{link_to_route('report', 'Reports') }}</li>
                <li>{{link_to_route('expenses.index', 'Expenses') }}</li>
                <li>{{link_to_route('revenues.index', 'Revenues') }}</li>                           
              </ul>            
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::user()->role == 'Admin')
                            <li>{{ link_to_route('users.index', 'Users' ) }}</li>
                            <li>{{link_to_route('etypes.index', 'Expense Types') }}</li>
                            <li>{{link_to_route('rtypes.index', 'Revenue Types') }}</li> 
                            <li class="divider"></li>
                            <li>{{ link_to_route('account.dashboard', 'My Profile' ) }}</li>
                            <li>{{ link_to_route('account.edit', 'Change Password' ) }}</li>
                            <li class="divider"></li>                        
                            <li>{{link_to_route('logout_path', 'Logout' ) }} </li>
                        @else 
                            <li>{{ link_to_route('account.dashboard', 'My Profile' ) }}</li>
                            <li>{{ link_to_route('account.edit', 'Change Password' ) }}</li>
                            <li class="divider"></li>                        
                            <li>{{link_to_route('logout_path', 'Logout' ) }} </li> 
                        @endif                        
                    </ul>
                    </li>           
                </ul>                        
             
            </div><!--/.nav-collapse -->
          </div>
        </nav>
    @endif
    <div id="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-9">

                    @if (Session::has('flash_notification.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                {{ Session::get('flash_notification.message') }}
                        </div>
                    @endif

                    @yield('main')

                </div>
            </div>
        </div>
    </div>   
</body>
 <footer class="footer">
        <div id="wrap">
            <div class="col-md-3"></div>
            <div class="col-md-5">       
                <p class="text-muted credit">Expense App</p>            
            </div>
            <div class="col-md-3">
                <p> <a href="http://www.technocentric.net">Developed By TechnoCentric &reg;</a></p>
            </div>
        </div>
    </footer>    
</html>