<?php
use Youssef\ScandiwebTask\Classes\Session;
$session = new Session();
if ($session->get("success")) { ?>
<div class="alert alert-success"><?php echo $session->get("success") ?></div>
<?php }
$session->remove("success");