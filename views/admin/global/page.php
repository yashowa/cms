
<?php require(dirname(__FILE__).'/global/header.php');?>


<div class="content-page">
  <?php echo dirname(__FILE__);?>
  <h1><?php echo($params['page_name']);?></h1>
  <?php echo $params['content'];?>
</div>


<?php require(dirname(__FILE__).'/global/footer.php');?>
