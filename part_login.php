<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<div class="txt">
<h3 class="slogon">Your Devices, Your Cloud, Your World</h3>
</div>
<form action="" method="post">
<table align="center" width="420" cellpadding="0" cellspacing="0" border="0" id="login">
	<tr>
		<td class="corner" width="11" height="11" align="center" valign="top"><img src="img/l_ctleft.png"></td>
		<td height="11"><img class="spacer" src="img/spacer.gif"></td>
		<td class="corner" width="11" height="11" align="right" valign="top"><img src="img/l_ctright.png"></td>
		
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="250" align="center" class="dtable" align="center" border="0" cellpadding="2" cellspacing="0">
				<?php if($_GET['page'] == 'login'){ ?>
				<tr>
					<td align="left" class="li_title">LOGIN</td>
					<td align="right" class="li_title"><a href="index.php?page=register" class="btn btn-danger font-weight-bold">NEW ACCOUNT</a></td>
				</tr>
				<?php } elseif($_GET['page'] == 'register'){ ?>
				<tr>
					<td align="left" class="li_title">New Account</td>
					<td align="right" class="li_title"><a href="index.php?page=login" class="btn btn-success font-weight-bold">LOGIN</a></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="2"><input type="email" name="email" placeholder="Email" class="form-control li_tinput" required="required"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="password" name="password" placeholder="Password" class="form-control li_tinput" required="required"></td>
				</tr>
				<tr>
					<td align="left" class="li_subtitle"><a href="#">Forgot your password</a></td>
					<td align="right"><input class="btn btn-light li_btn" name="do" type="submit" value="<?php echo $_GET['page']; ?>"></td>
				</tr>
			</table>
		</td>
		<td class="lbg"></td>
	</tr>
	<tr>
		<td class="cornerb" width="11" height="11" align="center" valign="bottom"><img class="b" src="img/l_cbleft.png"></td>
		<td><img class="spacer" src="img/spacer.gif"></td>
		<td class="cornerb" width="11" height="11" align="center" valign="bottom"><img class="b" src="img/l_cbright.png"></td>
	</tr>
</table>
</form>