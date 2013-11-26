<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<form action="" method="post">
<input type="hidden" name="uid" value="<?php echo $_SESSION['USER']['ID'] ?>">
<input type="hidden" name="do" value="account">
<br>
<table align="center" width="420" cellpadding="0" cellspacing="0" border="0" id="login">
	<tr>
		<td class="corner" width="11" height="11" align="center" valign="top"><img src="/img/l_ctleft.png"></td>
		<td height="11"><img class="spacer" src="/img/spacer.gif"></td>
		<td class="corner" width="11" height="11" align="right" valign="top"><img src="/img/l_ctright.png"></td>
		
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="250" align="center" class="dtable" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" class="li_title">Update Account Info</td>
				</tr>
				<tr>
					<td><input type="text" name="name" class="li_tinput" value="<?php echo $_SESSION['USER']['NAME']; ?>"></td>
				</tr>
				<tr>
					<td><input type="text" name="email" class="li_tinput" value="<?php echo $_SESSION['USER']['EMAIL']; ?>"></td>
				</tr>
				<tr>
					<td><input type="password" name="password" class="li_tinput"></td>
				</tr>
				<tr>
					<td align="right"><input class="li_btn" name="do" type="submit" value="UPDATE"></td>
				</tr>
			</table>
		</td>
		<td class="lbg"></td>
	</tr>
	<tr>
		<td class="cornerb" width="11" height="11" align="center" valign="bottom"><img class="b" src="/img/l_cbleft.png"></td>
		<td><img class="spacer" src="/img/spacer.gif"></td>
		<td class="cornerb" width="11" height="11" align="center" valign="bottom"><img class="b" src="/img/l_cbright.png"></td>
	</tr>
</table>
</form>