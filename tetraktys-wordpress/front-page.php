<?php
/*
	Innovation Lite Theme's Front Page
	Innovation Lite Theme's Front Page to Display the Home Page if Selected
	Copyright: 2015-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Innovation Lite 1.0
*/
get_header(); ?>

<!--- ============  MAIN SLIDE  =========== ------------>
<div class="flexslider main-slider" >
<ul class="slides">

<?php foreach (range(1, 3) as $opsinumber)  { ?>

<li class="slideitem" style="background-image:url('<?php echo esc_url(innovation_get_option('slide-back' . $opsinumber, get_template_directory_uri() . '/images/slide/slideback'. $opsinumber . '.jpg')); ?>');"></li>
<?php } ?>
</ul>
</div>

<!--- ============  END OF MAIN SLIDE  =========== ------------>


<!--- ============  FEATURED BOXES  =========== ------------>
<div id="featured-box-item">
	<?php get_template_part( 'featured-box' ); ?> 
</div>
<!--- ============  END OF FEATURED BOXES  =========== ------------>


<!--- ============  PORTFOLIO  =========== ------------>
<div class="clear"></div>
<div id="portfolio-box-item">
	<h2 class="boxtoptitle" ><?php echo esc_attr(innovation_get_option('portfolioboxes-heading', 'A FEW FROM OUR PORTFOLIO')); ?></h2>
	<h4 class="boxtopdes" ><?php echo esc_textarea(innovation_get_option('portfolioboxes-heading-des', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua')); ?></h4>
  
    <div class="box90 poftfolioslider" >
    <ul class="grid-portfolio slides  cs-style-3">
    			<?php foreach (range(1,4 ) as $portfolioboxsnumber) { ?>
				<li>
					<figure>
						<div><img src="<?php echo esc_url(innovation_get_option('portfolioboxes-image' . $portfolioboxsnumber, get_template_directory_uri() . '/images/pf'.  $portfolioboxsnumber . '.png')); ?>" /></div>
                        <a href="<?php echo esc_url(innovation_get_option('portfolioboxes-link' . $portfolioboxsnumber, '#' )); ?>">
                        <figcaption>
							<h3><?php echo esc_attr(innovation_get_option('portfolioboxes-title' . $portfolioboxsnumber, 'OUR PROJECT '. $portfolioboxsnumber )); ?></h3>
							<span><?php echo esc_textarea(innovation_get_option('portfolioboxes-description' . $portfolioboxsnumber, 'Innovation Lite is a Professional Responsive Theme' )); ?></span>
                        </figcaption>
                        </a>
					</figure>
				</li>
                <?php } ?>
	</ul>
    </div>
  
    
</div>

<!--- ============  END OF PORTFOLIO  =========== ------------>


<!--- ============  HEADING  =========== ------------>
<div id="heading-box-item" class="heading1container">
	<div class="heading1vcenter">
		<h1 id="heading1" ><?php echo html_entity_decode(esc_attr(innovation_get_option('heading_text1', 'WordPress is web <em>software you can use to create websites!</em> '))); ?></h1>
		<p class="heading-desc1"><?php echo html_entity_decode(esc_textarea(innovation_get_option('heading_des1', 'It is Amazing! <em>Over 60 million people</em> have chosen WordPress to power the place on the web.'))); ?></p>
		<div class="vcenter"><a target="-blank" href="<?php echo esc_url(innovation_get_option( 'heading_btn1_link', 'http://wordpress.org' )); ?>"><button><?php echo __('Learn More', 'innovation-lite'); ?></button></a></div>
</div>
</div>
<div class="lsep"></div>
<!--- ============  END OF HEADING  =========== ------------>


<!--- ============  STAFFS  =========== ------------>
<div class="clear"></div>
<div id="staff-box-item">
	<h2 class="boxtoptitle" ><?php echo esc_attr(innovation_get_option('staffboxes-heading', 'WE ARE INSIDE')); ?></h2>
	<h4 class="boxtopdes" ><?php echo esc_textarea(innovation_get_option('staffboxes-heading-des', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua')); ?></h4>
	
			<div id="grid-staff" class="main">
				<?php foreach (range(1, 3 ) as $staffboxsnumber ) { ?>
				<div class="view-staff" >
                	<div class="view-staff-name">
                    <h3><?php echo esc_attr(innovation_get_option('staffboxes-title' . $staffboxsnumber, 'OUR PROUD STAFF '. $staffboxsnumber )); ?></h3>
                    <p><?php echo esc_attr(innovation_get_option('staffboxes-description' . $staffboxsnumber, 'Service Executive' )); ?></p>
                    </div>
                    
					<div class="view-staff-back social-link">
						<a href="<?php echo esc_url(innovation_get_option('staffboxes-linka' .$staffboxsnumber, 'http://wordpress.org' )); ?>"></a>
						<a href="<?php echo esc_url(innovation_get_option('staffboxes-linkb' .$staffboxsnumber, 'http://wordpress.org' )); ?>"></a>
                        <a href="<?php echo esc_url(innovation_get_option('staffboxes-linkc' .$staffboxsnumber, 'http://wordpress.org' )); ?>"></a>
						<a class="profile-link" href="<?php echo esc_url(innovation_get_option('staffboxes-link' . $staffboxsnumber, '#' )); ?>">&rarr;</a>
					</div>
					<img src="<?php echo esc_url(innovation_get_option('staffboxes-image' . $staffboxsnumber, get_template_directory_uri() . '/images/stf'.  $staffboxsnumber . '.jpg')); ?>" />
				
                </div>
       			<?php } ?>
			</div>
  		
</div>

<!--- ============  END OF STAFFS  =========== ------------>

<?php get_template_part( 'fcontent' ); 

 get_footer(); ?>