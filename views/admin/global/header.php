<!DOCTYPE html>
<!--header-->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo($params['page_name']);?></title>
  <link rel="stylesheet" href="/assets/css/admin/style.css">
</head>
<body>
<nav id="menu-navigation-admin">
  <ul>
    <?php foreach($params['routes'] as $route): ?>
        <li><a href="/page/<?php echo $route->alias; ?>"><?php echo $route->name; ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>

<!--header end -->
