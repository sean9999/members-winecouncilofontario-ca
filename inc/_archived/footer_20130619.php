
		<div class="clearer"></div>
		<!-- Body Content end -->
		<div class="clearer"></div>
	</div>
	  
	<div id="botbar">
	<div class="clearer"></div>
		<div id="footer">
			<!-- Footer start -->
			<div id="footerBox">
			<ul>
			<?php
				$UserLevels = array('Owner','Employee');
				if (in_array($UserLevel, $UserLevels)) {	
					echo '<li><a href="/members.php">Members</a></li>';
				} ?>
				<li><a href="/Contact">Contact Us</a></li>
			</ul>
			<p>Copyright <?= date("Y"); ?> Wine Council Of Ontario. All Rights Reserved.</p>
			</div>
		<!-- Footer end -->
		</div>
	</div>
</div>

<?php include 'analytics.php'; ?>

</body>
</html>
