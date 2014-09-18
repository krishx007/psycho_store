<title><?php echo $title ?></title>
<meta property="fb:app_id" content="601282446622582" />
<meta property="fb:admins" content="100001096628321"/>
<meta property="og:title" content= "<?php echo $title ?>" />
<meta property="og:type" content="Clothing"/>
<meta property="og:url" content=<?php echo $url ?> />
<meta property="og:image" content=<?php echo $image ?> />
<meta property="og:description" content="<?php echo $description ?>" />
<meta name="viewport" content="width=device-width">
<?php echo meta('description', $description) ?>
<?php echo meta('keywords', $keywords) ?>
<link rel="icon" type="image/png" href=<?php echo $favico ?> >

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
    	<a target="_blank" href="https://www.facebook.com/psychostorein"><i class="navbar-btn fa fa-facebook"></i></a>
      </li>
      <li>
    	<a target="_blank" href="https://twitter.com/psychostorein"><i class="navbar-btn fa fa-twitter"></i></a>
      </li>
      <li>
    	<a target="_blank" href="http://instagram.com/psychostore.in"><i class="navbar-btn fa fa-instagram"></i></a>
      </li>
      <li>
       <form class="navbar-form" method = "post" action=<?php echo site_url("search");?>>
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
      	<?php if($user_id > 0): ?>
        	<h4 class="navbar-text"> <strong> <?php echo $user_name ?> </strong></h4>
    	<?php endif; ?>
      </li>
      <li>
      	<?php  if ( $user_id == 0 ): ?> <a href= <?php echo site_url('auth')?> > <h5 class="navbar-btn">Login </h5></a>
      	<?php else: ?> <a href= <?php echo site_url('auth/logout')?> > <h5 class="navbar-btn">Logout </h5></a> <?php endif; ?>
      </li>
      <li>
        <a class="" href= <?php echo site_url('cart')?> ><i class="navbar-btn fa fa-shopping-cart"></i><span class="badge"><?php echo $num_items ?></span></a>
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




