<?php include('global/header.php');?>

<div id="wrap-settings">
    <h1><?php echo($params['page_name']);?></h1>

     <table>
         <?php foreach ($params['addons'] as $k=>$addon): ?>
         <tr>
             <td>
                 <h3><?php echo $k;?></h3>
                 <small>Auteur: <?php echo $addon['author'];?></small>
             </td>
             <td>
                 <select id="addon_select">
                    <option>Modifier </option>
                    <?php if($addon['active']):?>
                     <option> module désactivé</option>
                     <option> désinstaller</option>
                    <?php else :?>
                    <?php if(!$addon['is_installed']):?>
                     <option> Installer</option>
                    <?php else: ?>
                     <option>module activé</option>
                    <?php endif; ?>
                    <?php endif; ?>
                 </select>
            </td>
         </tr>
        <?php endforeach ?>
     </table>

</div>
<?php include('global/footer.php');?>