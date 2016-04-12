<style>
	#mainNav .navDbug {
		padding: 10px;
		margin-top: 30px;
		border: 1px dotted silver;
		
	}	
	#mainNav .navDbug,
	#mainNav .navDbug li	 {
		font-family: monospace;
		font-size: 12px;
		color: #333;
	}


</style>


<div class="navDbug">

<?php
	echo '<ul>';
	echo '<li>UserLevel: ';
	echo $UserLevel;
	echo '</li>';
	echo '<li>WineryID: ';
	echo $userData['WineryID'];
	echo '</li>';
	echo '</ul>';



?>
</div>