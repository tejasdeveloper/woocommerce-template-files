<?php /* Template Name: WooPage*/


get_header();

if (has_post_thumbnail( $post->ID ) ){
	//$image 			= 	wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
	$feature_img	=	wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
	$banner_img		= $feature_img[0];
}else{
	$banner_img = get_template_directory_uri()."/images/bodybg.png";
}
?>
	<?php /*?><div class="herowraper">            
        <div class="herohead" style="background-image:url(<?PHP echo $banner_img; ?>);">
            <div class="container">
                <h2 class="hero_title"><?PHP echo  get_the_title( $post->ID ); ?></h2>
            </div>
            <div class="heroheadoverlay"></div>
        </div>
    </div><?php */?>
     <div class="breadwraper">
    	<div class="container">
        	<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
			?>
        </div>
    	
    </div>
    <main id="main">	
        <section  class="woocommercecontent">
        	<div class="container">
        	<?php /*?><div class="sec_title mb-5">
                <h2><?PHP echo get_the_title();?></h2>               
            </div><?php */?>
            
                <?php /*?><div class="row ">
                 	<div class="col12"><?php */?>
                       	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <div class="post" id="post-<?php the_ID(); ?>">
                                <?php the_content( '<p class="serif">Read the rest of this page &raquo;</p>' ); ?>
                            </div>
                            <?php
                            
                            //ACGTheme::comments();
                        endwhile; endif; ?>
                    <?php /*?></div>
                </div><?php */?>  
             </div>             
            
        </section>    
    </main>
    
    

<!-- inspired by quote here:https://www.thebump.com/real-answers/questions/how-to-get-my-baby-to-fall-to-sleep-on-his-own -->
  
<?php get_footer(); ?>