<?php
 /*
 	@params e [int] the identifer for the event
 	@params uid [int] the identifer for the user to be removed
 */
 
 $event_id = $_GET['e'];
 $user = $_GET['uid'];
 
 include('dbconnection.php');
 
 $mysqli->query('DELETE FROM training_registers WHERE event_id = '.$event_id.' AND user_id = '.$user);
 if($mysqli->affected_rows >= 1)
 {
 	echo "Worked";
 }
 else
 {
 	echo "error";
 }
?>