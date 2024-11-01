<?php

	global $wpdb;

	$upload_dir = wp_upload_dir();

	/* Set the tablenames */

	// $table_name = $wpdb->prefix . "wdl_pedigree_person";
	$table_name = $wpdb->prefix . "wdl_title_profile";
	$table_name3 = $wpdb->prefix . "wdl_title_profile_css";


/* Set the default variable for the Title shortcode tables*/

	$wdl_title_profile_width = "100";
	$wdl_title_bk_color = "FFFFFF";
	$wdl_title_margin_left = "auto";
	$wdl_title_margin_right = "auto";
	
	
	$wdl_title_text_ft_width = "60";
	$wdl_title_text_float = "right";
	$wdl_title_text_pd_top = "20";
	$wdl_title_text_pd_bottom = "0";
	$wdl_title_text_pd_left = "20";
	$wdl_title_text_pd_right = "10";
  
	$wdl_first_middle_names_ft_align  = "right";
	$wdl_first_middle_names_ft_family = "Tahoma, Geneva, sans-serif";
	$wdl_first_middle_names_ft_weight = "normal";
	$wdl_first_middle_names_ft_color = "000000";
	$wdl_first_middle_names_ft_size = "28";
	$wdl_first_middle_names_ft_style = "italic";
   
	$wdl_family_name_ft_align = "right";
	$wdl_family_name_ft_family = "Tahoma, Geneva, sans-serif";
	$wdl_family_name_ft_weight = "bold";
	$wdl_family_name_ft_color = "000000";
	$wdl_family_name_ft_size  = "38";
	$wdl_family_name_ft_style = "normal";
	$wdl_family_name_ft_transform = "uppercase";
	$wdl_family_name_text_pd_top = "20";
	$wdl_family_name_text_pd_bottom = "20";
	
	$wdl_maiden_name_ft_align = "right";
	$wdl_maiden_name_ft_family = "Tahoma, Geneva, sans-serif";
	$wdl_maiden_name_ft_weight = "bold";
	$wdl_maiden_name_ft_color = "000000";
	$wdl_maiden_name_ft_size  = "24";
	$wdl_maiden_name_ft_style = "normal";
	$wdl_maiden_name_ft_transform = "none";
	$wdl_maiden_name_text_pd_top = "0";
	$wdl_maiden_name_text_pd_bottom = "0";
	
	$wdl_nee_ft_align = "right";
	$wdl_nee_ft_family = "Tahoma, Geneva, sans-serif";
	$wdl_nee_ft_weight = "bold";
	$wdl_nee_ft_color = "000000";
	$wdl_nee_ft_size  = "16";
	$wdl_nee_ft_style = "italic";
	$wdl_nee_ft_transform = "none";
	$wdl_nee_text_pd_left = "0";
	$wdl_nee_text_pd_right = "10";
 
	$wdl_dates_ft_align = "right";
	$wdl_dates_ft_family = "Tahoma, Geneva, sans-serif";
	$wdl_dates_ft_weight = "normal";
	$wdl_dates_ft_color = "000000";
	$wdl_dates_ft_size = "16";
 
	$wdl_profile_image_float = "left";
	$wdl_profile_image_pd_left = "10";
	$wdl_profile_image_pd_right = "0";
	$wdl_profile_image_pd_top = "10";
	$wdl_profile_image_pd_bottom = "10";
	$wdl_profile_image_width = "150";
	$wdl_profile_image_height = "200";
?>