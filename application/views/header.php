<title>Psycho Store</title>
<meta property="fb:app_id" content="601282446622582" />
<meta property="fb:admins" content="100001096628321"/>
<meta property="og:title" content="Psycho Store"/>
<meta property="og:type" content="Clothing"/>
<meta property="og:url" content="http://www.psychostore.in/"/>
<meta property="og:image" content=""/>
<meta property="og:description" content="Clothing inspired by your favorite Video Games" />
<meta name="viewport" content="width=device-width">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic+SC' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.js"></script>
<link rel="stylesheet" href=<?php echo site_url('manual.css')?>>
</head>

<header>
  <nav class="panel collapse navbar-collapse">
    <ul class="nav nav-pills navbar-right ">
      <li>
       <form class="navbar-form " method = "post" action=<?php echo site_url("search");?>>
        <div class="btn-group">
          <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" href="#">Select A Game <span class="caret"></span>  </a>
          <ul class="dropdown-menu">
            <?php foreach ($supported_games as $key => $game):?>
              <li>
                <a href=<?php $url = url_title($game['product_game'],'_'); echo site_url("search/$url")?>> <?php echo $game['product_game'] ?></a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      </form>  
      </li>
      <li>
        <h4 class="molot"><?php if($user_id > 0) echo $user_name ?></h4>
      </li>
      <li>
        <?php  echo (  $user_id == 0 ? anchor('auth', "Login") : anchor('auth/logout', "Logout") )?>
      </li>
      <li>
        <a href= <?php echo site_url('cart')?> ><i class="fa fa-shopping-cart"></i><span class="badge"><?php echo $num_items ?></span></a>
      </li>
    </ul>
    <ul class="nav nav-pills navbar-left">
      <a href= <?php echo site_url('') ?> ><h4 class='molot'>Psycho Store</h4></a>
    </ul>
  </nav>
  
</header>

<body>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</body>




