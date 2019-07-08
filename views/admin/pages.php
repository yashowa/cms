<?php include('global/header.php');?>
<div id="wrap-pages">
  <h1><?php echo($params['page_name']);?></h1>

  <a href="/admin/page/new" class="btn btn-add js-add-page success">Créer une nouvelle page</a>

  <table class="tablesort" id='table-pages'>
    <thead>
        <tr>
          <th>n° Id</th>
          <th>Nom</th>
          <th>Alias</th>
          <th>Active</th>
          <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php if(count($params['pages'])>0):?>
              <?php foreach ($params['pages'] as $key => $page):?>
                <tr id="page-<?php echo $page['id']; ?>">
                  <td><?php echo $page['id'] ?></td>
                  <td><?php echo $page['name'] ?></td>
                  <td><?php echo $page['alias'] ?></td>
                  <td><?php echo $page['published'] ?></td>
                  <td>
                    <a class="btn btn-default" href="/admin/page/<?php echo $page['id'];?>">Modifier<a>
                    <a class ="btn danger js-delete-page" href="/admin/page/<?php echo $page['id'];?>/delete">Supprimer<a>
                  </td>
                </tr>
              <?php endforeach;?>
      <?php else: ?>
      <tr>
        <td>Vide</td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
<?php include('global/footer.php');?>
