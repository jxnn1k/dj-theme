	
<?php
/**
 * The header for our theme
 *
 * This is the template thatt displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dj
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body>

<div class="container-sm">
	<div class="nav">	
		
			<a href="<?= home_url();?>" class="nav__brand"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="38" viewBox="0 0 34.526 57.458">
  			<path id="Icon_ionic-ios-flash" data-name="Icon ionic-ios-flash" d="M38.539,25.1H25.663L31.9,2.86a.481.481,0,0,0-.857-.4L9.181,31.123a1,1,0,0,0,.75,1.595H22.807L16.571,54.96a.481.481,0,0,0,.857.4L39.289,26.708A1.015,1.015,0,0,0,38.539,25.1Z" transform="translate(-6.968 -0.181)" fill="#F16529" stroke="#F16529" stroke-width="4"/>
			</svg> schalli</a>
			

			<ul class="nav__ul">
				<li class="nav__li"><a href="/" class="nav__content">galerie</a></li>
				<li class="nav__li"><a href="/" class="nav__content">kontakt</a></li>
				<li class="nav__li"><a href="/" class="nav__content">impressum</a></li>
			</ul>	
	
	</div>
</div>


<?php
	 if(is_single()) :  ?>

		<div class="post-header">
			<?php the_post_thumbnail('nk-16by9-lg', ['class' => 'post-header__image']); ?>
			<div class="container-md">
			
			</div>
		</div>

<?php endif; ?>
	


