<?php



 include ('tablename.php');

 

 $result = $wpdb->get_results( "SELECT * FROM $table_name3 WHERE insert_number = 1 ");



 	$wdl_title_profile_width = $wpdb->get_var( "SELECT wdl_title_profile_width FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_bk_color = $wpdb->get_var( "SELECT wdl_title_bk_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_margin_left = $wpdb->get_var( "SELECT wdl_title_margin_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_margin_right = $wpdb->get_var( "SELECT wdl_title_margin_right FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_title_text_ft_width = $wpdb->get_var( "SELECT wdl_title_text_ft_width FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_float = $wpdb->get_var( "SELECT wdl_title_text_float FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_top = $wpdb->get_var( "SELECT wdl_title_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_bottom = $wpdb->get_var( "SELECT wdl_title_text_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_left = $wpdb->get_var( "SELECT wdl_title_text_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_title_text_pd_right = $wpdb->get_var( "SELECT wdl_title_text_pd_right FROM $table_name3 WHERE insert_number = 1 ");

	$wdl_first_middle_names_ft_align = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_family = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_weight = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_color = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_size = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_first_middle_names_ft_style = $wpdb->get_var( "SELECT wdl_first_middle_names_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	
	
	$wdl_family_name_ft_align = $wpdb->get_var( "SELECT wdl_family_name_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_family = $wpdb->get_var( "SELECT wdl_family_name_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_weight = $wpdb->get_var( "SELECT wdl_family_name_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_color = $wpdb->get_var( "SELECT wdl_family_name_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_size = $wpdb->get_var( "SELECT wdl_family_name_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_style = $wpdb->get_var( "SELECT wdl_family_name_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_ft_transform =	$wpdb->get_var( "SELECT wdl_family_name_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_text_pd_top =	$wpdb->get_var( "SELECT wdl_family_name_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_family_name_text_pd_bottom = $wpdb->get_var( "SELECT wdl_family_name_text_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");

	$wdl_maiden_name_ft_align = $wpdb->get_var( "SELECT wdl_maiden_name_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_family = $wpdb->get_var( "SELECT wdl_maiden_name_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_weight = $wpdb->get_var( "SELECT wdl_maiden_name_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_color = $wpdb->get_var( "SELECT wdl_maiden_name_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_size = $wpdb->get_var( "SELECT wdl_maiden_name_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_style = $wpdb->get_var( "SELECT wdl_maiden_name_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_ft_transform =	$wpdb->get_var( "SELECT wdl_maiden_name_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_text_pd_top =	$wpdb->get_var( "SELECT wdl_maiden_name_text_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_maiden_name_text_pd_bottom = $wpdb->get_var( "SELECT wdl_maiden_name_text_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_nee_ft_align = $wpdb->get_var( "SELECT wdl_nee_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_family = $wpdb->get_var( "SELECT wdl_nee_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_weight = $wpdb->get_var( "SELECT wdl_nee_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_color = $wpdb->get_var( "SELECT wdl_nee_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_size = $wpdb->get_var( "SELECT wdl_nee_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_style = $wpdb->get_var( "SELECT wdl_nee_ft_style FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_ft_transform =	$wpdb->get_var( "SELECT wdl_nee_ft_transform FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_text_pd_left =	$wpdb->get_var( "SELECT wdl_nee_text_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_nee_text_pd_right = $wpdb->get_var( "SELECT wdl_nee_text_pd_right FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_dates_ft_align =$wpdb->get_var( "SELECT wdl_dates_ft_align FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_family = $wpdb->get_var( "SELECT wdl_dates_ft_family FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_weight = $wpdb->get_var( "SELECT wdl_dates_ft_weight FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_color = $wpdb->get_var( "SELECT wdl_dates_ft_color FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_dates_ft_size = $wpdb->get_var( "SELECT wdl_dates_ft_size FROM $table_name3 WHERE insert_number = 1 ");
	
	$wdl_profile_image_pd_left = $wpdb->get_var( "SELECT wdl_profile_image_pd_left FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_pd_right = $wpdb->get_var( "SELECT wdl_profile_image_pd_right FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_pd_top = $wpdb->get_var( "SELECT wdl_profile_image_pd_top FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_pd_bottom = $wpdb->get_var( "SELECT wdl_profile_image_pd_bottom FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_float = $wpdb->get_var( "SELECT wdl_profile_image_float FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_width = $wpdb->get_var( "SELECT wdl_profile_image_width FROM $table_name3 WHERE insert_number = 1 ");
	$wdl_profile_image_height = $wpdb->get_var( "SELECT wdl_profile_image_height FROM $table_name3 WHERE insert_number = 1 ");
 

?>
<style>
	
/* Admin Menu Form CSS */

wdl_gen_tools_form {

width:				400px;	

	}
	
/* Table CSS for Admin Menus */

table.menu_table  {

width:				75%;

font-family:		Tahoma, Geneva, sans-serif;

font-size:			12px;	

border-collapse:	collapse;

background:			#FFFFFF;

}





table.menu_table tr {

  	line-height:		2em;

}





table.menu_table tr:menu_list{

line-height:			1.5em;

}

/* CSS for Change Look Admin Menu */

/* Style Change Look Menu Page */

fieldset {

width:				495px;

}

#change_look_form {

width:				1000px;	

}


#change_look_outer {

	width:				1000px;

}

#change_look_bottom {


	width:				1000px;

}

#change_look_top {

	width:				1000px;
	height:				850px;


}

#change_look_top_left {
	
	float:				left;

}

#change_look_top_right{
	
	float:				right;

}

#change_look_left {

	float:				left;

}

#change_look_right {

	float:				right;

}

#change_look_submit input{

	margin-top:  		20px;
	font-size:			18px;
}

#change_look_form_heading {
	
	height:			300px;



}

fieldset#look {



	border-color:				#D3D3D3;

	border-style:				solid;

	border-width:				2px;

}





fieldset#look input{

	float:						right;

	margin-right:				10px;



}


.form_heading {

	font-weight:		bold;

	font-size:			16px;

	padding-left:				10px;

}





.form_subheading{

	font-weight:		bold;

	font-size:			14px;

	padding:			20px 0px 20px 10px;

	text-decoration:	underline;



}

	

label {

font-weight:		bold;

line-height:		3em;

}

form p.form_look{

	margin-left:				10px;

	font-size: 					14px;

	line-height:				30px;




}


/* These settings are not changeable*/

#wdl_title_container {


	height:					220px;
	background:				none;
	width:					100%;

}

table { 

	border-collapse:	collapse;
	line-height:		2em;
	}



table th.menu_heading.small{

text-align:			left;

background-color:	#666;

color:				#FFF;

width:				125px;

font-size:			12px;

text-align:			left;



}

table th.menu_heading_fn{

text-align:			left;

background-color:	#666;

line-height:		2em;

color:				#FFF;

width:				20%;

font-size:			12px;

text-align:			left;

}

table td {
	padding-left:			5px;

}

.stripe1 {
background-color:			#bbbbbb;

}

.stripe2 {
background-color:			#cccccc;

}

.highlight{
	
background-color:			#dddddd;
font-size:					13px;
font-weight:				bold:

}



/* These settings are changeable*/

#wdl_title_profile {
	
	background: 			#<? echo $wdl_title_bk_color; ?>;
	
	width:					<? echo $wdl_title_profile_width; ?>%;
	margin-left:			<? echo $wdl_title_margin_left; ?>;
	margin-right:			<? echo $wdl_title_margin_right; ?>;
	height:					inherit;

}


#wdl_title_text {


	width:					<? echo $wdl_title_text_ft_width; ?>%;
	float:					<? echo $wdl_title_text_float; ?>;	
	padding-top:			<? echo $wdl_title_text_pd_top; ?>px;
	padding-left:			<? echo $wdl_title_text_pd_left; ?>px;
	padding-right:			<? echo $wdl_title_text_pd_right; ?>px;
	background-color:		transparent;



}

#wdl_first_middle_names {
	
	
	text-align:				<? echo $wdl_first_middle_names_ft_align; ?>;
	font-family:			<? echo $wdl_first_middle_names_ft_family; ?>;
	font-weight:			<? echo $wdl_first_middle_names_ft_weight; ?>;
	color:					#<? echo $wdl_first_middle_names_ft_color; ?>;
	font-size:				<? echo $wdl_first_middle_names_ft_size; ?>px;
	font-style:				<? echo $wdl_first_middle_names_ft_style; ?>;


}

.wdl_family_name {
	
	
	text-align:				<? echo $wdl_family_name_ft_align; ?>;
	font-family:			<? echo $wdl_family_name_ft_family; ?>;
	font-weight:			<? echo $wdl_family_name_ft_weight; ?>;
	color:					#<? echo $wdl_family_name_ft_color; ?>;
	font-size:				<? echo $wdl_family_name_ft_size; ?>px;
	font-style:				<? echo $wdl_family_name_ft_style; ?>;
	text-transform:			<? echo $wdl_family_name_ft_transform; ?>;
	padding-top:			<? echo $wdl_family_name_text_pd_top; ?>px;
	padding-bottom:			<? echo $wdl_family_name_text_pd_bottom; ?>px;
}



.wdl_dates {
	

	text-align:				<? echo $wdl_dates_ft_align; ?>;
	font-family:			<? echo $wdl_dates_ft_family; ?>;
	font-weight:			<? echo $wdl_dates_ft_weight; ?>;
	color:					#<? echo $wdl_dates_ft_color; ?>;
	font-size:				<? echo $wdl_dates_ft_size; ?>px;

}

#wdl_profile_image { 

	float:					<? echo $wdl_profile_image_float; ?>;
	padding-left:			<? echo $wdl_profile_image_pd_left; ?>px;
	padding-right:			<? echo $wdl_profile_image_pd_right; ?>px;
	padding-top:			<? echo $wdl_profile_image_pd_top; ?>px;
	padding-bottom:			<? echo $wdl_profile_image_pd_bottom; ?>px;
	width:					150px;
	height:					200px;
	background-color:		transparent;

}





</style>

 

