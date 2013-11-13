<div id="error"><?php echo $_SESSION['ERRORMSG']; ?></div>
<form action="" method="post">
<table>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="email" id="itext"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" id="itext"></td>
	</tr>
	<tr>
		<td colspan="2"><input name="do" type="submit" value="<?php echo $_GET['do']; ?>" style="text-transform: uppercase;" id="sbtn"></td>
	</tr>
</table>
</form>