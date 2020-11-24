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


function redirect($url = "")
{
    if (empty($url)) {
        header('location:' . BASE_URL);
    } else {
        header('location:' . BASE_URL . $url);
    }
}

function switch_grade($grade)
{
    switch ($grade) {
        case 0:
            $grade = "Utilisateur";
        break;
        case 1:
            $grade = "Modérateur";
        break;
        case 2:
            $grade = "Administrateur";
        break;
    }
    return $grade;
}
