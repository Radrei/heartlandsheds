<?php 
/*
This code allows you to view the price of a variation on hover when using the plugin Variation Swatches for WooCommerce
*/
?>
<?php 
if($product->is_type('variable')){
    foreach($product->get_available_variations() as $variation ){
        // Variation ID
        $variation_id = $variation['variation_id'];

        // Attributes
        $attributes = array();
        foreach( $variation['attributes'] as $key => $value ){
            $taxonomy = str_replace('attribute_', '', $key );
            $taxonomy_label = get_taxonomy( $taxonomy )->labels->singular_name;
            $term_name = get_term_by( 'slug', $value, $taxonomy )->slug;
            $attributes[] = $term_name;
        }

        // Prices
        $active_price = floatval($variation['display_price']); // Active price
        $regular_price = floatval($variation['display_regular_price']); // Regular Price
        if( $active_price != $regular_price ){
            $sale_price = $active_price; // Sale Price
        } ?>
		<script> 
		jQuery(document).ready(function( $ ) {
			var activePrice = '<?php echo $active_price; ?>';
			var variationSize = '<?php echo $attributes[0]; ?>';
			var variationZone = '<?php echo $attributes[1]; ?>';
			if(variationZone == 'zone1'){				
				$('li.variable-item[data-value=' + variationSize + ']').attr('data-wvstooltip', '$' + activePrice);
			}
		});	
		
		</script>
    <?php }
}?>
