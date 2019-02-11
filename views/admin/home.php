
<?php include_once('global/header.php');?>
<?//php var_dump($params);?>
<ul>
    <li><a href="/admin/users">Utilisateurs</a></li>
    <li><a href="/admin/posts">Posts</a></li>
    <li><a href="/admin/pages">Pages</a></li>
    <li><a href="/admin/preferences">Préférences</a></li>
</ul>
<h1><?php echo($params['page_name']);?></h1>
<?php include_once('global/footer.php');?>
