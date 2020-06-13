<?php

	include('scripts/connect_db.php');

    if(isset($_POST['user']) && $_POST['user'] != "" &&
       isset($_POST['quiz_n']) && $_POST['quiz_n'] != ""){

    
        $user=mysql_real_escape_string($_POST['user']);
        $quiz_n=mysql_real_escape_string($_POST['quiz_n']);

        $fetch=mysql_query("SELECT id FROM participants 
                            WHERE username='$user'")or die(mysql_error());
        $count=mysql_num_rows($fetch);
        if($count!="")
        {
        	$user_msg = 'Sorry, but username '.$user.' is already in use!';
            header('location: new_part.php?msg='.$user_msg.'');
        }
        else
        {
            mysql_query("INSERT INTO participants (username, quiz_id) 
            	VALUES ('$user','$quiz_n')")or die(mysql_error());

        	$user_msg = 'Participant username,'.$user.' has been added!';
            header('location: new_part.php?msg='.$user_msg.'');
        }
    }else{
        $user_msg = 'Sorry, but Something went wrong';
        header('location: new_part.php?msg='.$user_msg.'');
    }

?>

