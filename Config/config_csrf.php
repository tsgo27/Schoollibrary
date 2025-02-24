<?php
/*
* Validation Token
*
*/

function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && is_string($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}

?>
