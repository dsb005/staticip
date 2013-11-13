<div id="menu">
<?php if(!isset($_SESSION['USER'])){ ?>
<a href="index.php?do=register" class="mitem">REGISTER</a> | <a href="index.php?do=login" class="mitem">LOGIN</a>
<?php }else{ ?>
<a href="index.php?do=logout" class="mitem">LOGOUT</a> | <a href="index.php?do=view" class="mitem">DASHBORD</a> | <a href="index.php?do=sendip" class="mitem">SENDIP</a>
<?php } ?>
</div>