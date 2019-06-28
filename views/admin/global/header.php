<!DOCTYPE html>
<!--header-->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo($params['page_name']);?></title>
  <link rel="stylesheet" href="/dist/main.css">
</head>
<body>
<p class="notification-bar <?php if(isset($params['success'])): ?>fadeOut success<?php elseif(isset($params['errors'])):?> fadeOut danger<?php endif;?>" id="notification-bar">
    <?php if(isset($params['success'])): ?>
        <?php  echo $params['success']; ?>
    <?php elseif(isset($params['errors'])):?>
      <ul class="danger">
      <?php foreach($params['errors'] as $error): ?>
        <li><?php echo $error;?></li>
      <?php endforeach; ?>
      </ul>
    <?php endif;?>
</p>

<?php if(isset($_SESSION['user'])):?>
    <p><?php if(isset($_SESSION['user'])) echo "bonjour, ".$_SESSION['user']->firstname;?><a href="/admin/logout"> Déconnexion</a></p>
<?php endif ?>

<?php if(isset($params['routes'])):?>
<nav id="menu-navigation-admin">
    <ul>
    <?php foreach($params['routes'] as $route): ?>
        <li><a href="/admin/<?php echo $route->alias; ?>"><?php echo $route->name; ?></a></li>
    <?php endforeach; ?>
    </ul>
</nav>
<?php endif ?>

<!--header end -->
