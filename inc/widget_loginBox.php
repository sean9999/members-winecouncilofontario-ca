<?php 
if(isset($_SESSION['userID']))
{

?>

<p>Welcome back, <em><?php echo $userData['Name']?></em><br />
<a href="/account.php" title="Takes you to your account-details page">My Account</a><br />
<a href="login.php?logout=1" title="Logs you out of the Wines of Ontario Members-only Website">Logout</a></p>

<?php 
}
else 
{
?>

<p>You are not logged-in</p>
<p>Please <a href="/login.php">login</a></p>

<?php }?>