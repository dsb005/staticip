<div id="body">
<table width="828" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" class="ncontent" colspan="3" height="150" style="background-color:#e7e8e9">
			<?php if($_SESSION['DEVICES']) { ?>
			<table class="dtable" align="center" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="4" class="title">DEVICES</td>
				</tr>
				<tr>
					<td width="100" class="subtitle">IP</td>
					<td width="100" class="subtitle">Type</td>
					<td colspan="2" class="subtitle">Name</td>
				</tr>
				<?php foreach($_SESSION['DEVICES'] as $device) { ?>
				<tr>
					<td class="txtbox"><?php echo $device['iIp']; ?></td>
					<td class="txtbox"><?php echo $device['dType']; ?></td>
					<td class="txtbox2"><?php echo $device['dName']; ?></td>
					<td align="center" width="130" rowspan="2" style="vertical-align: top;">
					<input class="li_btn" type="button" value="edit" onClick="javascript:document.location='index.php?page=device&action=update&did=<?php echo $device['dID']; ?>'">
					<input class="li_btn" type="button" value="delete" onClick="javascript:document.location='index.php?page=device&action=delete&did=<?php echo $device['dID']; ?>'">
					</td>
				</tr>
				<tr>
					<td class="subtitle">URL</td>
					<td colspan="3">
					<a href="<?php echo $this->URL; ?>?page=track&did=<?php echo $device['dID'] ?>" target="_blank"><img src="img/location.png"></a>
					</td>
				</tr>
				<tr>
					<td class="subtitle" colspan="4"></td>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>
		<div style="text-align:center; padding-top:5px;">
			<input class="btn btn-primary" type="button" name="add" value="ADD NEW DEVICE" onClick="javascript:document.location='index.php?page=device'">
		</div>
		</td>
	</tr>
	<tr>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="img/v_bleft.png"></td>
		<td height="12" style="background-color:#e7e8e9; font-size:1px;"><img class="vspacer" src="img/spacer.gif"></td>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="img/v_bright.png"></td>
	</tr>
</table>
</div>