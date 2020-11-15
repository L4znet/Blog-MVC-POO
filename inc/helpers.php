<?php


function flash($key, $value)
{
    if (!is_array($_SESSION['___FLASH___'])) {
        $_SESSION['___FLASH___'] = [];
    } else {
        $_SESSION['___FLASH___'][$key] = $value;
    }
}

function unflash($key, $default = null)
{
    $value = $_SESSION['___FLASH___'][$key] ?? $default;
    unset($_SESSION['___FLASH___'][$key]);
    return $value;
}
