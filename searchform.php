<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-search" >
    
   
    <?php if(class_exists('WooCommerce')): ?>
        
    <input type="hidden" value="product" name="post_type"  id="post_type" />
        <?php endif; ?>
        <input type="checkbox"  id="show_textbox" >
        <label for="show_textbox" id="show_textbox_label" ></label>
        <input type="text" name="s" id="s" placeholder="<?php esc_attr_e( 'Search' ); ?>" class="search-text" />
    <button type="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search' ); ?>">
    <!-- <img src="<?php //echo(get_template_directory_uri() . 'assets/svgs/search-solid.svg');  ?>" alt=""> -->
    <span class="dashicons dashicons-search"></span>
    </button>
</form>