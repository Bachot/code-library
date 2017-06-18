<?php
/*
* Plugin Name: ibrainiD Team
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
include( plugin_dir_path( __FILE__ ) . 'ibrainid-team-custom-post.php');
include( plugin_dir_path( __FILE__ ) . 'ibrainid-team-metaboxes.php');
include( plugin_dir_path( __FILE__ ) . 'ibrainid-team-settings.php');

add_action( 'wp_enqueue_scripts', 'ibrteam_plugin_frontend_init' );
function ibrteam_plugin_frontend_init() {
    wp_enqueue_style( 'team_stylesheet', plugins_url( 'asset/frontend/style.css', __FILE__ ) );
	wp_enqueue_script( 'team_script', plugins_url( 'asset/frontend/scritp.js', __FILE__ ) );
}

add_action( 'admin_init', 'ibrteam_plugin_admin_init' );
function ibrteam_plugin_admin_init() {
    wp_enqueue_style( 'team_stylesheet', plugins_url( 'asset/backend/style.css', __FILE__ ) );
	wp_enqueue_script( 'team_script', plugins_url( 'asset/backend/scritp.js', __FILE__ ) );
}
function ibrainid_team($cat, $cssclass, $imgsize, $buttontext) {
	$args = array( 
			'post_type' => 'ibrainid_team', 
			'posts_per_page' => 10,
			'tax_query'   => array(
					array(
						'taxonomy' => 'ibrainid_team_category',
						'field'    => 'slug',
						'terms'    => $cat
					)
				)
			);
	$loop = new WP_Query( $args );
	
	echo "<div class='ibr-team-container {$cssclass}'>";
	
	while ( $loop->have_posts() ) : $loop->the_post();
		$tit = wp_trim_words( get_the_title(), 4, '...');
		$ibr_link = get_permalink() ;
		$ibr_title = get_post_meta(get_the_ID(), "_title", true);
		$ibr_socialmedia1 = get_post_meta(get_the_ID(), "_socialmedia1", true);
		$ibr_socialmedia2 = get_post_meta(get_the_ID(), "_socialmedia2", true);
		$ibr_socialmedia3 = get_post_meta(get_the_ID(), "_socialmedia3", true);
		
		$set_var = get_option( 'ibrteamset_settings' );
		if ( empty($set_var['ibrteamset_socialmedia1'])) { $s1 = 'social media 1'; } 
		else { $s1 = $set_var['ibrteamset_socialmedia1']; }
		
		if ( empty($set_var['ibrteamset_socialmedia2'])) { $s2 = 'social media 2'; } 
		else { $s2 = $set_var['ibrteamset_socialmedia2'] ; }
		
		if ( empty($set_var['ibrteamset_socialmedia3'])) { $s3 = 'social media 3'; } 
		else { $s3 = $set_var['ibrteamset_socialmedia3']; }
			
			echo "<div class='ibr-team-item'>";
				echo "<div class='ibr-item-inner'>";
					echo "<div class='ibr-image'>";
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( $imgsize );
						}
					echo "</div>";
					echo "<div class='ibr-content'>";
						echo "<h3>{$tit}</h3>";
						if ($ibr_title) { echo "<h5>{$ibr_title}</h5>"; }
						"<p>".the_excerpt()."</p>";
						echo '<div class="ibr-team-social">';
						if ($ibr_socialmedia1) { echo "<a href='{$ibr_socialmedia1}' target='_blank'>{$s1}</a>"; }
						if ($ibr_socialmedia2) { echo "<a href='{$ibr_socialmedia2}' target='_blank'>{$s2}</a>"; }
						if ($ibr_socialmedia3) { echo "<a href='{$ibr_socialmedia3}' target='_blank'>{$s3}</a>"; }
						echo '</div>';
						if ($ibr_link) { echo "<p><a class='ibr-btn' href='{$ibr_link}' target='_blank'>{$buttontext}</a><p>"; }
					echo "</div>";
				echo "</div>";
			echo "</div>";

	endwhile;
	echo "</div>"; //Every 2 items wrap
	echo "</div>"; //Main container wrap
}
// [ibrteam category="ebook" class="" imgsize="" butttontext="More" ]
function ibrainid_team_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'category' => '',
        'class' => 'my-class',
		'imgsize' => 'thumbnail',
		'buttontext' => 'Read',
    ), $atts );
	ibrainid_team($a['category'], $a['class'], $a['imgsize'], $a['buttontext']);
}
add_shortcode( 'ibrteam', 'ibrainid_team_shortcode' );