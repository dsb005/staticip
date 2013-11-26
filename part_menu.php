<div id="menu">
<?php if(isset($_SESSION['USER'])){ ?>
<!-- <a href="index.php?do=account" class="mitem">ACCOUNT</a> | <a href="index.php?do=view" class="mitem">DASHBORD</a> | <a href="index.php?do=logout" class="mitem">LOGOUT</a> -->
<table align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<?php if($_GET['do'] == 'home') {?>
		<td width="204" height="41"><a class="s_mitem" href="index.php?do=home"><div class="mtext">Home</div></a></td>
		<?php }else{ ?>
		<td width="204" height="41"><a class="mitem" href="index.php?do=home"><div class="mtext">Home</div></a></td>
		<?php } ?>
		<td width="4"><img width="4" class="vspacer" src="/img/spacer.gif"></td>
		<?php if($_GET['do'] == 'account') {?>
		<td width="204" height="41"><a class="s_mitem" href="index.php?do=account"><div class="mtext">Account</div></a></td>
		<?php }else{ ?>
		<td width="204" height="41"><a class="mitem" href="index.php?do=account"><div class="mtext">Account</div></a></td>
		<?php } ?>
		<td width="4"><img width="4" class="vspacer" src="/img/spacer.gif"></td>
		<?php if($_GET['do'] == 'view' || $_GET['do'] == 'device' || $_GET['do'] == 'help') {?>
		<td width="204" height="41"><a class="s_mitem" href="index.php?do=view"><div class="mtext">Devices</div></a></td>
		<?php }else{ ?>
		<td width="204" height="41"><a class="mitem" href="index.php?do=view"><div class="mtext">Devices</div></a></td>
		<?php } ?>
		<td width="4"><img width="4" class="vspacer" src="/img/spacer.gif"></td>
		<?php if($_GET['do'] == 'logout') {?>
		<td width="204" height="41"><a class="s_mitem" href="index.php?do=logout"><div class="mtext">Logout</div></a></td>
		<?php }else{ ?>
		<td width="204" height="41"><a class="mitem" href="index.php?do=logout"><div class="mtext">Logout</div></a></td>
		<?php } ?>
	</tr>
	<tr>
		<td colspan="7" style="background-color:#fcaf17; font-size:8px;"><img height="5" class="vspacer" src="/img/spacer.gif"></td>
	</tr>
	<tr>
		<td colspan="7" height="1" style="font-size:1px;"><img height="1" class="vspacer" src="/img/spacer.gif"></td>
	</tr>
</table>
<?php } ?>
</div>