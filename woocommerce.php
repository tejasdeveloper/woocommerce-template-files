<?php get_header(); 
	/*if( is_shop() ) {
		$banner_img = get_template_directory_uri()."/images/bodybg.png";
	}
	else if(is_product()){
			$banner_img = get_template_directory_uri()."/images/bodybg.png";
	}
	else if (has_post_thumbnail( $post->ID ) ){
		//$image 			= 	wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
		$feature_img	=	wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
		$banner_img		= $feature_img[0];
	}else{
		$banner_img = get_template_directory_uri()."/images/bodybg.png";
	}*/
?>

    
	<?php /*?><div class="herowraper" style="background-image:url(<?PHP echo $banner_img;?>);">            
        <div class="herohead">
            <div class="container">
                <h2 class="hero_title"><?PHP if ( is_shop() ){ echo "SHOP";}else{ echo  get_the_title( $post->ID ); } ?></h2>
            </div>
             <div class="heroheadoverlay"></div>
        </div>
    </div><?php */?>
    <?PHP if( is_shop() ){?>    	
        <div class="shopwraper woocommercecontent">
            <div class="container">
            	<div class="woorow">                	
                    <div class="wooproducts">
                    	<?php woocommerce_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?PHP }else{ ?>    
    
	<div class="contentwrapper">
		<section class="main-content innerpage woocommercecontent">
			<div class="container">
				<?php woocommerce_content(); ?>
			
			</div>
		</section>
	</div>
    
    <?PHP } ?>
<?php get_footer(); ?>