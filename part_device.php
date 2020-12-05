<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<form action="" method="post">
<input type="hidden" name="action" value="<?php echo $_SESSION['action']; ?>">
<?php if(isset($_GET['did']) && !isset($_POST['dtype'])) { ?>
<input type="hidden" name="did" value="<?php echo $_SESSION['DEVICES'][0]['dID']; ?>">
<?php } ?>
<br>
<table align="center" width="420" cellpadding="0" cellspacing="0" border="0" id="login">
	<tr>
		<td class="corner" width="11" height="11" align="center" valign="top"><img src="img/l_ctleft.png"></td>
		<td height="11"><img class="spacer" src="img/spacer.gif"></td>
		<td class="corner" width="11" height="11" align="right" valign="top"><img src="img/l_ctright.png"></td>	
	</tr>
	<tr>
		<td></td>
		<td>
			<table class="dtable" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" class="li_title">Device Type</td>
				</tr>
				<tr>
					<td>
						<select name="dtype" class="li_tinput">
							<?php foreach($_SESSION['DTYPES'] as $key=>$dtype) { ?>
							<option value="<?php echo $key; ?>" <?php if($_SESSION['DEVICES'][0]['dTypeID'] == $key) echo 'selected="selected"'; ?>><?php echo $dtype; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="left" class="li_title">Device Name</td>
				</tr>
				<tr>
					<td><input type="text" name="dname" class="li_tinput" value="<?php echo $_SESSION['DEVICES'][0]['dName']; ?>"></td>
				</tr>
				<tr>
					<td align="right"><input name="submit" type="submit" value="<?php echo $_SESSION['action']; ?>" style="text-transform: uppercase;" class="li_btn"></td>
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