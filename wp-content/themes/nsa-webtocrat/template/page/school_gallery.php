
<?php
            $q_eg = mysql_query("select * from education_grades where eg_id = '".$_GET['eg_id']."'");
            $r_eg = mysql_fetch_array($q_eg);

            $header_img = $r_eg['eg_header_img'];
        ?>
	<div class="wrapHeader rich_text">
		<div class="headerpage">
			<img src="<?php echo home_url(); ?>/wp-content/uploads/images/education_grade/<?= $header_img ?>" alt="" />
		</div>
	</div><!-- end.wrapTop -->
		
		
	<div class="wrapContent rich_text">
		
			<div class="second_menu" style="background:#F7931C !important;">
				<div class="inner">

					

						<ul id="menu-top-menu" class="top-menu">
						<?php
							$query_school_menu = mysql_query("select * from education_grade_menus where eg_id = '".$_GET['eg_id']."' order by egm_id");
							while($row_school_menu = mysql_fetch_array($query_school_menu)){
									
						?>
						<li id="" class="menu-item menu-item-type-post_type menu-item-object-page">
							<a title="Home" href="?page_content=<?= $row_school_menu['eg_link'] ?>&eg_id=<?= $_GET['eg_id']?>&egm_id=<?= $row_school_menu['egm_id']?>"><?= ucwords($row_school_menu['eg_name']); ?></a>
						</li>
						<?php
							}
						?>
					
						</ul>


					<div class="clear_fix"></div>
				</div>
			</div>

				<?php
						
						$query = mysql_query("select * from education_grade_menus where egm_id = '".$_GET['egm_id']."' ");
						$row = mysql_fetch_array($query);
						
						
						?>
		
			<div class="wrapcontentpage">
            <div class="container">
				<div class="col-md-3 col-md-offset-1">
                
					<div class="nsasubmenu bg_profile bg_profile_new">
						<h1 class="htp_new"><?= ucwords($row['eg_name']) ?></h1>
						
					</div>
					
				</div>
				<div class="col-md-6">
					

						

						
						
							<h2><?= ucwords($row['eg_name']) ?></h2>
							
				  <div id="TabbedPanels1" class="TabbedPanels">
							<ul class="TabbedPanelsTabGroup">
							    <li class="TabbedPanelsTab" tabindex="0">News</li>
							    <li class="TabbedPanelsTab" tabindex="0">Gallery</li>
				    		</ul>
							  <div class="TabbedPanelsContentGroup">
							    <div class="TabbedPanelsContent">
                                
                                <?php
			                    $q_adm2 = mysql_query("select * from education_grade_galleries where egm_id = '".$_GET['egm_id']."' and type = '1'  order by egg_id ");
								while($r_adm2 = mysql_fetch_array($q_adm2)){
								?>
			                  	
									<div class="box-showcase_new">
										<a href="?page_content=school_gallery_detail&eg_id=<?= $_GET['eg_id']?>&egm_id=<?= $_GET['egm_id']?>&egg_id=<?= $r_adm2['egg_id'] ?>" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet">
			                            <div class="box-showcaseInner_new2">
			                                
			                            <img src="<?php echo home_url(); ?>/wp-content/uploads/images/gallery/<?= $r_adm2['img'] ?>" alt="" />
			                            </div>

			                             <div class="box-showcaseDesc_new">
				                            <div class="box-showcaseDesc_name_new">
				                            	<div class="school_subtitle">
				                            		<?= $r_adm2['name'] ?>
				                            	</div>
				                            </div>
				                             <div class="box-showcaseDesc_content_new"><?= $r_adm2['content'] ?></div>
				                            <div class="box-showcaseDesc_by_new"><?= $r_adm2['date'] ?></div>
				                        </div>
			                       	 	</a>
									</div>
								
			                    <?php
								}
								?>
                                	
                                </div>
							    <div class="TabbedPanelsContent">

							    <?php
			                    $q_adm3 = mysql_query("select * from education_grade_galleries where egm_id = '".$_GET['egm_id']."'  and type = '2'  order by egg_id ");
								while($r_adm3 = mysql_fetch_array($q_adm3)){
								?>
			                  	
									<div class="box-showcase_new2">
										<a class="fancybox" href="<?php echo home_url(); ?>/wp-content/uploads/images/gallery/<?= $r_adm3['img'] ?>" data-fancybox-group="gallery" title="<?= $r_adm3['name'] ?>">
			                            <div class="box-showcaseInner_new2">
			                                
			                                <img src="<?php echo home_url(); ?>/wp-content/uploads/images/gallery/<?= $r_adm3['img'] ?>" alt="" />
			                                <div class="box-showcaseDesc_new2"><?= $r_adm3['name'] ?></div>
			                                
			                            </div>
			                       	 	</a>
									</div>
								
			                    <?php
								}
								?>

							    </div>
				    </div>
				  </div>

			                    
						
						
						
					
				</div>
				<div class="clear_fix"></div>
			</div>
		</div>
		<div class="ornamentP"><img src="<?php echo WEBTOCRAT_IMAGE_URI; ?>/ornamentP.png" alt="" /></div>
	</div><!-- end.wrapContent -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
