<br/>
<?php foreach (($result?:array()) as $item): ?>
	<div style="border:1px solid black;width:350px;display:inline-block;vertical-align:top;">
		<span>Nom : <?php echo $item['user_lastname']; ?></span>
	    <br/>
	    <span>Prénom : <?php echo $item['user_firstname']; ?></span>
	    <br/>
	    <div class="img" style="height:100px;width:100px;overflow:hidden;">
	    	<img style="height:120px;width:120px;" src="./avatars/<?php echo $item['user_img']; ?>" alt="<?php echo $item['user_img']; ?>"/>
	    </div>
	    <br/>
	    <a href="addFavUser/<?php echo $item['user_id']; ?>"><div class="fav <?php echo $fav; ?>"></div></a>
	</div>
<?php endforeach; ?>