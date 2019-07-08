<?php include('global/header.php');?>

<div id="wrap-users">
  <h1><?php echo($params['page_name']);?></h1>

  <a href="/admin/user/new" class="btn btn-add js-add-user success">Ajouter un nouvel utilisateur</a>

  <table id="table-users">
    <thead>
        <tr>
          <th>n° Id</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>Adresse email</th>
          <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php if(count($params['users'])>0):?>
              <?php foreach ($params['users'] as $key => $user):?>
                <tr id="user-<?php echo $user['id_user']; ?>">
                  <td><?php echo $user['id_user'] ?></td>
                  <td><?php echo $user['firstname'] ?></td>
                  <td><?php echo $user['lastname'] ?></td>
                  <td><?php echo $user['email'] ?></td>
                  <td>
                    <a class="btn btn-default" href="/admin/user/<?php echo $user['id_user'];?>">Modifier<a>
                    <a class ="btn danger js-delete-user" href="/admin/user/<?php echo $user['id_user'];?>/delete">Supprimer<a>
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
