<?php include('global/header.php');?>
<h1><?php echo($params['page_name']);?></h1>
<form method="post" action='login/admin' id="form-login-admin">
  Login: <input name='login'>
  Mot de passe : <input name='password'>
  <button type="submit">connexion</button>
  <small>Mot de passe oublié</small>
</form>

<?php include('global/footer.php');?>
