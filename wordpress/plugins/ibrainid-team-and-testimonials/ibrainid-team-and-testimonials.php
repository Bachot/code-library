<?php
/*
* Plugin Name: ibrainiD Team and Testimonials
* Description: Create team biography and testimonials
* Version: 1.0
* Author: Bachot Mpunga
* Author URI: www.bachotdesign.com
* License: GPLv2 or later
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 
Copyright 2017 IbrainiD.
*/
/********************** ======================== ******************************/
/********************** ==== External Links ==== ******************************/
/********************** ======================== ******************************/

include( plugin_dir_path( __FILE__ ) . 'ibrainid-tt-custom-post.php');
include( plugin_dir_path( __FILE__ ) . 'ibrainid-tt-metaboxes.php');
include( plugin_dir_path( __FILE__ ) . 'ibrainid-tt-settings.php');

function ibrainid_tt($cat, $cssclass, $imgsize, $buttontext) {
	$args = array( 
			'post_type' => 'ibrainid_tt', 
			'posts_per_page' => 10,
			'tax_query'   => array(
					array(
						'taxonomy' => 'ibrainid_tt_category',
						'field'    => 'slug',
						'terms'    => $cat
					)
				)
			);
	$loop = new WP_Query( $args );
	
	echo "<div class='ibr-tt-container {$cssclass}'>";
	
	while ( $loop->have_posts() ) : $loop->the_post();
		$tit = wp_trim_words( get_the_title(), 4, '...');
		$ibr_company = get_post_meta(get_the_ID(), "_company", true);
		$ibr_title = get_post_meta(get_the_ID(), "_title", true);
		
			echo "<div class='ibr-tt-item'>";
				echo "<div class='ibr-tt-item-inner'>";
					echo "<div class='ibr-tt-image'>";
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( $imgsize );
						}
					echo "</div>";
					the_content(); 
					echo "<div class='ibr-tt-content'>";
						if ($tit) { echo "<h3>{$tit}</h3>"; }
						if ($ibr_title) { 
							echo "<span class='ibr-title'>{$ibr_title}</span>"; 
						}
						if ($ibr_company) { 
							echo "<span class='ibr-company'>{$ibr_company}</span>"; 
						}
						echo "<p>".the_excerpt()."</p>";
					echo "</div>";
				echo "</div>";
			echo "</div>";

	endwhile;
	echo "</div>"; //Every 2 items wrap
}
// [ibrtt category="ebook" class="" imgsize="" butttontext="More" ]
function ibrainid_tt_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'category' => '',
        'class' => 'my-class',
		'imgsize' => 'thumbnail',
		'buttontext' => 'Read',
    ), $atts );
	ibrainid_tt($a['category'], $a['class'], $a['imgsize'], $a['buttontext']);
}
add_shortcode( 'ibrtt', 'ibrainid_tt_shortcode' );