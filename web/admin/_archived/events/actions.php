<?php
switch ($action) {

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
	$E['is_priority']	= (int) isset($P['is_priority']);	
	$ins_SQL			= <<<BLOCK
	INSERT INTO Events (event_day,event_month,event_year,event_time,event_title,event_desc,event_banner,event_date,event_date_end,event_time_end,event_region_ids,event_attraction_tags,info_hours,info_location,info_phone,info_email,info_website,info_price,is_active,is_priority)
	VALUES ($E[event_day],$E[event_month],$E[event_year],'$P[event_time]','$P[event_title]','$P[event_desc]','$P[event_banner]','$P[event_date]','$P[event_date_end]','$P[event_time_end]','$E[eri]','$E[eat]','$P[info_hours]','$P[info_location]','$P[info_phone]','$P[info_email]','$E[web]','$P[info_price]',$E[is_active],$E[is_priority])
BLOCK;
	$ins		= good_query(trim($ins_SQL));
	$message	= 'The event <em>' . $E['event_title'] . '</em> has been created.';
	break;

	case 'delete_event':
	connect2database();
	$G		= cleanForDB($_GET);
	$del	= good_query("DELETE FROM Events WHERE event_id = $G[event_id]");
	if ($del) {
		$message = 'The event was deleted.';
	} else {
		$message = 'There was a problem deleting the event.';
	}
	break;

	case 'edit_event':
	require_once 'function.textConversions.php';
	connect2database();
	$P					= cleanForDB($_POST);
	$dateparts			= explode('-',$P['event_date']);
	$E					= array();
	$E['event_day']		= $dateparts[2];
	$E['event_month']	= $dateparts[1];
	$E['event_year']	= $dateparts[0];
	$E['eri']			= '';
	$E['eat']			= '';
	if (sizeof($_POST['event_region_ids'])) 		$E['eri'] = implode(',',$_POST['event_region_ids']);
	if (sizeof($_POST['event_attraction_tags'])) 	$E['eat'] = implode(',',$_POST['event_attraction_tags']);
	$E['web']			= niceURL($P['info_website']);
	$E['is_active']		= (int) isset($P['is_active']);
	$E['is_priority']	= (int) isset($P['is_priority']);	
	$update_SQL			= <<<BLOCK
	UPDATE Events SET
		event_day		= '$E[event_day]',
		event_month		= '$E[event_month]',
		event_year		= '$E[event_year]',
		event_date		= '$P[event_date]',
		event_date_end	= '$P[event_date_end]',
		event_time		= '$P[event_time]',
		event_time_end	= '$P[event_time_end]',
		event_title		= '$P[event_title]',
		event_desc		= '$P[event_desc]',
		event_banner	= '$P[event_banner]',
		info_hours		= '$P[info_hours]',
		info_location	= '$P[info_location]',
		info_phone		= '$P[info_phone]',
		info_email		= '$P[info_email]',
		info_website	= '$P[info_website]',
		info_price		= '$P[info_price]',
		is_active		= '$E[is_active]',
		is_priority		= '$E[is_priority]',		
		event_region_ids		= '$E[eri]',
		event_attraction_tags	= '$E[eat]'
	WHERE event_id = $P[event_id]
BLOCK;
	if (good_query(trim($update_SQL)))	$message = 'The event was updated.';
	else								$message = 'There was a problem updating the event.';
	break;

	case 'alter_table':
	connect2database();
	$altered = good_query("ALTER TABLE `Events` ADD  `is_priority` TINYINT NULL DEFAULT '0'");
	if ($altered)	$message = 'The events table was altered: It now has a field called <em>is_priority</em>. This will allow you to specify which events appear under the `upcoming events` extrander';
	else			$message = 'There was an error altering the events table in the database. Contact developer.';
	break;

	default:
	$message = 'There was an action for which no routine was written.';
	new dBug($_POST);
	new dBug($_GET);
	new dBug($_SESSION);
	new dBug($_COOKIE);
}
?>