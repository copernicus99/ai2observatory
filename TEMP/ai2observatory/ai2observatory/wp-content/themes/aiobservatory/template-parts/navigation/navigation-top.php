<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

$defaults = array(
    'theme_location'  => 'top',
    'menu'            => 'Menu Top',
    'container'       => '',
    'container_class' => '',
    'menu_class'      => 'left mob',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    //'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
    'depth'           => 0,
    'walker' => new My_Walker_Nav_Menu()

);
    wp_nav_menu($defaults); 
                        ?>
                        
                    <ul class="right">
                        <li>
                            <a href="#" data-toggle="dropdown" aria-expanded="true" rel="nofollow">
                                <i class="icon-more"></i>
                            </a>

                            <ul class="dropdown-menu pull-right mob">
                            <li class="divider">Language</li>
							<?php
                            if ( function_exists( 'pll_the_languages' ) ) {

                            $translations = pll_the_languages( array( 'raw' => 1 ) );
                            foreach ($translations as $key => $value) { ?>
                            	<li>
                                    <a href="<?php echo $value['url']?>" rel="nofollow"><?php echo $value['name']?></a>
                                </li>
                            <?php }
                        }
                            ?>                                 

                            <li class="divider"></li>
								<?php
								                            $righr_menu = array(
								    'menu'            => 'Menu Right',
								    'container'       => '',
								    'container_class' => '',
								    //'menu_class'      => 'left mob',
								    'echo'            => true,
								    'fallback_cb'     => 'wp_page_menu',
								    //'items_wrap'      => '<ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>',
								    'depth'           => 0,
								    //'walker' => new My_Walker_Nav_Menu()

								);
								    wp_nav_menu($righr_menu);
                            ?>
                            
                            </ul>
                        </li>
                    </ul>