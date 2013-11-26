<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<form action="" method="post">
<input type="hidden" name="uid" value="<?php echo $_SESSION['USER']['ID'] ?>">
<input type="hidden" name="do" value="account">
<table width="828" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" class="ncontent" colspan="3" height="150" style="background-color:#e7e8e9">
			Welcome to Staticloud, your online tool to maintain up to date info about your devices IP Address. Now you can Track all your devices Dynamic IPs by Going through these easy steps:
			<ul>
				<li>Register</li>
				<li>Add Device\Devices</li>
				<li>Get Device URL</li>
				<li>Chose Update Methud to use URL</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="/img/v_bleft.png"></td>
		<td height="12" style="background-color:#e7e8e9; font-size:1px;"><img class="vspacer" src="/img/spacer.gif"></td>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="/img/v_bright.png"></td>
	</tr>
</table>
</form>