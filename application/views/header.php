<head>
	<title>Psycho Store</title>
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/amelia/bootstrap.min.css">
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.js"></script>
</head>

<header>
  <div class="panel collapse navbar-collapse">
    <ul class="nav nav-pills navbar-right">
      <li>
       <form class="navbar-form " method = "post" action=<?php echo site_url("search");?>>
        <div class="form-group">          
          <input class="form-control input-sm" type="text" name="search_query" placeholder="Search for a Game">                            
        </div>
      </form>  
      </li>
      <li>
        <h4><?php if($user_id > 0) echo $user_name ?></h4>
      </li>
      <li>
        <?php  echo (  $user_id == 0 ? anchor('auth', "Login") : anchor('auth/logout', "Logout") )?>
      </li>          
      <li>
        <a href= <?php echo site_url('cart')?> ><i class="fa fa-shopping-cart"></i><span class="badge"><?php echo $num_items ?></span></a>
      </li>
    </ul>
    <ul class="nav nav-pills navbar-left">
      <a href= <?php echo site_url('') ?> ><h4>Psycho Store</h4></a>
    </ul>
  </div>
  <div class="row">
    <div class="col-xs-3 col-xs-push-5 col-sm-3 col-sm-push-5 col-md-2 col-md-push-5">
      <img class="img-responsive" src="http://cdn.shopify.com/s/files/1/0063/2872/t/4/assets/logo.png?2093">
    </div>
  </div>
</header>




