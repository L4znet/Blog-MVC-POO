<?php
class Controller
{
    protected function checkfield($data, $rules = [])
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            if ($rule == "required") {
                if (empty($data[$field])) {
                    $errors[$field] = "Ce champ est obligatoire";
                }
            }
        }

        if (!empty($errors)) {
            flash('data', $data);
            flash('errors', $errors);
            return false;
        } else {
            return true;
        }
    }
}
