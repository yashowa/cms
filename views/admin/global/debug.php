<?php if(isset($_GET['debug']) && $_GET['debug']):?>

<pre>
<?php var_dump($_SESSION);?>

</pre>


    <?php var_dump($params['page']); ?>

  <?php endif;?>
