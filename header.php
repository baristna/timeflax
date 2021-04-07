<div id="tf-header"><!-- UST BÖLÜM -->
    <div id="tf-header-main"> <!-- GRİ KUŞAK -->
     	<div id="tf-header-main-in">
               <div id="tf-header-main-in-logo"><!-- LOGO BÖLGESİ -->
               		<a href="index.php" style="display:block;" ><img src="files/images/LOGO.png" height="50" /> </a>
               </div>
               <div id="tf-header-main-in-left"><!-- ARAMA BÖLÜMÜ -->
               		<ul class="menubarleft">
                    	<li><a href="countdowns.php"><img src="files/images/icon-Wait.png" /></a></li>
                    	<li><a href="programs.php"><img src="files/images/icon-Program.png" /></a></li>
                    	<li><a href="users.php"><img src="files/images/icon-Users.png" /></a></li>
                    </ul>
                    <form action="<?php echo $thispage->searchpage; ?>" method="get">
                    	<a href="#4"><img src="files/images/icon-Search.png" /></a>
						
                        <input type="text" name="search" id="search" 
							placeholder="<?php echo wrd('Search'); ?>..."
							value="<?php if(isset($_GET['search'])) { echo $_GET['search']; }; ?>" />
							<?php if(isset($_GET['search'])) { ?> 
								<a href="<?php echo $thispage->createurl('search'); ?>" class="buttondark" /> <?php echo wrd('Remove_Search'); ?> </a>
							<?php }; ?>
							
                    	<input type="submit" style="display:none" />
                    </form>
               </div><!--tf-header-main-in-left-->
               <div id="tf-header-main-in-right"><!-- MENU BAR -->
			   <div style="color:#FFF; position:absolute; background-color:#222; margin-top:52px; width:900px; margin-left:200px; display:none;">asd</div>
                        <ul class="menubarright">
                        	<li class="rightside"> </li>
               				<?php if ($login=="false") { ?>
								<li> <a href="login.php"><?php echo wrd('Register'); ?></a> </li>
								<li class="subclick block"> <a><?php echo wrd('Login'); ?></a>
									<ul>
									<form action="action.php" method="post" style="display:inline;">
									<?php echo wrd('Username_or_Mail'); ?> <input type="text" class="tflogintext" name="s_username" />
									<?php echo wrd('Password'); ?> <input type="password" class="tflogintext" name="s_password" />
									<input type="submit" value="<?php echo wrd('Apply'); ?>" class="buttondark"  />
									</form>  <br />
									<a class="buttondark" href="login.php"><?php echo wrd('Forgot_Password'); ?></a>
									<a class="buttondark facebook-button" href="#3"><?php echo wrd('Facebook_Login'); ?></a>
									</ul>
								</li>
               				<?php } else { ?>
								<li class="submenu"> <a href="my.php"><img src="files/avatars/<?php echo $currentuser['avatar']; ?>.jpg" class="profile" /> <span class="arrow">&#9660 </span></a> 
									<ul>
										<li> <a href="my.php?stage=st_mypage"><?php echo wrd('My_Page'); ?>
											<?php 
											if (isset($_COOKIE['notification'])) { ?>
											<font color="#FFFFA9">(<?php echo $_COOKIE['notification']; ?>)</font>
											<?php }; ?></a></li>
										<li> <a href="my.php?stage=st_settings"><?php echo wrd('Settings'); ?></a></li>
										<li> <a href="action.php?logout=true"><?php echo wrd('Logout'); ?></a> </li>
									</ul>
								</li>
								<li> <a href="index.php?select=subscribe"> <img src="files/images/subscribe-sw.png" /> </a> </li>
								<?php if($thispage->pagename=='countdowns.php' || $thispage->pagename=='my.php' || $thispage->pagename=='user.php'){ ?>
								<li> <a href="#" id="programCreating" title="<?php echo wrd('Edit_Draft_Program'); ?>"><img id="creatingswich" src="files/images/plus.png" /></a> </li>
                    		 	<?php }; ?>
							 <?php }; ?>
                            <!--<li> <a href="#x" title="<?php echo wrd('Soon'); ?>"><img src="files/images/googlestore.png" /></a> </li>
                            <li> <a href="#x" title="<?php echo wrd('Soon'); ?>"><img src="files/images/appstore.png" /></a> </li>
                            <li> <a href="#x" title="<?php echo wrd('Soon'); ?>"><img src="files/images/winstore.png" /></a> </li>-->
                        	<li class="leftside"> </li>
                        </ul>
						
							
               </div><!--tf-header-main-in-menu-->
		</div><!--tf-header-main-in-->
    </div><!--tf-header-main-->
</div><!--tf-header-->