<?php //echo $title; ?>

	


<div class="navigation-box">
	<div class="navigation-p">
	<!-- 导航 -->
	<div class="nav-left">
		<ul>
			<?php foreach ($nav_data as $nav): ?>
			<li class="navigation" >
				<a href="<?php echo $nav['nav_link']; ?>" class="navigation-link" >
					<?php echo $nav['nav_name']; ?><?php //echo $nav['id2']; ?>
				</a>
				<?php foreach ($nav_down_data as $nav_down): ?>
				<?php
					if ($nav_down['id_down'] != $nav['id_nav']) {
						continue;
					}
					?>
				<ul class="navigation-link-down">
					<li>
						<div class="navigation-link-down">
							<a href="<?php echo $nav_down['nav_down_link']; ?>">
							<?php echo $nav_down['nav_down_name']; ?>
							</a>
						</div>
					</li>
				</ul>
				
				<?php  endforeach; ?>
			</li>
			<?php  endforeach; ?>
		</ul>
	</div>
	<div class="nav-right">
				<div class="search-bar">
					<input type="text" value="Search模块未完成" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</div>
				<ul>
					<li><a href="#"><span class="fb"> </span></a></li>
					<li><a href="#"><span class="twit"> </span></a></li>
					<li><a href="#"><span class="pin"> </span></a></li>
					<li><a href="#"><span class="rss"> </span></a></li>
					<li><a href="#"><span class="drbl"> </span></a></li>
				</ul>
	</div>
</div>
</div>
<div style="padding: 0px;"></div>
<?php
//<div class="navigation-box">
//	<div class="navigation-p">
//		<!-- 导航 -->
//		<ul>
//			<li class="navigation" >
//				<a href="index.php" class="navigation-link" >
//					Home
//				</a>
//			</li>
//			<li class="navigation">
//				<a href="anime.php" class="navigation-link">
//					Anime
//				</a>
//				<ul class="navigation-link-down">
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Anime - one
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Anime - two
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Anime - three
//							</a>
//						</div>
//					</li>
//				</ul>
//			</li>
//			<li class="navigation">
//				<a href="image.php" class="navigation-link">
//					Image
//				</a>
//				<ul class="navigation-link-down">
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Image - one
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Image - two
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Image - thr
//							</a>
//						</div>
//					</li>
//				</ul>
//			</li>
//			<li class="navigation">
//				<a href="Video.php" class="navigation-link">
//					Video
//				</a>
//				<ul class="navigation-link-down">
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Video - one
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Video - two
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Video - thr
//							</a>
//						</div>
//					</li>
//				</ul>
//			</li>
//			<li class="navigation">
//				<a href="music.php" class="navigation-link">
//					Music
//				</a>
//				<ul class="navigation-link-down">
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Music - one
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Music - two
//							</a>
//						</div>
//					</li>
//					<li>
//						<div class="navigation-link-down">
//							<a href="#">
//								Music - thr
//							</a>
//						</div>
//					</li>
//				</ul>
//			</li>
//		</ul>
//	</div>
//</div><!--	end .navigation-box    -->

?>