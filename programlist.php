<div id="tf-programlist"><div id="tf-programlist-in"><p>
			<ul id="tf-programlist-in-title">
			<?php echo wrd('Draft_Program_List'); ?>
			</ul>
        	<ul class="programblock" id="programlist">
			
			<?php if ($login=="true") {
				$prglistsql=mysql_query("SELECT * FROM program_contains WHERE program_contain_pid='$currentuser[19]'");
				while ($readdata=mysql_fetch_assoc($prglistsql)) {
					$prgitem_id=$readdata['program_contain_cd'];
					$cdnamesql=mysql_fetch_assoc(mysql_query("SELECT * FROM cds WHERE cd_id='$prgitem_id'"));
					$draggedtitle=$cdnamesql['cd_title'];
				?>
				<li class="tf-programlist-in-item" prgid="<?php echo $prgitem_id; ?>">
				<a href="#x"  class="tf-programlist-in-item-a">
				<img height="10" width="10" src="files/images/icon-X.png"></a><?php echo $draggedtitle; ?>
				</li>
            <?php }; }; ?>
			</ul>
			<ul class="programblock">
			
         	<br /><br /><br /><br />
			</ul>
        </p>
		</div><!-- tf-programlist-in-->
		
		<div id="tf-programlist-bottom">
		
		<a href="#x" id="clearprogramdraft" class="buttonlight">Temizle</a>
		<a href="#x" id="saveprogramdraft" class="buttonlight">Yayınla</a>
		 </div>
</div><!-- tf-programlist-->