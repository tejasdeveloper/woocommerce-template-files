<?PHP 
	function customtheme_add_woocommerce_support()
	{
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'customtheme_add_woocommerce_support' );
	
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
	add_action( 'after_setup_theme', 'woogallery_support' );
	
	function woogallery_support() {
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
	
	
	/* Minicart Custom*/
	function custom_mini_cart() { 
		if(WC()->cart->get_cart_contents_count()==0){
			$cartcount = '';
		}else{ $cartcount = WC()->cart->get_cart_contents_count(); }
		echo '<a href="#" class="minicartlink" data-toggle="dropdown"> ';
		echo '<i class="fas fa-shopping-cart"></i>';
		echo '<div class="basket-item-count" style="display: inline;">';
		echo '<span class="cart-items-count count" id="mini-cart-count">';
			echo $cartcount;
		echo '</span>';
		echo '</div>';
		echo '</a>';
		echo '<div class="minicartbox" style="display:none;"><ul class="dropdown-menu dropdown-menu-mini-cart">';
		echo '<li> <div class="widget_shopping_cart_content">';
				  woocommerce_mini_cart();
			echo '</div></li></ul></div>';
	
	}
	add_shortcode( 'custom-techno-mini-cart', 'custom_mini_cart' );

	add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
	function wc_refresh_mini_cart_count($fragments){
		ob_start();
		$items_count = WC()->cart->get_cart_contents_count();
		?>
	   <span class="cart-items-count count" id="mini-cart-count"><?php echo $items_count ? $items_count : '&nbsp;'; ?></span>
		<?php
			$fragments['.cart-items-count'] = ob_get_clean();
		return $fragments;
	}
	/* Minicart end here*/
	
	add_shortcode( 'featuredProduct', 'featuredProductHome' );
	function featuredProductHome(){	
		
	
		$args = array(
            'post_type' => 'product',
            'posts_per_page' => 12
            );
			
		ob_start();	
		echo '<div class="homeproductslider">
              	<div class="owl-carousel owl-theme">';
				
        		$allProducts = new WP_Query( $args );
				if ( $allProducts->have_posts() ) {
					while ( $allProducts->have_posts()){ $allProducts->the_post(); 
						//global $product;
						$productID 	= $allProducts->post->ID;
						$productImg = wp_get_attachment_image_src( get_post_thumbnail_id( $allProducts->post->ID ), 'single-post-thumbnail' );
						$product = wc_get_product( $productID );
						$rating  = $product->get_average_rating();
						$count   = $product->get_rating_count();
						//print_r($product);
						
						
					?>
                
                        <div class="item">
                            <div class="productslide">                        	
                                <div class="productphoto">
                                    <img src="<?PHP echo $productImg[0];?>" />
                                </div>
                                <div class="productdetail">
                                    <h3><?PHP echo get_the_title($allProducts->post->ID);?></h3>
                                    <p class="productprice"><?PHP echo $product->get_price_html(); ?></p>
                                    <p><?PHP //echo wc_get_rating_html( $rating, $count );?></p>
                                    <div class="productsocial">
                                    	<ul>
                                        	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        	<li><a href="#"><i class="fa fa-google-plus"></i></a></li>                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                                  
                    
			<?PHP } ?>			
			</div>
           </div>
                <script>
                jQuery('.owl-carousel').owlCarousel({
					loop:true,
					margin:10,
					nav:true,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:2
						},
						1000:{
							items:3
						}
					}
				})
                </script>
        <?PHP 
        } else {
            echo __( 'No products found' );
        }
        wp_reset_postdata();
		
		$productHTML = ob_get_clean();
		return $productHTML;
	}
?>