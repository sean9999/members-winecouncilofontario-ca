<?php

switch ($action) {

	case 'form_save':
		$PostingUser= null;
		$QuestionID = null;
		$Answer		= null;
		$WineryID	= null;
		$Comment	= null;
		$AnswerID	= null;
		foreach($_POST as $key => $value)
		{
			if ($key == "FormQuestions") {}
			elseif ($key == "UserID") $PostingUser = $value;
			elseif (strlen($key) >= 7 && substr_compare($key,"comment", 0, 7) == 0)
			{	
				//	insert (or update) comments
				$QuestionID	= substr($key, 7, 10);
				$Comment	= $value;
				$WineryID	= good_query_value("SELECT WineryID FROM Users WHERE UserID=" . $PostingUser);
				$AnswerID	= good_query_value("SELECT AnswerID FROM SurveyAnswers WHERE QuestionID = " . $QuestionID . " AND WineryID = " . $WineryID);
				if($AnswerID)
				{
					good_query("UPDATE SurveyAnswers SET Comments='" . $Comment . "', ztamp=NOW() WHERE AnswerID=" . $AnswerID);
				}
				else 
				{
					good_query("INSERT INTO SurveyAnswers (QuestionID, WineryID, UserID, Comments, ztamp) VALUES (" . $QuestionID . ", " . $WineryID . ", " . $PostingUser . ", '" . $Comment . "', NOW())");
				}	
			}
			else
			{
				//	insert (or update) answers
				$QuestionID	= $key;
				$Answer		= $value;
				$WineryID	= good_query_value("SELECT WineryID FROM Users WHERE UserID=" . $PostingUser);
				$AnswerID	= good_query_value("SELECT AnswerID FROM SurveyAnswers WHERE QuestionID = " . $QuestionID . " AND WineryID = " . $WineryID);
				
				if($AnswerID)
				{
					good_query("UPDATE SurveyAnswers SET Answer='" . $Answer . "', ztamp=NOW() WHERE AnswerID=" . $AnswerID);
				}
				else 
				{
					good_query("INSERT INTO SurveyAnswers (QuestionID, WineryID, UserID, Answer, ztamp) VALUES (" . $QuestionID . ", " . $WineryID . ", " . $PostingUser . ", '" . $Answer . "', NOW())");
				}			
			}
		}
		$message = 'The answers have been saved to the database.';
		break;

	case 'send_password':
		connect2database();
		$_POST = cleanForDB($_POST);
		extract($_POST);
		$usr = good_query_assoc("SELECT * FROM Users WHERE Email = '$Email'");
		if (strlen($usr['Email'])) {
		$password_remind_msg = 'Hello, Your password is ' . $usr['Password'] . '.';
		$sent = mail($usr['Email'], 'Your TateGroup password', $password_remind_msg); 
		$message = 'Your password has been sent.';
		$view = 'login';
		} else {
		$message = 'That was an invalid email address.';
		$view = 'forgot_password';
		}
		break;

	case 'email_to_friend':
		connect2database();
		$P		= cleanForDB($_POST);
		$G		= cleanForDB($_GET);
		$crlf	= "\n";
		$mailbody = '<p>' . $P['event_desc'] . '</p><p>' . HomePathWeb . 'event?event_id=' . $G['event_id'] . '</p>';
		$plaintext_mailbody = strip_tags($mailbody);
		//	Send mail
		include('Mail.php');
		include('Mail/mime.php');
		require_once 'function.characterConversions.php';
		
		$hdrs	= array('From' => $P['from_email'], 'Subject' => $P['event_title']);
		$mime = new Mail_mime($crlf);	
		$mime->setTXTBody($plaintext_mailbody);
		$mime->setHTMLBody($mailbody);
		$body	= $mime->get();
		$hdrs	= $mime->headers($hdrs);
		$mail 	=& Mail::factory('mail');
		$go = $mail->send($P['to_email'], $hdrs, $body);
		if ($go) {
			$message = 'Thank you. An email has been sent to the address you specified.';
		} else {
			$message = 'There was an error sending the email.';
		}
		//new dBug($P);
		//new dBug($mailbody);
	break;

	case 'create_event':
		require_once 'function.textConversions.php';
		connect2database();
		$P					= cleanForDB($_POST);
		$dateparts			= explode('-',$P['event_date']);
		$E					= array();
		$E['event_day']		= $dateparts[2];
		$E['event_month']	= $dateparts[1];
		$E['event_year']	= $dateparts[0];
		if (isset($_POST['event_region_ids'])) {
		$E['eri']			= implode(',',$_POST['event_region_ids']);
		} else {
		$E['eri']			= '';
		}
		if (isset($_POST['event_attraction_tags'])) {
		$E['eat']			= implode(',',$_POST['event_attraction_tags']);
		} else {
		$E['eat']			= '';
		}
		$E['web']			= niceURL($P['info_website']);
		$E['is_active']		= (int) isset($P['is_active']);
		$ins_SQL			= <<<BLOCK
		INSERT INTO Events (event_day,event_month,event_year,event_time,event_title,event_desc,event_banner,event_date,event_date_end,event_time_end,event_region_ids,event_attraction_tags,info_hours,info_location,info_phone,info_email,info_website,info_price,is_active)
		VALUES ($E[event_day],$E[event_month],$E[event_year],'$P[event_time]','$P[event_title]','$P[event_desc]','$P[event_banner]','$P[event_date]','$P[event_date_end]','$P[event_time_end]','$E[eri]','$E[eat]','$P[info_hours]','$P[info_location]','$P[info_phone]','$P[info_email]','$E[web]','$P[info_price]',$E[is_active])
BLOCK;
		$ins		= good_query(trim($ins_SQL));
		//	now mail it to person
		include('Mail.php');
		include('Mail/mime.php');
		require_once 'function.characterConversions.php';
		$hdrs	= array('From' => EVENTS_EMAIL_SENDER, 'Subject' => 'Someone just submitted an event');
		$admin_address = HomePathWeb . 'admin';
		$mailbody = "
		<div>
		<p>$P[submit_name] just submitted an event called <em>$P[event_title]</em></p>
		<p>Their email address is $P[submit_email]</p>
		<p>You can view it at: <a href=\"$admin_address\">$admin_address</a></p>
		</div>";
		$plaintext_mailbody = "
		$P[submit_name] just submitted an event called $P[event_name]
		Their email address is $P[submit_email]
		You can view it at: $admin_address
		";
		$crlf	= "\n";
		$mime	= new Mail_mime($crlf);	
		$mime->setTXTBody($plaintext_mailbody);
		$mime->setHTMLBody($mailbody);
		$body	= $mime->get();
		$hdrs	= $mime->headers($hdrs);
		$mail 	=& Mail::factory('mail');
		$go = $mail->send(EVENTS_EMAIL_RECEIVER, $hdrs, $body);
		$message= 'Thank you. The event <em>' . $E['event_title'] . '</em> has been submitted to the WCO.';
		break;

	case 'reset_password':
		connect2database();
		$P				= cleanForDB($_POST);
		$User			= good_query_assoc("SELECT * FROM Users WHERE Email = '$P[email]'");
		if ($User) {
			//	change the password
			$new_pass	= str_rot13(uniqid());
			$upd		= good_query("UPDATE Users SET Password = '$new_pass' WHERE UserID = $User[UserID]");
			//	email the user
			include('Mail.php');
			include('Mail/mime.php');
			$hdrs	= array('From' => EMAIL_SENDER, 'Subject' => 'Your password has been reset');
			$mailbody = "
			<div>
			<p>Dear $User[Name],</p>
			<p>Your password for members.winecouncilofontario.ca has been reset to:</p>
			<p>$new_pass</p>
			</div>";
			$plaintext_mailbody = strip_tags($mailbody);
			$crlf	= "\n";
			$mime	= new Mail_mime($crlf);	
			$mime->setTXTBody($plaintext_mailbody);
			$mime->setHTMLBody($mailbody);
			$body	= $mime->get();
			$hdrs	= $mime->headers($hdrs);
			$mail 	=& Mail::factory('mail');
			$go = $mail->send($User['Email'], $hdrs, $body);
			$message	= 'Thank you. Your password has been reset. Please check your email to retrieve your new temporary password.';
		} else {
			$message	= 'That email was not found in our database. Please try again, or <a href="account-create.php">signup for a new account</a>';
		}
		break;

	case 'eat_crow':
		connect2database();
		$users		= good_query_table("SELECT * FROM Users");
		include('Mail.php');
		include('Mail/mime.php');
		$hdrs	= array('From' => EMAIL_SENDER, 'Subject' => 'Your password on members.winesofontario.org has been reset');
		$crlf	= "\n";
		foreach ($users as $u) {
			$mailbody = "
			<div>
			<p>Dear $u[Name],</p>
			<p>As part of our security upgrade and to ensure protection of your data, we have taken the precaution of reseting user passwords on members.winesofontario.org.</p> 
			<p>Your password for members.winesofontario.org has been reset to: $u[Password]</p>
			<p>You can log in at http://members.winesofontario.org and if you wish to change your password, you may do so by clicking on `My Account` and then `Update Password`.</p>
			<p>Our apologies if this has caused any inconvenience.</p>
			</div>";
			$plaintext_mailbody = strip_tags($mailbody);
			$mime	= new Mail_mime($crlf);	
			$mime->setTXTBody($plaintext_mailbody);
			$mime->setHTMLBody($mailbody);
			$body	= $mime->get();
			$hdrs	= $mime->headers($hdrs);
			$mail 	=& Mail::factory('mail');
			$go = $mail->send($u['Email'], $hdrs, $body);
		}
		$message = 'Eat crow has been run.';
		break;

	case 'create_wine':
		connect2database();
		$grapes = $_POST['Grapes'];
       	$p = cleanForDB($_POST);
	    
	    //extract($_POST);
	    //require_once 'function.readChunks.php';
	    //$SEOName = convertFromTitleToPath($Name);
	    
	    $StyleExplosion = explode('-', $p['Style']);
	    
	    $Colour = $StyleExplosion[0];
	    $SpecialType = $StyleExplosion[1];
	    
	    if($p['Year'] == '') $p['Year'] = 0;
	    if($p['AlcoholByVolume'] == '') $p['AlcoholByVolume'] = 0;
	    
	    if(empty($p['IsActive'])) $p['IsActive'] = 'No';
	    if(empty($p['IsFeatured'])) $p['IsFeatured'] = 'No';
	    
	    if($p['IsFeatured'] == 'Yes')
	    	good_query("UPDATE Wines SET IsFeatured = 'No' WHERE WineryID = $p[WineryID]");	    
	    
	    $i = "INSERT INTO Wines (WineryID, Brand, Name, Year, Colour, Description, IsFeatured, IsActive, SpecialType) VALUES ($p[WineryID], '$p[Brand]', '$p[Name]', $p[Year], '$Colour', '$p[Description]', '$p[IsFeatured]', '$p[IsActive]', '$SpecialType')";
	    $go = good_query($i);
	    
	    //Insert into WinesXGrapes as the same time.
	    foreach($grapes as $key=>$value)
	    	good_query("INSERT INTO WinesXGrapes (WineID, GrapeID) VALUES (LAST_INSERT_ID(), $value)");
	    	    
	    $message = 'The wine was added.';
//	    $view = 'wines';
		break;
		
	case 'update_wine':
		connect2database();
		
		//new dBug($_POST);
		
		$grapes = $_POST['Grapes'];
        $p = cleanForDB($_POST);
	    //extract($_POST);

	  	$StyleExplosion = explode('-', $p['Style']);
	    
	    $Colour = $StyleExplosion[0];
	    $SpecialType = $StyleExplosion[1];
	    
	    if($p['Year'] == '') $p['Year'] = 0;
	    if($p['AlcoholByVolume'] == '') $p['AlcoholByVolume'] = 0;
	    
	  	if(empty($p['IsActive'])) $p['IsActive'] = 'No';
	    if(empty($p['IsFeatured'])) $p['IsFeatured'] = 'No';
	    
	  	if($p['IsFeatured'] == 'Yes')
	    	good_query("UPDATE Wines SET IsFeatured = 'No' WHERE WineryID = $p[WineryID]");	 
	    
	    $u = "UPDATE Wines SET WineryID = $p[WineryID], Brand = '$p[Brand]', Name = '$p[Name]', Year = '$p[Year]', Colour = '$Colour', Description = '$p[Description]', IsFeatured = '$p[IsFeatured]', IsActive = '$p[IsActive]', SpecialType = '$SpecialType' WHERE WineID = $p[WineID]";

	    $r = good_query($u);
	    
	    if ($r)	$message = 'The wine was updated';
	    else {
			$there_was_an_error = true;
			$message = 'There was an error in module ' . $action;    
	    }

	    //Update WinesXGrapes
	    good_query("DELETE FROM WinesXGrapes WHERE WineID = $p[WineID]");
	    	    
	    foreach($grapes as $key=>$value)
	    	good_query("INSERT INTO WinesXGrapes (WineID, GrapeID) VALUES ($p[WineID], $value)");
	    
	    break;
	    	
	case 'delete_wine':
		connect2database();
		
		$g = cleanForDB($_GET);
		
	    $d = "DELETE FROM Wines WHERE WineID = $g[WineID]";
	    $go = good_query($d);

	    $d = "DELETE FROM Bottles WHERE WineID = $g[WineID]";
	    $go = good_query($d);	    
	    
	    $message = 'The wine was deleted.';
//	    $view = 'wines';
	    break;
}


?>