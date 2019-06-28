<?php include('global/header.php');?>

<h1><?php echo($params['page_name']);?></h1>





<?php if(isset($params['success'])):?>
    <p class="success"><?php echo $params['success'];?></p>
<?php endif; ?>

<form id="form-user" method="post" action="<?php echo $params['url'];?>">
  <input type="text" name="lastname" placeholder="Nom" value="<?php echo(isset($params['user'])?$params['user']['lastname']:"");?>"/>
  <input type="text" name="firstname" placeholder="Prénom" value="<?php echo(isset($params['user'])?$params['user']['firstname']:"");?>"/>
  <input type="mail" name="email" placeholder="Adresse E-mail" value="<?php echo(isset($params['user'])?$params['user']['email']:"");?>"/>
  <input type="password" name="password" placeholder="Mot de passe" value="<?php echo(isset($params['user'])?$params['user']['passwd']:"");?>"/>
  <select name="profile">
    <option value=""  <?php if(!isset($params['user'])) echo"selected disabled hidden";?>>Sélection du rôle</option>
    <option value="1" <?php if(isset($params['user']) && $params['user']['id_profile']=='1')echo "selected";?>>Administrateur</option>
    <option value="2" <?php if(isset($params['user']) && $params['user']['id_profile']=='2')echo "selected";?>>Super Administrateur</option>
    <option value="3" <?php if(isset($params['user']) && $params['user']['id_profile']=='3')echo "selected";?> >Consultation</option>
  </select>
  <button type="submit" class="success <?php echo(isset($params['user'])?js-update-user:"js-create-user");?>"><?php echo $params['submit'];?></button>
</form>
<?php include('global/footer.php');?>
