<!DOCTYPE html>
<!--header-->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title><?php echo($params['page_name']);?></title>
  <link rel="stylesheet" href="/dist/main.css">
</head>
<body>
  <pre>
<?php var_dump($_SESSION);?>
</pre>
  <?php $notifications = isset($_SESSION['notification'])?$_SESSION['notification']:null;?>

  <div class="notification-bar <?php if(isset($params['success']) || isset($notifications['message'])): ?>fadeOut success<?php elseif(isset($params['errors']) || isset($notifications['errors'])):?> fadeOut danger<?php endif;?>" id="notification-bar">
        <?php if(isset($notifications) && $notifications!=null): //cookie test  notifications?>
            <?php if(isset($notifications['message'])): ?>
            <?php echo $notifications['message']; ?>
          <?php elseif(isset($notifications['errors'])):?>
              <ul class="danger">
              <?php foreach($notifications['errors'] as $error): ?>
                <li><?php echo $error;?></li>
              <?php endforeach; ?>
              </ul>
            <?php endif;?>

        <?php endif; ?>

        <?php if(isset($params['success'])): ?>
          <?php  echo $params['success']; ?>
        <?php elseif(isset($params['errors'])):?>
          <ul class="danger">
          <?php foreach($params['errors'] as $error): ?>
            <li><?php echo $error;?></li>
          <?php endforeach; ?>
          </ul>
        <?php endif;?>
    </div>
      <?php if(isset($params['success'])): ?>
      <?php  echo $params['success']; ?>
      <?php elseif(isset($params['errors'])):?>
        <ul class="danger">
        <?php foreach($params['errors'] as $error): ?>
          <li><?php echo $error;?></li>
        <?php endforeach; ?>
        </ul>
      <?php endif;?>
  </div>



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
