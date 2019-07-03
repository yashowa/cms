<?php include('global/header.php');?>

<h1><?php echo($params['page_name']);?></h1>





<?php if(isset($params['success'])):?>
    <p class="success"><?php echo $params['success'];?></p>
<?php endif; ?>

<form id="form-page" method="post" action="<?php echo $params['url'];?>">
  <input type="text" name="name" placeholder="Titre de la page" value="<?php echo(isset($params['page'])?$params['page']['name']:"");?>"/>
  <input type="text" name="alias" placeholder="Alias" value="<?php echo(isset($params['page'])?$params['page']['alias']:"");?>"/>
<textarea id="form-page-content"></textarea>

  <select name="profile" id="profile">
    <option value=""  <?php if(!isset($params['page'])) echo"selected disabled hidden";?>>Etat de la page</option>
    <option value="1" <?php if(isset($params['page']) && $params['page']['published']=='1')echo "selected";?>>publiée</option>
    <option value="2" <?php if(isset($params['page']) && $params['page']['published']=='0')echo "selected";?>>inactive</option>
  </select>
  <button type="submit" class="success <?php echo(isset($params['page'])?js-update-page:"js-create-page");?>"><?php echo $params['submit'];?></button>
</form>

<?php include('global/footer.php');?>
