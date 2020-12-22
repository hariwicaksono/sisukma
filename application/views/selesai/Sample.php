<!-- /.content-header -->
<?php if(empty($onepmr->id_permintaan)) :?>

  <?php if($role == '1' && $access == '2') : ?>

    <?php elseif($role == '2' && $access == '2') : ?>

    <?php endif ;?>

    <?php elseif(!empty($onepmr->id_permintaan)) :?>

      <?php if($role == '1' && $access == '2') : ?>

      <?php endif ;?>
