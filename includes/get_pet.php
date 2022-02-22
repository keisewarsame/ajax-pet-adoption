<?php
//critter_handler.php
//responds to ja_post.php & ja_get.php via POST or GET ajax request
//$_REQUEST handles post or get
if(isset($_REQUEST['critter']))
{
	$critter_type = ucfirst($_REQUEST['critter']);
	//$petNames = ($_REQUEST['petName']);
	echo '<h3>You have selected a lovely pet ' . $critter_type . '!</h3>';
	//echo '<h4>Your new pet is called ' . $petNames . '!</h4>';
	echo '<img src="/images/' . $_REQUEST['critter'] . '.jpg" style="max-width:500px;" />';
}else{
	echo 'sorry, no critter!';

}

?>