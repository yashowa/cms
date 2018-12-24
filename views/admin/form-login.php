
<?php include_once('global/header.php');?>
<?//php var_dump($params);?>
<h1><?php echo($params['page_name']);?></h1>

<form method="post" id="login-form">
  <input name='login'  type='text'>
  <input name='password'  type='password'>
  <button type="submit"></button>
</form>
<?php include_once('global/footer.php');?>
