<div id="menu">
<?php if(isset($_SESSION['USER'])){ ?>
<ul class="nav nav-tabs">
  <li id="m_home" class="nav-item">
    <a class="nav-link" href="index.php?page=home">Home</a>
  </li>
  <li id="m_account" class="nav-item">
    <a class="nav-link" href="index.php?page=account">Account</a>
  </li>
  <li id="m_device" class="nav-item">
    <a class="nav-link" href="index.php?page=device">Devices</a>
  </li>
  <li id="m_logout" class="nav-item">
    <a class="nav-link" href="index.php?page=logout">Logout</a>
  </li>
</ul>
<script type="text/javascript">
<?php
if(isset($_GET['page'])) $do = $_GET['page']; else $do="home";
	echo 'var page = "'.$_GET["page"].'";';
?>
	var menuitem_id = 'm_'+page;
	console.log(menuitem_id);
	document.getElementById(menuitem_id).className += 'active bg-primary';
	document.getElementById(menuitem_id).getElementsByClassName('nav-link')[0].className += ' text-white'
</script>
<?php } ?>
</div>