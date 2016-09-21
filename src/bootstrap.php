<?php
// Fix https:// detection.
if (isset($_SERVER['HTTP_X_HTTPS']) && $_SERVER['HTTP_X_HTTPS'] === 'true') {
    $_SERVER['HTTPS'] = 'on';
}