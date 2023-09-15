<?php
function isAlphanumeric($input) {
    return ctype_alnum($input);
}

function isEmail($input) {
    return filter_var($input, FILTER_VALIDATE_EMAIL);
}

function isNumeric($input) {
    return is_numeric($input);
}

function isPositiveInteger($input) {
    return ctype_digit($input) && intval($input) > 0;
}

function isNonNegativeInteger($input) {
    return ctype_digit($input) && intval($input) >= 0;
}

function isValidUsername($input) {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $input);
}

function isValidPassword($input) {
    return strlen($input) >= 8 && preg_match('/[A-Z]/', $input) && preg_match('/[a-z]/', $input) && preg_match('/[0-9]/', $input);
}

function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
