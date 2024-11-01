<?php ob_start();?>
<?php 

/*

Plugin Name: WDL Genealogy and Family History Person Profile Image and Title
Plugin URI: http://warwicklyons.com.au/wdl-profile-title/
Description: Adds a Profile Image and Title to your Page
Version: 1.3.2
Author: Warwick Lyons
Author URI: http://warwicklyons.com.au/
License: © Copyright 2013. All Rights Reserved
*/


// CREATE THE TITLE SHORTSODE



function wdl_title_sc( $atts ) {
	extract(shortcode_atts( array(
		'id' => ' ',
	), $atts ) );
ob_start();


	include ('tablename.php');
	include ('style_info.php');


	
	
	$upload_dir = wp_upload_dir(); 
	$image_dir = $upload_dir['baseurl'];


		
		

		
		
	$result = $wpdb->get_results( "SELECT first_name, middle_name, family_name, date_of_birth, date_of_death, sex, image FROM $table_name WHERE id = '$id'" );
	
	
	$first_name = $wpdb->get_var( "SELECT first_name FROM $table_name WHERE id = '$id'" );	
	$middle_name = $wpdb->get_var( "SELECT middle_name FROM $table_name WHERE id = '$id'" );
	$family_name = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = '$id'" );
	$date_of_birth = $wpdb->get_var( "SELECT date_of_birth FROM $table_name WHERE id = '$id'" );
	$date_of_death = $wpdb->get_var( "SELECT date_of_death FROM $table_name WHERE id = '$id'" );
	$sex = $wpdb->get_var( "SELECT sex FROM $table_name WHERE id = '$id'" );
	$image = $wpdb->get_var( "SELECT image FROM $table_name WHERE id = '$id'" );
	
	$profile_pic = $upload_dir['baseurl']."/".$image;	

	$plugin_url = plugins_url( 'images/no_image.jpg', __FILE__ );


	$marriage_name = $wpdb->get_results( "SELECT * FROM $table_name2" );
	$person_id =  $wpdb->get_var( "SELECT person_id FROM $table_name2 WHERE spouse_id = '$id' AND marriage_status = 'Married'" );
	$spouse_id =  $wpdb->get_var( "SELECT spouse_id FROM $table_name2 WHERE person_id = '$id' AND marriage_status = 'Married'" );
	$pers_id = $wpdb->get_var( "SELECT spouse_id FROM $table_name2 WHERE spouse_id = '$id' AND marriage_status = 'Married'" );
	$if_married = $wpdb->get_var( "SELECT married_status FROM $table_name2 WHERE spouse_id = '$id' AND marriage_status = 'Married'" );
	
	if ($sex == "Female") {
	
		if ($person_id === $id) {
		
			$marriage_id = $spouse_id;
		
		} else {
			
			$marriage_id = $person_id;
		
		}	
		

	}
	
	
	
	

	
	
	$marriage_name = $wpdb->get_results( "SELECT family_name FROM $table_name WHERE id = '$marriage_id'" );
	
	$marriage_name = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = '$marriage_id'" );
	

?>
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'style.css', __FILE__ );?>" media="screen" />
<div id="wdl_title_container">
	
	<div id="wdl_title_profile">
		
		<div id="wdl_title_text">
        
        	<div id="wdl_first_middle_names">
			<?php echo htmlspecialchars($first_name) ." " . htmlspecialchars($middle_name)?>
            </div> <!-- End of wdl_first_middle_names div-->


   			
			<?php if (($sex ==="Female") && ($pers_id == $id)){ ?>
            
            <div class="wdl_family_name">
			<?php echo htmlspecialchars($marriage_name)?>
            
            </div> <!-- End of wdl_family_name div-->
            
            <div class="wdl_maiden_name"><span class="wdl_nee">nee </span> <?php echo htmlspecialchars($family_name)?>
            </div> <!-- End of wdl_family_name div-->
			<?php
            } else {

   ?>
   <div class="wdl_family_name"><?php echo htmlspecialchars($family_name)?>
            </div> <!-- End of wdl_family_name div-->
<? }


   
   ?>
<div class="wdl_dates">
			<?php echo htmlspecialchars($date_of_birth) ." - " . htmlspecialchars($date_of_death)?>
            </div> <!-- End of wdl_dates div-->
   
   
		</div><!-- End of wdl_title_text div-->


		<div id="wdl_profile_image">
        
<?php      if (empty($image))	{
        		
            ?>
       <img src="<?php echo $plugin_url  ?>" width="150" height="200">
            
	
<?
} else {
?>
<img src="<?php echo $profile_pic ?>" width="<?php echo $wdl_profile_image_width ?>" height="<?php echo $wdl_profile_image_height ?>">
<?
};
?>
        </div><!-- End of wdl_profile_image div-->
	</div><!-- End of wdl_title_profile div -->

</div><!-- End of wdl_title_container div-->

<?php
$output = ob_get_clean();

	return $output;
	
}
add_shortcode( 'wdl_title', 'wdl_title_sc' );



// END THE TITLE SHORTCODE








// --------------------------------------------------------------------------------------------------------- //








//CREATE THE DATABASE TABLES



// Title Profile Database Table

function create_a_wdl_title_table () {

include ('tablename.php');
   
   $sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  middle_name VARCHAR(60) NOT NULL,
  family_name VARCHAR(50) NOT NULL,
  date_of_birth VARCHAR(11) NOT NULL,
  date_of_death VARCHAR(11) NOT NULL,
  image VARCHAR(20) NOT NULL,
  
    UNIQUE KEY id (id)
    );";
	
	  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
}

register_activation_hook( __FILE__, 'create_a_wdl_title_table' );





// Title Profile CSS Table



//Install the title profile css dat into the css table

function install_wdl_title_profile_css_data() {
 include ('tablename.php');
 
$result = $wpdb->get_results( "SELECT * FROM $table_name3");
 $id_exist = $wpdb->get_var( "SELECT insert_number FROM $table_name3 ");
 $insert_number = 1;
 if ($id_exist == 1) {
	 
	  return;
	 
	 } else {

  $rows_affected = $wpdb->insert( $table_name3, array( 
  
  'insert_number' => $insert_number, 
  
  'wdl_title_profile_width' => $wdl_title_profile_width, 
  'wdl_title_bk_color' => $wdl_title_bk_color,
  'wdl_title_margin_left' => $wdl_title_margin_left,
  'wdl_title_margin_right' => $wdl_title_margin_right,
  
  
  'wdl_title_text_ft_width' => $wdl_title_text_ft_width, 
  'wdl_title_text_float' => $wdl_title_text_float, 
  'wdl_title_text_pd_top' => $wdl_title_text_pd_top,
  'wdl_title_text_pd_bottom' => $wdl_title_text_pd_bottom,
  'wdl_title_text_pd_right' => $wdl_title_text_pd_right,
  'wdl_title_text_pd_left' => $wdl_title_text_pd_left,

  
  'wdl_first_middle_names_ft_align' => $wdl_first_middle_names_ft_align, 
  'wdl_first_middle_names_ft_family' => $wdl_first_middle_names_ft_family, 
  'wdl_first_middle_names_ft_weight' => $wdl_first_middle_names_ft_weight, 
  'wdl_first_middle_names_ft_color' => $wdl_first_middle_names_ft_color, 
  'wdl_first_middle_names_ft_size' => $wdl_first_middle_names_ft_size, 
  'wdl_first_middle_names_ft_style' => $wdl_first_middle_names_ft_style,
  
  
  'wdl_family_name_ft_align' => $wdl_family_name_ft_align, 
  'wdl_family_name_ft_family' => $wdl_family_name_ft_family, 
  'wdl_family_name_ft_weight' => $wdl_family_name_ft_weight, 
  'wdl_family_name_ft_color' => $wdl_family_name_ft_color, 
  'wdl_family_name_ft_size' => $wdl_family_name_ft_size, 
  'wdl_family_name_ft_style' => $wdl_family_name_ft_style, 
  'wdl_family_name_ft_transform' => $wdl_family_name_ft_transform, 
  'wdl_family_name_text_pd_bottom' => $wdl_family_name_text_pd_bottom, 
  'wdl_family_name_text_pd_top' => $wdl_family_name_text_pd_top, 
  
  'wdl_maiden_name_ft_align' => $wdl_maiden_name_ft_align, 
  'wdl_maiden_name_ft_family' => $wdl_maiden_name_ft_family, 
  'wdl_maiden_name_ft_weight' => $wdl_maiden_name_ft_weight, 
  'wdl_maiden_name_ft_color' => $wdl_maiden_name_ft_color, 
  'wdl_maiden_name_ft_size' => $wdl_maiden_name_ft_size, 
  'wdl_maiden_name_ft_style' => $wdl_maiden_name_ft_style, 
  'wdl_maiden_name_ft_transform' => $wdl_maiden_name_ft_transform, 
  'wdl_maiden_name_text_pd_bottom' => $wdl_maiden_name_text_pd_bottom, 
  'wdl_maiden_name_text_pd_top' => $wdl_maiden_name_text_pd_top, 
  
   'wdl_nee_ft_align' => $wdl_nee_ft_align, 
  'wdl_nee_ft_family' => $wdl_nee_ft_family, 
  'wdl_nee_ft_weight' => $wdl_nee_ft_weight, 
  'wdl_nee_ft_color' => $wdl_nee_ft_color, 
  'wdl_nee_ft_size' => $wdl_nee_ft_size, 
  'wdl_nee_ft_style' => $wdl_nee_ft_style, 
  'wdl_nee_ft_transform' => $wdl_nee_ft_transform, 
  'wdl_nee_text_pd_right' => $wdl_nee_text_pd_right, 
  'wdl_nee_text_pd_left' => $wdl_nee_text_pd_left, 
 
  'wdl_dates_ft_align' => $wdl_dates_ft_align, 
  'wdl_dates_ft_family' => $wdl_dates_ft_family, 
  'wdl_dates_ft_weight' => $wdl_dates_ft_weight, 
  'wdl_dates_ft_color' => $wdl_dates_ft_color, 
  'wdl_dates_ft_size' => $wdl_dates_ft_size, 
  

  'wdl_profile_image_float' => $wdl_profile_image_float,
  'wdl_profile_image_pd_left' => $wdl_profile_image_pd_left,
  'wdl_profile_image_pd_right' => $wdl_profile_image_pd_right,
  'wdl_profile_image_pd_top' => $wdl_profile_image_pd_top,
  'wdl_profile_image_pd_bottom' => $wdl_profile_image_pd_bottom,
  'wdl_profile_image_width' => $wdl_profile_image_width, 
  'wdl_profile_image_height' => $wdl_profile_image_height, 
  ) );
	 }



  }


// Create the Tile Profile Database table


function create_wdl_title_profile_css_table() {
 
  include ('tablename.php');
   
      
   $sql = "CREATE TABLE $table_name3 (
  id mediumint(9) NOT NULL AUTO_INCREMENT,

	wdl_title_profile_width varchar (40) NOT NULL,
	wdl_title_bk_color varchar (10) NOT NULL,
	wdl_title_margin_left varchar (8) NOT NULL,
	wdl_title_margin_right varchar (8) NOT NULL,
	

	wdl_title_text_ft_width varchar (5) NOT NULL,
	wdl_title_text_float varchar (5) NOT NULL,
	wdl_title_text_pd_top varchar (3) NOT NULL,
	wdl_title_text_pd_bottom varchar (3) NOT NULL,
	wdl_title_text_pd_left varchar (3) NOT NULL,
	wdl_title_text_pd_right varchar (3) NOT NULL,

	wdl_first_middle_names_ft_align varchar (7) NOT NULL,
	wdl_first_middle_names_ft_family varchar (40) NOT NULL,
	wdl_first_middle_names_ft_weight varchar (7) NOT NULL,
	wdl_first_middle_names_ft_color varchar (7) NOT NULL,
	wdl_first_middle_names_ft_size varchar (4) NOT NULL,
	wdl_first_middle_names_ft_style varchar (11) NOT NULL,
	
	wdl_family_name_ft_align varchar (7) NOT NULL,
	wdl_family_name_ft_family varchar (40) NOT NULL,
	wdl_family_name_ft_weight varchar (7) NOT NULL,
	wdl_family_name_ft_color varchar (7) NOT NULL,
	wdl_family_name_ft_size varchar (4) NOT NULL,
	wdl_family_name_ft_style varchar (11) NOT NULL,
	wdl_family_name_ft_transform varchar (11) NOT NULL,	
	wdl_family_name_text_pd_top varchar (3) NOT NULL,
	wdl_family_name_text_pd_bottom varchar (3) NOT NULL,
	
	wdl_maiden_name_ft_align varchar (7) NOT NULL,
	wdl_maiden_name_ft_family varchar (40) NOT NULL,
	wdl_maiden_name_ft_weight varchar (7) NOT NULL,
	wdl_maiden_name_ft_color varchar (7) NOT NULL,
	wdl_maiden_name_ft_size varchar (4) NOT NULL,
	wdl_maiden_name_ft_style varchar (11) NOT NULL,
	wdl_maiden_name_ft_transform varchar (11) NOT NULL,	
	wdl_maiden_name_text_pd_top varchar (3) NOT NULL,
	wdl_maiden_name_text_pd_bottom varchar (3) NOT NULL,
	
	wdl_nee_ft_align varchar (7) NOT NULL,
	wdl_nee_ft_family varchar (40) NOT NULL,
	wdl_nee_ft_weight varchar (7) NOT NULL,
	wdl_nee_ft_color varchar (7) NOT NULL,
	wdl_nee_ft_size varchar (4) NOT NULL,
	wdl_nee_ft_style varchar (11) NOT NULL,
	wdl_nee_ft_transform varchar (11) NOT NULL,	
	wdl_nee_text_pd_left varchar (3) NOT NULL,
	wdl_nee_text_pd_right varchar (3) NOT NULL,
	
	wdl_dates_ft_align varchar (7) NOT NULL,
	wdl_dates_ft_family varchar (40) NOT NULL,
	wdl_dates_ft_weight varchar (7) NOT NULL,
	wdl_dates_ft_color varchar (7) NOT NULL,
	wdl_dates_ft_size varchar (4) NOT NULL,
	
	wdl_profile_image_float varchar (7) NOT NULL,
	wdl_profile_image_pd_left varchar (3) NOT NULL,
	wdl_profile_image_pd_right varchar (3) NOT NULL,
	wdl_profile_image_pd_top varchar (3) NOT NULL,
	wdl_profile_image_pd_bottom varchar (3) NOT NULL,
	wdl_profile_image_width varchar (3) NOT NULL,
	wdl_profile_image_height varchar (3) NOT NULL,
	
	insert_number varchar (3) NOT NULL,

  UNIQUE KEY id (id)
    );";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
 


 

}

register_activation_hook( __FILE__, 'create_wdl_title_profile_css_table' );
register_activation_hook( __FILE__, 'install_wdl_title_profile_css_data' );







// --------------------------------------------------------------------------------------------------------- //







//CREATE THE ADMINISTRATION MENU SYSTEM

function create_the_title_profile_menus () {
	
// Create Top Admin Menu
define( 'MYPLUGINNAME_PATH', plugin_dir_url(__FILE__));

$path = MYPLUGINNAME_PATH;


    add_menu_page( 'WDL Genealogy Tools', 'WDL Genealogy Tools', 'manage_options', 'wdl-genealogy-tools-top-menu', 'create_wdl_title_profile_main_menu',  $path.'/images/tree.gif');
	
// Stop Top Admin Menufrom appearing as a submenu
	
	add_submenu_page('wdl-genealogy-tools-top-menu','','','manage_options','wdl-genealogy-tools-top-menu','');
	
// Create Submenus	
	
	add_submenu_page( 'wdl-genealogy-tools-top-menu', 'Add Title Info', 'Add Title Info', 'manage_options', 'add-submenu-add-title-info', 'add_wdl_genealogy_tools_title_profile_info'); 
	
	add_submenu_page( 'wdl-genealogy-tools-top-menu', 'View Title List', 'View Title List', 'manage_options', 'add-submenu-view-title-info', 'add_wdl_genealogy_tools_view_title_profile_info');
	
	add_submenu_page( 'wdl-genealogy-tools-top-menu', 'Edit Title Info', 'Edit Title Info', 'manage_options', 'add-submenu-edit-title-info', 'add_wdl_genealogy_tools_edit_title_profile_info');
	
	add_submenu_page( 'wdl-genealogy-tools-top-menu', 'Delete Title Info', 'Delete Title Info', 'manage_options', 'add-submenu-delete-title-info', 'add_wdl_genealogy_tools_delete_title_profile_info');  
		
	add_submenu_page( 'wdl-genealogy-tools-top-menu', 'Look and Feel', 'Look and Feel', 'manage_options', 'add-submenu-change-look', 'add_wdl_genealogy_tools_change_look');
	

}

add_action('admin_menu', 'create_the_title_profile_menus');










// --------------------------------------------------------------------------------------------------------- //








// CREATE THE ADMINISTRATION MENU PAGES











//Create the Admin Main Menu Title Profile Page






function create_wdl_title_profile_main_menu () {
	
?>
<!-- Create the main Title Profile page -->
<div class="wrap">
    <?php screen_icon();?>
    <h2>WDL GENEALOGY TOOLS</h2>
    <p> Thank you for choosing WDL Genealogy Tools</p>

    <br />
    <br />
    <p> If you like view more information or to view the Frequently asked Questions</p> 
    <br />
	<a href="http://lyons-barton.com/wdl-pedigree-chart/"> More Information</a>

	<br />
    <br />
    <hr>
    <br />
    <br />
    <p class="subheading">Make Suggestions for improvements</p>
 
    <a href="mailto:wdlyons@lyons-barton.com?subject=A suggestion for your Pedigree Plugin">Make a Suggestion</a>
</div>
<?php
}



//Create the Admin Sub Menu Title Profile Page




function add_wdl_genealogy_tools_title_profile_info () {
?>
<div class="wrap">
<h2>WDL GENEALOGY TOOLS - Add Title Profile Data</h2>
    <p>From this page you will be able to Add Title Profile Data</p>

<br />
<br />

     
	
<div id="wdl_gen_tools_form">
  <fieldset>

  			
            	<form action="" method="post" name="new_person"  id="new_person" enctype="multipart/form-data">
   			
            <p>	
            	<label for="first_name">First Name</label>
<br />

<span id="name_hint" class="hint"></span>
<br />
<br />
      			<input name="first_name" type="text" placeholder="Please Enter A First Name" id="first_name" size="50" maxlength="50" />
			</p>
            
                        <p>	
            	<label for="middle_names">Middle Names</label>
<br />

<span id="name_hint" class="hint"></span>
<br />
<br />
      			<input name="middle_names" type="text" placeholder="Please Enter A Middle Name" id="middle_names" size="50" maxlength="50" />
			</p>
    
    		<p> 
            	<label for="family_name">Family Name *</label>
<br />

<span id="family_name_hint" class="hint"></span>
<br />
<br />
      			<input name="family_name" type="text" required placeholder="Please Enter A Family Name" id="family_name"  size="50"  maxlength="50" />
    		</p>
            <br />

            <br />


		    <p>
<label  align="left" for="date_of_birth">Date of Birth</label>
<br />

<span id="d_o_b" class="hint"></span>
<br />
<br />
		
<span class="date">

Day <select name="bday" id="bday">
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>'" . PHP_EOL ;
}
?>
</select>

Month <select name='bmonth' >
<option value =''></option>
<?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','May'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>'" . PHP_EOL ;
}
?>
</select>
Year <select name='byear' >
<option value =''></option>
<?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>'" . PHP_EOL ;
}
?>
</select>

</span>

			</p>
<br />
            
                        			<br />
    		<p>

<label align="left" for="date_of_death">Date Of Death</label>
<br />

<span id="d_o_d" class="hint"></span>
<br />
<br />
<span class="date">

Day <select name='dday'>
<option value =''></option>
<?php
$day = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');// etc);
foreach( $day as $k=>$v ){
echo"'<option value='$k'>$v</option>'" . PHP_EOL ;
}
?>
</select>

Month <select name='dmonth'>
<option value =''></option>
<?php
$months = array('Jan'=>'January','Feb'=>'February','Mar'=>'March','Apr'=>'April','May'=>'May','Jun'=>'June','Jul'=>'July','Aug'=>'August','Sep'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December');
foreach( $months as $k=>$v ){
echo"'<option value='$k'>$v</option>'" . PHP_EOL ;
}
?>
</select>
Year <select name='dyear'>
<option value =''></option>
<?php
$years = range( date('Y'), '1400');
foreach( $years as $y ){
echo"'<option value='$y'>$y</option>'" . PHP_EOL ;
}
?>
</select>
</span>

			</p>
			<br /><br />

			<p><label for="file">Profile Image (150px X 200px):</label>
            
<input type="file" name="file-upload" accept="image/*" id="file-upload" /> </p>
            <p>
            <input type="hidden" name="submitted" value="1"> 
            </p>

		    <p><br /><br /><br />
      			<button>Upload File and Details</button>
      		</p>
            
			</form>
            <script type="text/javascript" src="<?php echo plugins_url( 'script.js', __FILE__ );?>"></script>
            <script>
            offerhints();
        
            </script>
    
  </fieldset>
  

<br />
 <span class="required">Required Fields *<br />
 


</span> 

<?php

$n = rand(1,100);

include ('tablename.php');
	
// Run variable input through filters

$first_name = sanitize_text_field( $_POST['first_name'] );
$first_name = check_input( $first_name);

$middle_names = sanitize_text_field( $_POST['middle_names'] );
$middle_names = check_input($middle_names);


$family_name = sanitize_text_field( $_POST['family_name'] );
$family_name = check_input( $family_name, "Please Enter a Family Name");



$bday = sanitize_text_field( $_POST['bday'] );
$bday = check_input( $bday);

$bmonth = sanitize_text_field( $_POST['bmonth'] );
$bmonth  = check_input( $bmonth );

$byear = sanitize_text_field( $_POST['byear'] );
$byear = check_input( $byear);

$dday = sanitize_text_field( $_POST['dday'] );
$dday = check_input( $dday);

$dmonth = sanitize_text_field( $_POST['dmonth'] );
$dmonth = check_input( $dmonth);

$dyear = sanitize_text_field( $_POST['dyear'] );
$dyear = check_input( $dyear);


$date_of_death = ($dday." ".$dmonth." ".$dyear);
$date_of_death = sanitize_text_field( $date_of_death );
$date_of_death = check_input( $date_of_death);
	
$date_of_birth = ($bday." ".$bmonth." ".$byear);
$date_of_birth = sanitize_text_field( $date_of_birth );
$date_of_birth = check_input( $date_of_birth);

$pic=($_FILES['file-upload']['name']);
$birth_certificate=($_FILES['birth_cert']['name']);
$death_certificate=($_FILES['death_cert']['name']);

require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attachment_id = media_handle_upload('file-upload', $name);
$birth_cert_id = media_handle_upload('birth_cert', $name);
$death_cert_id = media_handle_upload('death_cert', $name);
?>
 info:

<?
echo $first_name;
echo $middle_names;
echo $family_name;
echo $date_of_birth;
echo $date_of_death;



 //Writes the information to the database 
 $wpdb->insert($table_name,array('first_name'=>$first_name,'middle_name'=>$middle_names,'family_name'=>$family_name, 'date_of_birth'=>$date_of_birth, 'date_of_death'=>$date_of_death,'image'=>$pic));


header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-title-info");

 //$wpdb->insert($table_name,array('person_id'=>$id));





}


//Create the Admin Sub Menu View Family Member Page


function add_wdl_genealogy_tools_view_title_profile_info () {
	
?>

<div class="wrap">

    <h2>WDL Pedigree Chart - View Family Members</h2>
    <p>From this page you will be able to view your Family Members</p>
    
    <p>&nbsp;</p>
 <?   
add_action( 'wp_enqueue_script', 'load_jquery' );
function load_jquery() {
    wp_enqueue_script( 'jquery' );
}
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $(function() {
	
	$("#wdl_title_view tr:even").addClass("stripe1");
	$("#wdl_title_view tr:odd").addClass("stripe2");	
	
	$("#wdl_title_view tr").hover (
	
		function() {
			$(this).toggleClass("highlight");
			
		},
		
		function () {
			$(this).toggleClass("highlight");
		}
	
	);
	
});
});
</script>
<?
	include ('tablename.php');
	include ('style_info.php');     
	  
	$result = $wpdb->get_results( "SELECT id, first_name, middle_name, family_name, date_of_birth, date_of_death FROM $table_name ORDER BY first_name " );

?>

	<table id="wdl_title_view" >

	<th class="menu_heading_fn">
	First Name
	</th>
    <th class="menu_heading_fn">
	Middle Name
	</th>
	<th class="menu_heading_fn">
	Family Name
	</th>
	<th class="menu_heading small">
	Date Of Birth
	</th>
	<th class="menu_heading small">
	Date Of Death
	</th>
    <th class="menu_heading small">
	Shortcode 
    </th>


<?php

	foreach ($result as $result){ ?>
    
	<tr>

	<td ><?php echo htmlspecialchars($result->first_name);?></td>
    <td ><?php echo htmlspecialchars($result->middle_name);?></td>
	<td ><?php echo htmlspecialchars($result->family_name);?></td>
	<td ><?php echo htmlspecialchars($result->date_of_birth);?></td>
	<td ><?php echo htmlspecialchars($result->date_of_death);?></td>
	<td >[wdl_title id="<?php echo htmlspecialchars($result->id);?>"]</td>


	</tr>

<?php 

}

?>

	</table>
	<tbody>

</div>

<?php 

}

//End the Admin Sub Menu View Family Member Page






//Create the Admin Sub Menu Edit Title Info



 
function add_wdl_genealogy_tools_edit_title_profile_info() {
	
		ob_start();
	global $wpdb;




	$result = $wpdb->get_results( "SELECT $table_name.first_name, $table_name.family_name, $table_name.post_id FROM $table_name JOIN $table_name2 ON ($table_name.id=$table_name2.spouse_id) WHERE ($table_name.id = $table_name2.person_id) OR ($table_name.id = $table_name2.spouse_id)" );

	include ('tablename.php');
	$p_id = NULL;

	$sql="SELECT * FROM $table_name ORDER BY first_name"; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 



    $p_id=sanitize_text_field( $row["id"]); 
	$p_id=check_input($p_id);
	
	
    $p_first_name=sanitize_text_field( $row["first_name"]); 
	$p_first_name=check_input($p_first_name); 
	
	$p_middle_name=sanitize_text_field( $row["middle_name"]); 
	$p_middle_name=check_input($p_middle_name); 
	
    $p_family_name=sanitize_text_field( $row["family_name"]); 
	$p_family_name=check_input($p_family_name); 
	
    $p_date_of_birth=sanitize_text_field( $row["date_of_birth"]);
	$p_date_of_birth=check_input($p_date_of_birth);
	
	$p_date_of_death=sanitize_text_field( $row["date_of_death"]);
	$p_date_of_death=check_input($p_date_of_death);
	
    $p_options.="<OPTION VALUE='".$p_id. "'>".$p_id."   ---  ".$p_first_name ." ".$p_middle_name ." ".$p_family_name."   ---  ".$p_date_of_birth ." - ".$p_date_of_death; 
	}

?> 

    <h2>WDL Pedigree Chart - Edit Family Member</h2>
    <p>From this page you will be able to Edit Title Info</p>
    
    <p>&nbsp;</p>

	<br />
	<br />


<div id="form">

	<form action="" method="post">

	<label  align="left" for="p_id"><strong>Step 1:</strong> Select the Person you wish to make changes to*</label>

	<br />
	<br />
    
	<select name="p_id" onchange='this.form.submit()'>
  	
    <option><?=$p_options?> </option>
	
    </select>

	<noscript><input type="submit" value="choose"></noscript>

	</form>

	<br />
 	<br />
    
</div>

<?php

	$p_id = sanitize_text_field( $_POST[p_id]);
	$p_id = check_input( $p_id,"You Need to Select the Person who You are Making Changes To");

	$upload_dir = wp_upload_dir(); 
	$image_dir = $upload_dir['baseurl'];

	$result = $wpdb->get_results( "SELECT first_name, family_name, date_of_birth, date_of_death, id, image  FROM $table_name"); 



	$first_name = $wpdb->get_var( "SELECT first_name FROM $table_name WHERE id = $p_id" );
	$first_name =sanitize_text_field($first_name);
	$first_name =check_input($first_name);
	
	$middle_name = $wpdb->get_var( "SELECT middle_name FROM $table_name WHERE id = $p_id" );
	$middle_name =sanitize_text_field($middle_name);
	$middle_name =check_input($middle_name);

	$family_name = $wpdb->get_var( "SELECT family_name FROM $table_name WHERE id = $p_id" );
	$family_name =sanitize_text_field($family_name);
	$family_name =check_input($family_name);


	$date_of_birth = $wpdb->get_var( "SELECT date_of_birth FROM $table_name WHERE id = $p_id" );
	$date_of_birth =sanitize_text_field($date_of_birth);
	$date_of_birth =check_input($date_of_birth);

	$date_of_death = $wpdb->get_var( "SELECT date_of_death FROM $table_name WHERE id = $p_id" );
	$date_of_death =sanitize_text_field($date_of_death);
	$date_of_death =check_input($date_of_death);
	
	$image = $wpdb->get_var( "SELECT image FROM $table_name WHERE id = $p_id" );
	$image =sanitize_text_field($image);
	$image =check_input($image);

	$profile_pic = $upload_dir['baseurl']."/".$image;	

?>

<div id="form">

  	<fieldset>

  	<legend class="legend"><strong>Step 2:</strong> Make the Required Changes.</legend>

	<br />

	<div id="inner_form">
  	
    <form action="" method="post" name="edit_person" enctype="multipart/form-data">

   	<input name="p_id" id="p_id" type="hidden" value="<? echo htmlspecialchars($p_id)?>" />

    <p>

    <label for="first_name"><strong>First and Middle Names</strong></label><br />

    <input name="first_name" default=""   type="text" id="first_name" value="<? echo htmlspecialchars($first_name)?>" maxlength="50" />

	</p>

	<br />
    <p>

    <label for="middle_name"><strong>Middle Name</strong></label><br />

    <input name="middle_name" default=""   type="text" id="middle_name" value="<? echo htmlspecialchars($middle_name)?>" maxlength="50" />

	</p>

	<br />
    <p> 
    
    <label for="family_name"><strong>Family Name</strong></label><br />

    <input name="family_name" default="" type="text" id="family_name" value="<? echo htmlspecialchars($family_name)?>"  maxlength="50" />

	</p>

	<br />
    
    <p>

    <label for="date_of_birth"><strong>Date of Birth</strong></label><br />

    <input type="text" default=""  name="date_of_birth" id="date_of_birth" value="<? echo htmlspecialchars($date_of_birth)?>" maxlength="20"/>

	</p>

	<br />    
    
    <p>

    <label for="date_of_death"><strong>Date Of Death</strong> </label><br />
      
    <input type="text" default="" name="date_of_death" id="date_of_death" value="<? echo htmlspecialchars($date_of_death)?>" maxlength="20" />
    
    </p>

    <br />
   
    <p>
     Your current profile image is:<br /><div id="wdl_profile_image"><img src="<?php echo $profile_pic?>"></div>
    
    </p>

	<br /><br />
			<p><label for="file">Profile Image (150px X 200px):</label>
<input type="file" name="file-upload" id="file-upload" /> </p>

    <p>

    <input type="submit" name="submit" id="submit" value="Submit" />

    </p>
  	</fieldset>
  	</form>

  	</div>  


<?php

	if(isset($_POST['submit'])) {



	$first_name = sanitize_text_field($_POST['first_name']);
	$first_name = check_input( $first_name);
	
	$middle_name = sanitize_text_field($_POST['middle_name']);
	$middle_name = check_input( $middle_name);

	$family_name = sanitize_text_field($_POST['family_name']);
	$family_name = check_input( $family_name);

	$date_of_birth = sanitize_text_field($_POST['date_of_birth']);
	$date_of_birth = check_input( $date_of_birth);

	$date_of_death = sanitize_text_field($_POST['date_of_death']);
	$date_of_death = check_input( $date_of_death);

	$p_id = sanitize_text_field($_POST['p_id']);
	$p_id = check_input( $p_id);
	
	$pic=($_FILES['file-upload']['name']);


require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attachment_id = media_handle_upload('file-upload', $name);

	include ('tablename.php');


	$wpdb->update($table_name,
	array('first_name'=>$first_name,'middle_name'=>$middle_name,'family_name'=>$family_name,'date_of_birth'=>$date_of_birth,'date_of_death'=>$date_of_death, 'image'=>$pic
	),
	array('id'=>$p_id));
	
	$ch_post_id = $wpdb->get_var( "SELECT post_id FROM $table_name WHERE id =$p_id" );	
	$table_name = $wpdb->prefix . "posts";

	$wpdb->update('wp_posts',
	array('post_title'=>$first_name." ".$family_name
	),
	array('id'=>$ch_post_id));
	
	header("Location: ".bloginfo('url')."/wp-admin/admin.php?page=add-submenu-view-title-info");
}

}



//End the Admin Sub Menu Edit Title Info






// Add Delete Title Info


function add_wdl_genealogy_tools_delete_title_profile_info () {
	
		ob_start();
	include ('tablename.php');

	$sql="SELECT id, first_name, middle_name, family_name, date_of_birth, date_of_death FROM $table_name ORDER BY first_name "; 
	$result=mysql_query($sql); 

	$options=""; 

	while ($row=mysql_fetch_array($result)) { 



    $id=sanitize_text_field( $row["id"]); 
	$id=check_input($row["id"]);
	
    $first_name=sanitize_text_field( $row["first_name"]); 
	$first_name=check_input($row["first_name"]); 
	
	$middle_name=sanitize_text_field( $row["middle_name"]); 
	$middle_name=check_input($row["middle_name"]); 
	
    $family_name=sanitize_text_field( $row["family_name"]); 
	$family_name=check_input($row["family_name"]); 
	
    $date_of_birth=sanitize_text_field( $row["date_of_birth"]); 
	$date_of_birth=check_input($row["date_of_birth"]); 
	
	$date_of_death=sanitize_text_field( $row["date_of_death"]); 
	$date_of_death=check_input($row["date_of_death"]); 

	
    $options.="<OPTION VALUE='". $row['id']. "'>".$id."   ---   ".$first_name ." ".$middle_name ." ".$family_name."    --- ".$date_of_birth." ".$date_of_death; 
	}

?> 
    
    <h2>WDL Pedigree Chart - Delete Title Info</h2>
    <p>From this page you will be able to delete Title Info</p>
    
    <p>&nbsp;</p>

	<br />
	<br />

<div id="form">
	
    <form action="" method="post" name="new_person">

	<label  align="left" for="person_id">Select Spouse 1. *</label>
	
    <p></p>
    
	<select name="person_id" id="person_id" style="width: 400px">
  	
    <option><?=$options?> </option>
	
    </select>

    <br />
    <br  />
       <p>

    <input type="submit" name="submit" id="submit" value="Delete Person" />

    </p>
    </form>
<?php
		include ('tablename.php');
    $person_id = sanitize_text_field( $_POST["person_id"]); 
	$person_id=check_input($person_id,"You Need to Select A Person"); 

	$wpdb->query( "DELETE FROM $table_name WHERE id = $person_id" );
}



// Add Change Look Menu

function add_wdl_genealogy_tools_change_look () {



	

?>
<div class="wrap">
<h2>WDL Pedigree Chart - Change the Look and Feel</h2>
    <p>From this page you will be able to change the look and feel of your site</p><br />
    

 
<?php
include ('style_info.php');





?>    
	
<div id="change_look_form">
            <div id="example">
            <p><strong>Important Notes: </strong>
            <br />
            <hr />

            <br />
           <strong> COLORS </strong>
            <br />
            Use the <a href="http://www.w3schools.com/tags/ref_colorpicker.asp" target="blank">Hexadecimal Format</a> 
            <br />
            For example: for Black use   000000 , for White use  ffffff etc
            <br />
            <br />
            <strong>No Leading # </strong>
            <br />
            <hr />
            <br />
            <strong>WIDTHS AND MARGINS</strong>
            <br />
            Use a % for both. For example: Table Width   50% , Margin Left   10% ,Margin Right  40%
            <br />
            <br />
            <hr />
            <br />
            <strong>FONT SIZE</strong>
            <br />
            Use numbers. For example: 12 or 12.5
             <br />
             <br />
            <strong>No px at the end. </strong>
            </p>
            <hr /> 
           <br />
            <strong>FONT WEIGHT</strong>
            <br />
            <br />
            bold, normal, inherit
            <br />
          
            <br />
             <strong>FONT STYLE</strong>
            <br />
            <br />
            normal, italic, oblique, inherit
            <br />
            
            <br />
               <strong>TEXT TRANSFORM</strong>
            <br />
            <br />
            none, capitalize, uppercase, lowercase, inherit
            <br />
                        <br />
              <strong>TEXT DECORATION</strong>
            <br />
            <br />
            none, underline, overline, line-through, blink, inherit
            <br />
            <br />
            <hr />
            <br />
            </div>   
  			<p><strong>Please Note:</strong> Depending on your Setup you may need to Reload the Page to view the changes</p>


<div id="change_look_outer">

<input type="button" value="Reload Page" onClick="document.location.reload(true)">

<form action="" method="post" id="change_css">
 <br /><br />
   <p class="form_heading">CSS Title Shortcode</p>
 <div id="change_look_top">
   <div id="change_look_top_left">
   
<fieldset id="look">

<p class="form_heading">Title Profile Image and Text Area</p>
          
     		<p class="form_look">	
          	Title Profile Area Width
			
      		<input name="wdl_title_profile_width" type="text" id="wdl_title_profile_width" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_title_profile_width)?>"/>
			</p>
            
            <p class="form_look">	
          	Title Profile Area Background Color
			
      		<input name="wdl_title_bk_color" type="text" id="wdl_title_bk_color" size="25" maxlength="10" value="<? echo htmlspecialchars($wdl_title_bk_color)?>"/>
			</p>
            
            <p class="form_look">	
          	Title Profile Area Margin Left
			
      		<input name="wdl_title_margin_left" type="text" id="wdl_title_margin_left" size="25" maxlength="10" value="<? echo htmlspecialchars($wdl_title_margin_left)?>"/>
			</p>
            
             <p class="form_look">	
          	Title Profile Area Margin Right
			
      		<input name="wdl_title_margin_right" type="text" id="wdl_title_margin_right" size="25" maxlength="10" value="<? echo htmlspecialchars($wdl_title_margin_right)?>"/>
			</p>
            


   
</fieldset>
  
<fieldset id="look">
   			<p class="form_heading">Title Text Field Width</p>
          
     		<p class="form_look">	
          	Text Field Width
			
      		<input name="wdl_title_text_ft_width" type="text" id="wdl_title_text_ft_width" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_title_text_ft_width)?>"/>
			</p>
      		
            <p class="form_look">	
            Title Text Field Float
			
      		<input name="wdl_title_text_float" type="text" id="wdl_title_text_float" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_title_text_float)?>" />
			</p>
            
            <p class="form_look">	
            Title Text Padding Top
			
      		<input name="wdl_title_text_pd_top" type="text" id="wdl_title_text_pd_top" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_title_text_pd_top)?>" />
			</p>
             
             <p class="form_look">	
            Title Text Padding Left
			
      		<input name="wdl_title_text_pd_left" type="text" id="wdl_title_text_pd_left" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_title_text_pd_left)?>" />
			</p>
            
             <p class="form_look">	
            Title Text Padding Right
			
      		<input name="wdl_title_text_pd_right" type="text" id="wdl_title_text_pd_right" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_title_text_pd_right)?>" />
			</p>
                  
           </fieldset>




		<fieldset id="look">
   			<p class="form_heading">First and Middle Name</p>
          
     		<p class="form_look">	
          	Text Alignment
			
      		<input name="wdl_first_middle_names_ft_align" type="text" id="wdl_first_middle_names_ft_align" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_align)?>" />
			</p>
      		
            <p class="form_look">	
            Font Family
			
      		<input name="wdl_first_middle_names_ft_family" type="text" id="wdl_first_middle_names_ft_family" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_family)?>"/>
			</p>
                  
            <p class="form_look">	
            Font Weight
			
      		<input name="wdl_first_middle_names_ft_weight" type="text" id="wdl_first_middle_names_ft_weight" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_weight)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
			
      		<input name="wdl_first_middle_names_ft_color" type="text" id="wdl_first_middle_names_ft_color" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_color)?>"/>
			</p>
            
             <p class="form_look">	
            Font Size
			
      		<input name="wdl_first_middle_names_ft_size" type="text" id="wdl_first_middle_names_ft_size" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_size)?>"/>
			</p>
            
            <p class="form_look">	
            Font Style
			
      		<input name="wdl_first_middle_names_ft_style" type="text" id="wdl_first_middle_names_ft_style" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_first_middle_names_ft_style)?>"/>
			</p>
            
      </fieldset>
      
      <fieldset id="look">
   			<p class="form_heading">Family Name</p>
          
     		<p class="form_look">	
          	Text Alignment
			
      		<input name="wdl_family_name_ft_align" type="text" id="wdl_family_name_ft_align" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_family_name_ft_align)?>"/>
			</p>
      		
            <p class="form_look">	
            Font Family
			
      		<input name="wdl_family_name_ft_family" type="text" id="wdl_family_name_ft_family" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_family_name_ft_family)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Font Weight
			
      		<input name="wdl_family_name_ft_weight" type="text" id="wdl_family_name_ft_weight" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_family_name_ft_weight)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
			
      		<input name="wdl_family_name_ft_color" type="text" id="wdl_family_name_ft_color" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_family_name_ft_color)?>"/>
			</p>
            
                       <p class="form_look">	
            Font Size
			
      		<input name="wdl_family_name_ft_size" type="text" id="wdl_family_name_ft_size" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_family_name_ft_size)?>"/>
			</p>
            
            <p class="form_look">	
            Font Style
			
      		<input name="wdl_family_name_ft_style" type="text" id="wdl_family_name_ft_style" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_family_name_ft_style)?>"/>
			</p>
            
            <p class="form_look">	
            Font Transform
			
      		<input name="wdl_family_name_ft_transform" type="text" id="wdl_family_name_ft_transform" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_family_name_ft_transform)?>"/>
			</p>
            
                        <p class="form_look">	
            Spacing Above Family Name
			
      		<input name="wdl_family_name_text_pd_top" type="text" id="wdl_family_name_text_pd_top" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_family_name_text_pd_top)?>"/>
			</p>
            
                        <p class="form_look">	
            Spacing Below Family Name
			
      		<input name="wdl_family_name_text_pd_bottom" type="text" id="wdl_family_name_text_pd_bottom" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_family_name_text_pd_bottom)?>"/>
			</p>
            
      </fieldset>

  </div> <!-- End change_look_top_left div -->
  
  <div id="change_look_top_right">
		
             <fieldset id="look">
   			<p class="form_heading">Nee</p>
          
     		<p class="form_look">	
          	Text Alignment
			
      		<input name="wdl_nee_ft_align" type="text" id="wdl_nee_ft_align" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_nee_ft_align)?>"/>
			</p>
      		
            <p class="form_look">	
            Font Family
			
      		<input name="wdl_nee_ft_family" type="text" id="wdl_nee_ft_family" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_nee_ft_family)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Font Weight
			
      		<input name="wdl_nee_ft_weight" type="text" id="wdl_nee_ft_weight" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_nee_ft_weight)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
			
      		<input name="wdl_nee_ft_color" type="text" id="wdl_nee_ft_color" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_nee_ft_color)?>"/>
			</p>
            
                       <p class="form_look">	
            Font Size
			
      		<input name="wdl_nee_ft_size" type="text" id="wdl_nee_ft_size" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_nee_ft_size)?>"/>
			</p>
            
            <p class="form_look">	
            Font Style
			
      		<input name="wdl_nee_ft_style" type="text" id="wdl_nee_ft_style" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_nee_ft_style)?>"/>
			</p>
            
            <p class="form_look">	
            Font Transform
			
      		<input name="wdl_nee_ft_transform" type="text" id="wdl_nee_ft_transform" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_nee_ft_transform)?>"/>
			</p>
                                    <p class="form_look">	
            Spacing Left of nee
			
      		<input name="wdl_nee_text_pd_left" type="text" id="wdl_nee_text_pd_left" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_nee_text_pd_left)?>"/>
			</p>
            
                        <p class="form_look">	
            Spacing Right of nee
			
      		<input name="wdl_nee_text_pd_right" type="text" id="wdl_nee_text_pd_right" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_nee_text_pd_right)?>"/>
			</p>
            

            
      </fieldset>
      
      		<fieldset id="look">
   			<p class="form_heading">Maiden Name</p>
          
     		<p class="form_look">	
          	Text Alignment
			
      		<input name="wdl_maiden_name_ft_align" type="text" id="wdl_maiden_name_ft_align" size="25" maxlength="40" value="<? echo htmlspecialchars($wdl_maiden_name_ft_align)?>"/>
			</p>
      		
            <p class="form_look">	
            Font Family
			
      		<input name="wdl_maiden_name_ft_family" type="text" id="wdl_maiden_name_ft_family" size="25" maxlength="5" value="<? echo htmlspecialchars($wdl_maiden_name_ft_family)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Font Weight
			
      		<input name="wdl_maiden_name_ft_weight" type="text" id="wdl_maiden_name_ft_weight" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_maiden_name_ft_weight)?>"/>
			</p>
            
            <p class="form_look">	
            Font Color
			
      		<input name="wdl_maiden_name_ft_color" type="text" id="wdl_maiden_name_ft_color" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_maiden_name_ft_color)?>"/>
			</p>
            
                       <p class="form_look">	
            Font Size
			
      		<input name="wdl_maiden_name_ft_size" type="text" id="wdl_maiden_name_ft_size" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_maiden_name_ft_size)?>"/>
			</p>
            
            <p class="form_look">	
            Font Style
			
      		<input name="wdl_maiden_name_ft_style" type="text" id="wdl_maiden_name_ft_style" size="25" maxlength="7" value="<? echo htmlspecialchars($wdl_maiden_name_ft_style)?>"/>
			</p>
            
            <p class="form_look">	
            Font Transform
			
      		<input name="wdl_maiden_name_ft_transform" type="text" id="wdl_maiden_name_ft_transform" size="25" maxlength="11" value="<? echo htmlspecialchars($wdl_maiden_name_ft_transform)?>"/>
			</p>
            

            
      </fieldset>
      

  
      		<fieldset id="look">
   			<p class="form_heading">Dates</p>
       
     		<p class="form_look">	
          	Font Align
			
      		<input name="wdl_dates_ft_align" type="text" id="wdl_dates_ft_align" size="25" maxlength="40"  value="<? echo htmlspecialchars($wdl_dates_ft_align)?>"/>
			</p>
            
      
      		
            <p class="form_look">	
            Font Family
			
      		<input name="wdl_dates_ft_family" type="text" id="wdl_dates_ft_family" size="25" maxlength="5"  value="<? echo htmlspecialchars($wdl_dates_ft_family)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Font Weight
			
      		<input name="wdl_dates_ft_weight" type="text" id="wdl_dates_ft_weight" size="25" maxlength="11"  value="<? echo htmlspecialchars($wdl_dates_ft_weight)?>"/>
			</p>
            
            <p class="form_look">	
            Font Size
			
      		<input name="wdl_dates_ft_size" type="text" id="wdl_dates_ft_size" size="25" maxlength="15" value="<? echo htmlspecialchars($wdl_dates_ft_size)?>" />
			</p>
</fieldset>
      
            		<fieldset id="look">

   			<p class="form_heading">Profile Image</p>
           
<p class="form_look">	
            Profile Image Float
      		<input name="wdl_profile_image_float" type="text" id="wdl_profile_image_float" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_float)?>"/>
			</p>
<p class="form_look">				
			Profile Padding Left
      		<input name="wdl_profile_image_pd_left" type="text" id="wdl_profile_image_pd_left" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_pd_left)?>"/>
			</p>
<p class="form_look">				
			Profile Padding Right
      		<input name="wdl_profile_image_pd_right" type="text" id="wdl_profile_image_pd_right" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_pd_right)?>"/>
			</p>
            
            <p class="form_look">				
			Profile Padding Top
      		<input name="wdl_profile_image_pd_top" type="text" id="wdl_profile_image_pd_top" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_pd_top)?>"/>
			</p>
            
            <p class="form_look">				
			Profile Padding Bottom
      		<input name="wdl_profile_image_pd_bottom" type="text" id="wdl_profile_image_pd_bottom" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_pd_bottom)?>"/>
			</p>

          
<p class="form_look">	
            Profile Image Width
      		<input name="wdl_profile_image_width" type="text" id="wdl_profile_image_width" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_width)?>"/>
			</p>
                  
            
            <p class="form_look">	
            Profile Image Height
			
      		<input name="wdl_profile_image_height" type="text" id="wdl_profile_image_height" size="25" maxlength="12" value="<? echo htmlspecialchars($wdl_profile_image_height)?>" />
			</p>
 </fieldset>
  </div> <!-- End change_look_top_right div -->
</div> <!-- End change_look_top div -->







<div id="change_look_submit">		    <p><br /><br /><br />
      			<input  type="submit" name="submit" id="submit" value="Submit" onClick="document.location.reload(true)"/>
<input type="button" value="Reload Page" onClick="document.location.reload(true)">
      		</p>


           
			</form>
            
            
<? 
$url = plugins_url(); 
echo $url;
?>

<p><strong>Please Note:</strong> Depending on your Setup you may need to Reload the Page to view the changes</p>
</div> <!-- end change_look_submit div --->
</div> <!-- end change_look_outer div --->
<?php

if(isset($_POST['submit'])) {

	include ('tablename.php');
	
	// Collect data from Form for Image age text Area Detailsd 	
	
	$wdl_title_profile_width = sanitize_text_field( $_POST["wdl_title_profile_width"]); 
	$wdl_title_profile_width = check_input($wdl_title_profile_width); 
	
	$wdl_title_bk_color = sanitize_text_field( $_POST["wdl_title_bk_color"]); 
	$wdl_title_bk_color = check_input($wdl_title_bk_color); 
	
	$wdl_title_margin_left = sanitize_text_field( $_POST["wdl_title_margin_left"]); 
	$wdl_title_margin_left = check_input($wdl_title_margin_left); 
	
	$wdl_title_margin_right = sanitize_text_field( $_POST["wdl_title_margin_right"]); 
	$wdl_title_margin_right = check_input($wdl_title_margin_right); 

		

	
	// Collect data from Form for Title Text Field 	
	
	$wdl_title_text_ft_width = sanitize_text_field( $_POST["wdl_title_text_ft_width"]); 
	$wdl_title_text_ft_width = check_input($wdl_title_text_ft_width); 
	
	$wdl_title_text_float = sanitize_text_field( $_POST["wdl_title_text_float"]); 
	$wdl_title_text_float = check_input($wdl_title_text_float); 
	
	$wdl_title_text_pd_right = sanitize_text_field( $_POST["wdl_title_text_pd_right"]); 
	$wdl_title_text_pd_right = check_input($wdl_title_text_pd_right); 
	
	$wdl_title_text_pd_left = sanitize_text_field( $_POST["wdl_title_text_pd_left"]); 
	$wdl_title_text_pd_left = check_input($wdl_title_text_pd_left); 
	
	$wdl_title_text_pd_top = sanitize_text_field( $_POST["wdl_title_text_pd_top"]); 
	$wdl_title_text_pd_top = check_input($wdl_title_text_pd_top);
	
		// Collect data from Form for Title First and Middle Names	
	
	$wdl_first_middle_names_ft_align = sanitize_text_field( $_POST["wdl_first_middle_names_ft_align"]);
	$wdl_first_middle_names_ft_align = check_input($wdl_first_middle_names_ft_align); 
		
	$wdl_first_middle_names_ft_family = sanitize_text_field( $_POST["wdl_first_middle_names_ft_family"]);
	$wdl_first_middle_names_ft_family = check_input($wdl_first_middle_names_ft_family); 
		
	$wdl_first_middle_names_ft_weight = sanitize_text_field( $_POST["wdl_first_middle_names_ft_weight"]);
	$wdl_first_middle_names_ft_weight = check_input($wdl_first_middle_names_ft_weight); 
		
	$wdl_first_middle_names_ft_color = sanitize_text_field( $_POST["wdl_first_middle_names_ft_color"]);
	$wdl_first_middle_names_ft_color = check_input($wdl_first_middle_names_ft_color); 
		
	$wdl_first_middle_names_ft_size  = sanitize_text_field( $_POST["wdl_first_middle_names_ft_size"]);
	$wdl_first_middle_names_ft_size = check_input($wdl_first_middle_names_ft_size); 
		
	$wdl_first_middle_names_ft_style = sanitize_text_field( $_POST["wdl_first_middle_names_ft_style"]);
	$wdl_first_middle_names_ft_style = check_input($wdl_first_middle_names_ft_style); 
	
	// Collect data from Form for Title Family Names	
	
	$wdl_family_name_ft_align = sanitize_text_field( $_POST["wdl_family_name_ft_align"]);
	$wdl_family_name_ft_align = check_input($wdl_family_name_ft_align); 
	
	$wdl_family_name_ft_family = sanitize_text_field( $_POST["wdl_family_name_ft_family"]);
	$wdl_family_name_ft_family = check_input($wdl_family_name_ft_family);
	 
	$wdl_family_name_ft_weight = sanitize_text_field( $_POST["wdl_family_name_ft_weight"]);
	$wdl_family_name_ft_weight = check_input($wdl_family_name_ft_weight); 
	
	$wdl_family_name_ft_color = sanitize_text_field( $_POST["wdl_family_name_ft_color"]);
	$wdl_family_name_ft_color = check_input($wdl_family_name_ft_color); 
	
	$wdl_family_name_ft_size = sanitize_text_field( $_POST["wdl_family_name_ft_size"]);
	$wdl_family_name_ft_size = check_input($wdl_family_name_ft_size); 
	
	$wdl_family_name_ft_style = sanitize_text_field( $_POST["wdl_family_name_ft_style"]);
	$wdl_family_name_ft_style = check_input($wdl_family_name_ft_style); 
	
	$wdl_family_name_ft_transform = sanitize_text_field( $_POST["wdl_family_name_ft_transform"]);
	$wdl_family_name_ft_transform = check_input($wdl_family_name_ft_transform); 
	
	$wdl_family_name_text_pd_top = sanitize_text_field( $_POST["wdl_family_name_text_pd_top"]);
	$wdl_family_name_text_pd_top = check_input($wdl_family_name_text_pd_top); 
	
	$wdl_family_name_text_pd_bottom = sanitize_text_field( $_POST["wdl_family_name_text_pd_bottom"]);
	$wdl_family_name_text_pd_bottom = check_input($wdl_family_name_text_pd_bottom); 
	
		// Collect data from Form for Title Maiden Names	
	
	$wdl_maiden_name_ft_align = sanitize_text_field( $_POST["wdl_maiden_name_ft_align"]);
	$wdl_maiden_name_ft_align = check_input($wdl_maiden_name_ft_align); 
	
	$wdl_maiden_name_ft_family = sanitize_text_field( $_POST["wdl_maiden_name_ft_family"]);
	$wdl_maiden_name_ft_family = check_input($wdl_maiden_name_ft_family);
	 
	$wdl_maiden_name_ft_weight = sanitize_text_field( $_POST["wdl_maiden_name_ft_weight"]);
	$wdl_maiden_name_ft_weight = check_input($wdl_maiden_name_ft_weight); 
	
	$wdl_maiden_name_ft_color = sanitize_text_field( $_POST["wdl_maiden_name_ft_color"]);
	$wdl_maiden_name_ft_color = check_input($wdl_maiden_name_ft_color); 
	
	$wdl_maiden_name_ft_size = sanitize_text_field( $_POST["wdl_maiden_name_ft_size"]);
	$wdl_maiden_name_ft_size = check_input($wdl_maiden_name_ft_size); 
	
	$wdl_maiden_name_ft_style = sanitize_text_field( $_POST["wdl_maiden_name_ft_style"]);
	$wdl_maiden_name_ft_style = check_input($wdl_maiden_name_ft_style); 
	
	$wdl_maiden_name_ft_transform = sanitize_text_field( $_POST["wdl_maiden_name_ft_transform"]);
	$wdl_maiden_name_ft_transform = check_input($wdl_maiden_name_ft_transform); 
	
	$wdl_maiden_name_text_pd_top = sanitize_text_field( $_POST["wdl_maiden_name_text_pd_top"]);
	$wdl_maiden_name_text_pd_top = check_input($wdl_maiden_name_text_pd_top); 
	
	$wdl_maiden_name_text_pd_bottom = sanitize_text_field( $_POST["wdl_maiden_name_text_pd_bottom"]);
	$wdl_maiden_name_text_pd_bottom = check_input($wdl_maiden_name_text_pd_bottom); 
	
			// Collect data from Form for Title Maiden Names	
	
	$wdl_nee_ft_align = sanitize_text_field( $_POST["wdl_nee_ft_align"]);
	$wdl_nee_ft_align = check_input($wdl_nee_ft_align); 
	
	$wdl_nee_ft_family = sanitize_text_field( $_POST["wdl_nee_ft_family"]);
	$wdl_nee_ft_family = check_input($wdl_nee_ft_family);
	 
	$wdl_nee_ft_weight = sanitize_text_field( $_POST["wdl_nee_ft_weight"]);
	$wdl_nee_ft_weight = check_input($wdl_nee_ft_weight); 
	
	$wdl_nee_ft_color = sanitize_text_field( $_POST["wdl_nee_ft_color"]);
	$wdl_nee_ft_color = check_input($wdl_nee_ft_color); 
	
	$wdl_nee_ft_size = sanitize_text_field( $_POST["wdl_nee_ft_size"]);
	$wdl_nee_ft_size = check_input($wdl_nee_ft_size); 
	
	$wdl_nee_ft_style = sanitize_text_field( $_POST["wdl_nee_ft_style"]);
	$wdl_nee_ft_style = check_input($wdl_nee_ft_style); 
	
	$wdl_nee_ft_transform = sanitize_text_field( $_POST["wdl_nee_ft_transform"]);
	$wdl_nee_ft_transform = check_input($wdl_nee_ft_transform); 
	
	$wdl_nee_text_pd_left = sanitize_text_field( $_POST["wdl_nee_text_pd_left"]);
	$wdl_nee_text_pd_left = check_input($wdl_nee_text_pd_left); 
	
	$wdl_nee_text_pd_right = sanitize_text_field( $_POST["wdl_nee_text_pd_right"]);
	$wdl_nee_text_pd_right = check_input($wdl_nee_text_pd_right); 
	
	
	// Collect data from Form for Title Family Names
		
	$wdl_dates_ft_align = sanitize_text_field( $_POST["wdl_dates_ft_align"]);
	$wdl_dates_ft_align = check_input($wdl_dates_ft_align);
		
	$wdl_dates_ft_family = sanitize_text_field( $_POST["wdl_dates_ft_family"]);
	$wdl_dates_ft_family = check_input($wdl_dates_ft_family);
		
	$wdl_dates_ft_weight = sanitize_text_field( $_POST["wdl_dates_ft_weight"]);
	$wdl_dates_ft_weight = check_input($wdl_dates_ft_weight);
		
	$wdl_dates_ft_size = sanitize_text_field( $_POST["wdl_dates_ft_size"]);
	$wdl_dates_ft_size = check_input($wdl_dates_ft_size);	
	
		// Collect data from Form for Title Profile Image
		
	$wdl_profile_image_float = sanitize_text_field( $_POST["wdl_profile_image_float"]);
	$wdl_profile_image_float = check_input($wdl_profile_image_float);	

	$wdl_profile_image_pd_left = sanitize_text_field( $_POST["wdl_profile_image_pd_left"]);
	$wdl_profile_image_pd_left = check_input($wdl_profile_image_pd_left);	
		
	$wdl_profile_image_pd_right = sanitize_text_field( $_POST["wdl_profile_image_pd_right"]);
	$wdl_profile_image_pd_right = check_input($wdl_profile_image_pd_right);

	$wdl_profile_image_pd_top = sanitize_text_field( $_POST["wdl_profile_image_pd_top"]);
	$wdl_profile_image_pd_top = check_input($wdl_profile_image_pd_top);
		
	$wdl_profile_image_pd_bottom = sanitize_text_field( $_POST["wdl_profile_image_pd_bottom"]);
	$wdl_profile_image_pd_bottom = check_input($wdl_profile_image_pd_bottom);
	
	$wdl_profile_image_width = sanitize_text_field( $_POST["wdl_profile_image_width"]);
	$wdl_profile_image_width = check_input($wdl_profile_image_width);	
		
	$wdl_profile_image_height = sanitize_text_field( $_POST["wdl_profile_image_height"]);	
	$wdl_profile_image_height = check_input($wdl_profile_image_height);	
		
		
	
		
$wpdb->update($table_name3,

	array(
	
	// Update data from Form for Title and Image Area Details 

	'wdl_title_profile_width'=>$wdl_title_profile_width,
	'wdl_title_bk_color'=>$wdl_title_bk_color,
	'wdl_title_margin_left'=>$wdl_title_margin_left,
	'wdl_title_margin_right'=>$wdl_title_margin_right,

	// Update data from Form for Title Text Field 
		
	'wdl_title_text_ft_width'=>$wdl_title_text_ft_width,
	'wdl_title_text_float'=>$wdl_title_text_float,
	'wdl_title_text_pd_top'=>$wdl_title_text_pd_top,
	'wdl_title_text_pd_right'=>$wdl_title_text_pd_right,
	'wdl_title_text_pd_left'=>$wdl_title_text_pd_left,
	
	// Update data from Form for Title First and Middle Name 
	
	'wdl_first_middle_names_ft_align'=>$wdl_first_middle_names_ft_align,
	'wdl_first_middle_names_ft_family'=>$wdl_first_middle_names_ft_family,
	'wdl_first_middle_names_ft_weight'=>$wdl_first_middle_names_ft_weight,
	'wdl_first_middle_names_ft_color'=>$wdl_first_middle_names_ft_color,
	'wdl_first_middle_names_ft_size'=>$wdl_first_middle_names_ft_size,
	'wdl_first_middle_names_ft_style'=>$wdl_first_middle_names_ft_style,

	// Update data from Form for Title Family Name 
		
	'wdl_family_name_ft_align'=>$wdl_family_name_ft_align,
	'wdl_family_name_ft_family'=>$wdl_family_name_ft_family,
	'wdl_family_name_ft_weight'=>$wdl_family_name_ft_weight,
	'wdl_family_name_ft_color'=>$wdl_family_name_ft_color,
	'wdl_family_name_ft_size'=>$wdl_family_name_ft_size,
	'wdl_family_name_ft_style'=>$wdl_family_name_ft_style,
	'wdl_family_name_ft_transform'=>$wdl_family_name_ft_transform,
	'wdl_family_name_text_pd_top'=>$wdl_family_name_text_pd_top,
	'wdl_family_name_text_pd_bottom'=>$wdl_family_name_text_pd_bottom,
	
	// Update data from Form for Title Maiden Name 
		
	'wdl_maiden_name_ft_align'=>$wdl_maiden_name_ft_align,
	'wdl_maiden_name_ft_family'=>$wdl_maiden_name_ft_family,
	'wdl_maiden_name_ft_weight'=>$wdl_maiden_name_ft_weight,
	'wdl_maiden_name_ft_color'=>$wdl_maiden_name_ft_color,
	'wdl_maiden_name_ft_size'=>$wdl_maiden_name_ft_size,
	'wdl_maiden_name_ft_style'=>$wdl_maiden_name_ft_style,
	'wdl_maiden_name_ft_transform'=>$wdl_maiden_name_ft_transform,
	'wdl_maiden_name_text_pd_top'=>$wdl_maiden_name_text_pd_top,
	'wdl_maiden_name_text_pd_bottom'=>$wdl_maiden_name_text_pd_bottom,
	
		// Update data from Form for Title Maiden Name 
		
	'wdl_nee_ft_align'=>$wdl_nee_ft_align,
	'wdl_nee_ft_family'=>$wdl_nee_ft_family,
	'wdl_nee_ft_weight'=>$wdl_nee_ft_weight,
	'wdl_nee_ft_color'=>$wdl_nee_ft_color,
	'wdl_nee_ft_size'=>$wdl_nee_ft_size,
	'wdl_nee_ft_style'=>$wdl_nee_ft_style,
	'wdl_nee_ft_transform'=>$wdl_nee_ft_transform,
	'wdl_nee_text_pd_left'=>$wdl_nee_text_pd_left,
	'wdl_nee_text_pd_right'=>$wdl_nee_text_pd_right,

	// Update data from Form for Title Dates 

	'wdl_dates_ft_align'=>$wdl_dates_ft_align,
	'wdl_dates_ft_family'=>$wdl_dates_ft_family,
	'wdl_dates_ft_weight'=>$wdl_dates_ft_weight,
	'wdl_dates_ft_size'=>$wdl_dates_ft_size,
	
		// Update data from Form for Profile Image 
		
	'wdl_profile_image_float'=>$wdl_profile_image_float,
	'wdl_profile_image_pd_left'=>$wdl_profile_image_pd_left,
	'wdl_profile_image_pd_right'=>$wdl_profile_image_pd_right,
	'wdl_profile_image_pd_top'=>$wdl_profile_image_pd_top,
	'wdl_profile_image_pd_bottom'=>$wdl_profile_image_pd_bottom,
	'wdl_profile_image_width'=>$wdl_profile_image_width,
	'wdl_profile_image_height'=>$wdl_profile_image_height,	

	),

	array('id'=> 1));
?>
<script type="text/javascript" src="<?php echo plugins_url( 'script.js', __FILE__ );?>"></script>
<script>
refreshPage();
</script>
<?





	
}

}





// --------------------------------------------------------------------------------------------------------- //







// CREATE THE DATA IN OUT CHECKS



function check_input($data, $problem='')
{
    $data = strip_tags($data);
	$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

  
    if ($problem && strlen($data) == 0)
    {
        die($problem);
    }
    return $data;
}

function check_input_sanitize($data, $problem='')
{

  	$data = sanitize_text_field($data);
  
    if ($problem && strlen($data) == 0)
    {
        die($problem);
    }
    return $data;
}
?>