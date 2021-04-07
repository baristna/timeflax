<div id="tf-endinfo">
	<div id="tf-endinfo-in" style="font-size:13px; text-align:right; color:#333333; line-height:20px; vertical-align:middle;"> 
		<div class="left" style="width:550px">
			<a href="info.php?node=about"><?php echo wrd('About'); ?></a> &bull;
			<a href="info.php?node=help"><?php echo wrd('Help'); ?></a> &bull;
			<a href="info.php?node=blog"><?php echo wrd('Blog'); ?></a> &bull;
			<a href="info.php?node=contact"><?php echo wrd('Contact'); ?></a> &bull;
			<a href="info.php?node=terms"><?php echo wrd('Terms_of_Service'); ?></a> &bull;
			<a href="info.php?node=policy"><?php echo wrd('Privacy_Policy'); ?></a> &bull;
			<a href="info.php?node=advertising"><?php echo wrd('Advertising'); ?></a> &bull;
			<a href="info.php?node=faq"><?php echo wrd('FAQ'); ?></a><br />
			<a href="info.php?node=using"><?php echo wrd('Using_timeflax'); ?></a>
			
		</div>
		<div class="right">
			<b>timeflax.com &copy;2013 &bull; <a href="#x" id="changelaguage"><?php echo wrd('pagelang'); ?></a> </b><br /> 
			<?php if ($login=="false") { ?>
			<a href="login.php"><?php echo wrd('Login'); ?></a> &bull;
			<a href="login.php"><?php echo wrd('Register'); ?></a>  &bull; 
			<a href="login.php"><?php echo wrd('Forgot_Password'); ?></a>  <br /><br />
			<?php }; ?>
		
		</div>
		<div style="clear:both"></div>
	</div>
</div>