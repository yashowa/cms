<?php include('global/header.php');?>

<div id="wrap-users">
  <h1><?php echo($params['page_name']);?></h1>

  <a href="user/new" class="js-add-user">Ajouter un nouvel utilisateur</a>

  <table>
    <thead>
        <tr>
          <th>n° Id</th>
          <th>Prénom</th>
          <th>Nom</th>
          <th>email</th>
        </tr>
    </thead>
    <tbody>
      <?php if(count(users)>0):?>
              <?php foreach ($params['users'] as $key => $user):?>
                <tr>
                  <td><?php echo $user['id_user'] ?></td>
                  <td><?php echo $user['firstname'] ?></td>
                  <td><?php echo $user['lastname'] ?></td>
                  <td><?php echo $user['email'] ?></td>
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
