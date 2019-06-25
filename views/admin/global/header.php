<!DOCTYPE html>
<!--header-->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo($params['page_name']);?></title>
  <link rel="stylesheet" href="/dist/main.css">
</head>
<body>
<?php if(isset($_SESSION['user'])):?>
    <p><?php if(isset($_SESSION['user'])) echo "bonjour, ".$_SESSION['user']->firstname;?><a href="/admin/logout"> Déconnexion</a></p>
<?php endif ?>
<nav id="menu-navigation-admin">  <ul>
    <?php foreach($params['routes'] as $route): ?>
        <li><a href="/admin/<?php echo $route->alias; ?>"><?php echo $route->name; ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>

<!--header end -->
