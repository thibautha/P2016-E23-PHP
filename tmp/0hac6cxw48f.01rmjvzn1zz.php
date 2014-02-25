<br/>
<?php foreach (($result?:array()) as $item): ?>
	<div style="border:1px solid black;width:350px;display:inline-block;vertical-align:top;">
		<span>Nom : <?php echo $item['wine_name']; ?></span>
	    <br/>
	    <div class="img" style="height:100px;width:100px;overflow:hidden;">
	    	<img style="height:120px;width:120px;" src="./avatars/<?php echo $item['wine_img']; ?>" alt="<?php echo $item['wine_img']; ?>"/>
	    </div>
	    <br/>
	    <a href="addFavWine/<?php echo $item['wine_id']; ?>"><div class="fav fav<?php echo $item['fav']; ?>"></div></a>
	</div>
<?php endforeach; ?>