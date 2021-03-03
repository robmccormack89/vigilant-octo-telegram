<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// get the product's cats
$terms_cats = get_the_terms($product->ID,'product_cat');
// get the product's series (all)
$terms_series = get_the_terms($product->ID,'product_series');
// get the sku
$item_sku = $product->get_sku();

// if there is series
if ($terms_series) :

  // all the series id's will be stored as an array
  $terms_series_ids = array();
  
  // for each series, we store the term_id into the array for later
  foreach($terms_series as $series) {
    $terms_series_ids[] .= $series->term_id;
  }
  $series_ids = $terms_series_ids;

  // get the series(parent only) using the using the series_ids from above
  $parent_series = get_terms([
    'taxonomy'    => 'product_series',
    'hide_empty'  => true,
    'parent' => 0,
    'include' => $series_ids,
  ]);
  // get the models(series children) using the using the series_ids from above 
  $models = get_terms([
    'taxonomy'  => 'product_series',
    'hide_empty'  => true,
    'childless' => true,
    'hierarchical'  => false,
    'include' => $series_ids,
  ]);
  
endif;
?>
<table class="woocommerce-product-attributes shop_attributes">
  
  <?php if ($terms_cats) : ?>
    
    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--cats">
      <th class="woocommerce-product-attributes-item__label">Categories:</th>
      <td class="woocommerce-product-attributes-item__value">
        <?php 
          foreach ($terms_cats as $cat) {
            $cat_names[] = $cat->name;
          };
          echo implode(", ", $cat_names);
        ?>
      </td>
    </tr>
      
  <?php endif; ?>
  
  <?php if ($terms_series) : ?>
    
    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--cats">
      <th class="woocommerce-product-attributes-item__label">Make/Manufacturer:</th>
      <td class="woocommerce-product-attributes-item__value">
        Massey Ferguson
      </td>
    </tr>
    
    <?php if ($parent_series) : ?>
    
      <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--cats">
        <th class="woocommerce-product-attributes-item__label">Series:</th>
        <td class="woocommerce-product-attributes-item__value">
          <?php 
            foreach ($parent_series as $series) {
              $series_names[] = $series->name;
            };
            echo implode(", ", $series_names);
          ?>
        </td>
      </tr>
      
    <?php endif; ?>
    
    <?php if ($models) : ?>
      
      <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--cats">
        <th class="woocommerce-product-attributes-item__label">Models</th>
        <td class="woocommerce-product-attributes-item__value">
          <?php 
            foreach ($models as $model) {
              $model_names[] = $model->name;
            };
            echo implode(", ", $model_names);
          ?>
        </td>
      </tr>
        
    <?php endif; ?>
      
  <?php endif; ?>
  
  <?php if ($item_sku) : ?>
    
    <tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--cats">
      <th class="woocommerce-product-attributes-item__label">SKU/OEM:</th>
      <td class="woocommerce-product-attributes-item__value">
        <?php echo $item_sku; ?>
      </td>
    </tr>
      
  <?php endif; ?>
  
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<th class="woocommerce-product-attributes-item__label"><?php echo wp_kses_post( $product_attribute['label'] ); ?></th>
			<td class="woocommerce-product-attributes-item__value"><?php echo wp_kses_post( $product_attribute['value'] ); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
