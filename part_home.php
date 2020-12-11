<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<form action="" method="post">
<input type="hidden" name="uid" value="<?php echo $_SESSION['USER']['ID'] ?>">
<input type="hidden" name="do" value="account">
<table width="828" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" class="ncontent" colspan="3" height="150">
			Welcome to Staticip, your online tool to maintain up to date info about your devices IP Address. Now you can Track all your devices Dynamic IPs by Going through these easy steps:
			<ul>
				<li>Register</li>
				<li>Add Device\Devices</li>
				<li>Get Device URL</li>
				<li>Chose Update Methud to use URL</li>
			</ul>
		</td>
	</tr>
</table>
</form>