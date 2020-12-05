<div id="body">
<table width="828" align="center" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td align="center" class="ncontent" colspan="3" height="150" style="background-color:#e7e8e9">
			<?php if($_SESSION['DEVICES']) { ?>
			<table class="dtable2" align="center" border="0" cellpadding="2" cellspacing="2">
				<tr>
					<td width="100" class="l_title">Device</td>
					<td class="l_url"><?php echo $_SESSION['DEVICES'][0]['dName']; ?></td>
				</tr>
				<tr>
					<td class="l_title">URL</td>
					<td class="l_url"><?php echo $this->URL; ?>?do=sendip&did=<?php echo $_SESSION['DEVICES'][0]['dID']; ?>&port=80</td>
				</tr>
			</table>
			<?php } ?>
			<h5 align="center">Your Ready to Track this Device IP, Just Copy this URL Above, and Use Any Tool to Schedule a Request to update your device ip with your account, below are some recomended tools and guides that we selected for you... Enjoy (:</h5>
			<table class="dtable" align="center" border="0" cellpadding="2" cellspacing="2">
				<tr>
					<td><a href="https://chrome.google.com/webstore/detail/crontabs/abhmbcedbojnghofcfmnageegmkmpkac" target="_blank"><img src="img/icons/chrome.png"></a></td>
					<td><a href="https://addons.mozilla.org/en-US/firefox/addon/cronzilla/?src=search" target="_blank"><img src="img/icons/firefox.png"></a></td>
					<td><a href="http://superuser.com/questions/321215/how-can-i-open-a-url-on-a-schedule-in-the-default-browser" target="_blank"><img src="img/icons/windows8.png"></a></td>
					<td><a href="http://apple.stackexchange.com/questions/9373/how-do-i-run-a-cron-job-on-a-mac" target="_blank"><img src="img/icons/apple.png"></a></td>
					<td><a href="http://stackoverflow.com/questions/11375260/cron-command-to-run-url-address-every-5-minutes" target="_blank"><img src="img/icons/linux.png"></a></td>
					<td><a href="https://itunes.apple.com/sc/app/cron/id717204330?mt=8" target="_blank"><img src="img/icons/apple-ios.png"></a></td>
					<td><a href="https://play.google.com/store/apps/details?id=de.namit.urlcron" target="_blank"><img src="img/icons/android.png"></a></td>
					<td><a href="http://appworld.blackberry.com/webstore/content/32163887/" target="_blank"><img src="img/icons/blackberry.png"></a></td>
					<td><a href="#" target="_blank"><img src="img/icons/windowsphone.png"></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="img/v_bleft.png"></td>
		<td height="12" style="background-color:#e7e8e9; font-size:1px;"><img class="vspacer" src="img/spacer.gif"></td>
		<td class="vcorner" width="12" height="12" style="font-size:1px;"><img src="img/v_bright.png"></td>
	</tr>
</table>
</div>