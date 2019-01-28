
<?php include_once('global/header.php');?>

<h1><?php echo($params['page_name']);?></h1>

<form method="post" id="login-form">
  <div class='form-input'>
    <input name='email' type='text'  placeholder='Login / E mail'>
  </div>
  <div class='form-input'>
    <input name='password'  type='password' placeholder='Mot de passe'>
  </div>
  <small><a href='#'>Mot de passe oublié</a></small>
  <button type="submit" class="btn-action">Connexion</button>
</form>

<?php include_once('global/footer.php');?>
