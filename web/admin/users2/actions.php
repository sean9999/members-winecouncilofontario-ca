<?php

ob_start();

connect2database();

switch ($action) {

	case 'create_user_xx':
	$P = cleanForDB($_POST);
	//$pwd = md5(trim($P['Password']));

	$emailUser = good_query_assoc("SELECT UserID FROM Users WHERE Email = '" . $P['Email'] . "'");

	if(isset($emailUser['UserID']) && $emailUser['UserID'] != $P['UserID'])
	{
		$message = 'Account creation failed: email address in use by another user.';
	}
	else
	{
		if(isset($P['Approved']))
			$approved = "True";
		else
			$approved = "False";
		
		$ins = good_query("INSERT INTO Users (Name,Title,WineryID,UserLevel,Email,Password,Notes,Approved,ztamp) VALUES ('$P[Name]','$P[Title]','$P[WineryID]','$P[UserLevel]','$P[Email]', '$P[Password]','$P[Notes]','$approved',NOW())");
		if ($ins) {
			$message = 'The user was created.';
		} else {
			$message = 'There was an error creating the user';
		}
	}
	break;
	
	case 'create_user':
	$P = cleanForDB($_POST);

		if(isset($P['Approved']))
			$approved = "True";
		else
			$approved = "False";
		
		$ins = good_query("INSERT INTO Users (Name,Title,WineryID,UserLevel,Email,Password,Notes,Approved,ztamp) VALUES ('$P[Name]','$P[Title]','$P[WineryID]','$P[UserLevel]','$P[Email]', '$P[Password]','$P[Notes]','$approved',NOW())");
		if ($ins) {
			$message = 'The user was created.';
		} else {
			$message = 'There was an error creating the user';
		}

	break;
	
	
	case 'update_user':
	$P = cleanForDB($_POST);
	
	$emailUser = good_query_assoc("SELECT UserID FROM Users WHERE Email = '" . $P['Email'] . "'");
	
	if(isset($emailUser['UserID']) && $emailUser['UserID'] != $P['UserID'])
	{
		$message = 'Account update failed: email address in use by another user.';
	}
	else
	{
		if(isset($P['Approved']))
			$approved = "True";
		else
			$approved = "False";	
			
		$approvalResults = good_query_assoc("SELECT Approved FROM Users WHERE UserID = " . $P[UserID]);
		
		if(isset($approvalResults['Approved']))
			$wasApproved = $approvalResults['Approved'];
		else 
			$wasApproved = '';
			
		$update = good_query("UPDATE Users SET Name = '" . $P[Name] . "', Title = '" . $P[Title] . "', WineryID = '" . $P[WineryID] . "', UserLevel = '" . $P[UserLevel] . "', Email = '" . $P[Email] . "', Notes = '" . $P['Notes'] . "', Approved = '" . $approved . "', ztamp = NOW() WHERE UserID = " . $P[UserID]);
		
		if ($update) {
			$message = 'The user was updated.';
			
			if ($wasApproved == 'False' && $approved == 'True') 
			{	
				//	email that goes to the user
				ob_start();
				$sujet	= 'Your account at members.winesofontario.org has been activated';
				echo '<p>Hi There! Your account on  members.winesofontario.org has been activated! <br /><br />The next time you\'re at  members.winesofontario.org, please log-in with your new account details. </p>';
/*
				echo '<p><strong>NOTE:</strong> Due to a security upgrade, you\'ve been assigned a temporary password of <strong>wines43592UTF8</strong>. Once you\'ve logged-in with this password, you can change your password at any time by clicking on the \'My Account\' link at the top-right of the website. You can, of course, change your password back to your originally-requested password.</p>';
*/
				echo '<p>Thank you and welcome to members.winesofontario.org!</p><p>&nbsp;</p>';
				echo '<table border="1">';
				foreach ($P as $pfield => $pval) {
				
					switch ($pfield) {
					
						case 'change':
						case 'UserID';
						case 'Name':
						case 'Title':
						case 'WineryID':
						case 'Notes':
						case 'ztamp':
						case 'UserLevel':
						case 'Password':
						//	do not display these fields
						break;
					
						default:
						echo '<tr>';
						echo '	<td>' . $pfield . '</td>';
						echo '	<td>' . $pval . '</td>';
						echo '</tr>';	
						break;
					}
				}
				echo '</table>';
				$mailbody			= ob_get_clean();
				$plaintext_mailbody	= strip_tags($mailbody);
			
				//	Send mail
				include('Mail.php');
				include('Mail/mime.php');
				require_once 'function.characterConversions.php';
				$crlf	= "\n";
				$hdrs	= array('From' => EMAIL_SENDER,'Subject' 	=> $sujet);
				$mime = new Mail_mime($crlf);
				$mime->setTXTBody($plaintext_mailbody);
				$mime->setHTMLBody($mailbody);
				$body	= $mime->get();
				$hdrs	= $mime->headers($hdrs);
				$mail 	=& Mail::factory('mail');
				$mail->send($P[Email], $hdrs, $body);
			
				$message = $message . ' An email was sent to the user.';
			}
		} else {
			$message = 'There was an error updating the user';
		}
	}
	break;

	case 'delete_user':
	$G = cleanForDB($_GET);
	$kill = good_query("DELETE FROM Users WHERE UserID = " . $G['UserID']);
	$message = 'The user was deleted.';
	break;

	default:
	$message = 'There was no routine written for action <em>' . $action . '</em>';
	//new dBug($_REQUEST);
	new dBug($_POST);
	new dBug($_GET);
	//new dBug($_ENV);
	break;

}

$debug_stuff = ob_get_contents();
ob_end_clean();

?>