<p><?php echo $beta; ?> </p>
       <?php foreach (($result?:array()) as $item): ?>
    <span>user : <?php echo $item['user_lastname']; ?> <?php echo $item['user_firstname']; ?></span></br>
<?php endforeach; ?>