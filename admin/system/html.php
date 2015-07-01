<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function html_form_element($value) {
    switch ($value['type']) {
        case 'text':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (strlen($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<input name=\"" . $value['id'] . "\" class=\"form-control\" value=\"" . $preload_value . "\" " . $lock . ">";
            break;

        case 'password':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (!empty($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<input name=\"" . $value['id'] . "\" type=\"password\" class=\"form-control\" value=\"" . $preload_value . "\" " . $lock . ">";
            break;

        case 'textarea':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (!empty($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<textarea class=\"ckeditor\" name=\"" . $value['id'] . "\" class=\"form-control\" " . $lock . ">" . $preload_value . "</textarea>";
            break;

        case 'editor':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (!empty($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<textarea rows=\"5\" name=\"" . $value['id'] . "\" class=\"form-control\" " . $lock . ">" . $preload_value . "</textarea>";
            break;

        case 'number':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (strlen($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<input name=\"" . $value['id'] . "\" type=\"number\" class=\"form-control\" value=\"" . $preload_value . "\"" . $lock . ">";
            break;

        case 'float':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (strlen($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<input name=\"" . $value['id'] . "\" type=\"number\" class=\"form-control\" step=\"0.01\" value=\"" . $preload_value . "\"" . $lock . ">";
            break;

        case 'date':
            $lock = "";
            if ($value['lock']) {
                $lock = "readonly";
            }
            if (!empty($value['value'])) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }
            $ret = "<input name=\"" . $value['id'] . "\" type=\"date\" class=\"form-control\" value=\"" . $preload_value . "\"" . $lock . ">";
            break;

        case 'boolean':
            $check = false;
            $lock = "";
            $ret = "";
            $preload_value = "";

            if (strlen($value['value']) > 0) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }

            if ($preload_value == "1") {
                $check = true;
            } else {
                $check = false;
            }

            $ret .= "<select class=\"form-control\" name=\"" . $value['id'] . "\">";
            if ($check == true) {
                $ret .= "<option value=\"0\">False</option>";
                $ret .= "<option value=\"1\" selected>True</option>";
            } else {
                $ret .= "<option value=\"0\" selected>False</option>";
                $ret .= "<option value=\"1\">True</option>";
            }
            $ret .= "</select>";
            break;

        case 'dropdown':
            $ret = "";
            $preload_value = "";

            if (strlen($value['value']) > 0) {
                $preload_value = $value['value'];
            } else {
                $preload_value = $value['default'];
            }

            $ret .= "<select class=\"form-control\" name=\"" . $value['id'] . "\">";
            if ($preload_value == "0") {
                $ret .= "<option value=\"0\" selected></option>";
            } else {
                $ret .= "<option value=\"0\"></option>";
            }
            $ret .= html_dropdown_option($value['data'], $preload_value);
            $ret .= "</select>";
            break;

        case 'file':
            $ret = "<input type=\"file\" class=\"form-control\" name=\"" . $value['id'] . "\">";
            break;
    }

    return $ret;
}

function html_category_option($data, $select, $level) {
    $ret = "";
    $tab = "";
    for ($i = 0; $i < $level; $i++) {
        $tab .= "--";
    }

    foreach ($data as $single) {
        if ($select == $single['id']) {
            $ret .= "<option value=\"" . $single['id'] . "\" selected>" . $tab . $single['name'] . "</option>";
        } else {
            $ret .= "<option value=\"" . $single['id'] . "\">" . $tab . $single['name'] . "</option>";
        }
        $ret .= html_category_option($single['child'], $select, $level + 1);
    }

    return $ret;
}

function html_category_list($data, $level) {
    $ret = "";

    foreach ($data as $single) {
        if($level == 0) {
            $ret .= "<li class=\"subMenu\"><a href=\"index.php?model=category&category_id=" . $single['category_id'] . "\">" . $single['name'] . "</a>";
        } else {
            $ret .= "<li><a class=\"active\" href=\"index.php?model=category&category_id=" . $single['category_id'] . "\"><i class=\"fa fa-angle-double-right\"></i> " . $single['name'] . "</a>";
        }
        $sub = html_category_list($single['child'], $level + 1);
        if(strlen($sub) > 0) {
            $ret .= "<ul style=\"display:none\">" . $sub . "</a></ul>";
        }
        $ret .= "</li>";
    }

    return $ret;
}

function html_dropdown_option($data, $select) {
    $ret = "";

    foreach ($data as $single) {
        if ($select == $single['id']) {
            $ret .= "<option value=\"" . $single['id'] . "\" selected>" . $single['name'] . "</option>";
        } else {
            $ret .= "<option value=\"" . $single['id'] . "\">" . $single['name'] . "</option>";
        }
    }

    return $ret;
}

function html_confirm_delete() {
    return " onclick=\"return confirm('Are you confirmed to delete this item?')\"";
}

function html_page_nav($page) {
    $url = $page['url'] . "&page=";
    $first = $page['first'];
    $previous = $page['previous'];
    $next = $page['next'];
    $last = $page['last'];
    if ($page['current'] != 1) {
        echo "<a class=\"btn btn-default\" href=\"$url$first\">First</a>\n";
        echo "<a class=\"btn btn-default\" href=\"$url$previous\">Previous</a>\n";
    } else {
        echo "<a class=\"btn btn-default\" href=\"$url$first\" disabled>First</a>\n";
        echo "<a class=\"btn btn-default\" href=\"$url$previous\" disabled>Previous</a>\n";
    }
    for ($i = 1; $i < $page['total'] + 1; $i++) {
        if ($i != $page['current']) {
            echo "<a class=\"btn btn-default\" href=\"$url$i\">$i</a>\n";
        } else {
            echo "<a class=\"btn btn-primary\" href=\"$url$i\" disabled>$i</a>\n";
        }
    }
    if ($page['current'] != $page['total']) {
        echo "<a class=\"btn btn-default\" href=\"$url$next\">Next</a>\n";
        echo "<a class=\"btn btn-default\" href=\"$url$last\">Last</a>\n";
    } else {
        echo "<a class=\"btn btn-default\" href=\"$url$next\" disabled>Next</a>\n";
        echo "<a class=\"btn btn-default\" href=\"$url$last\" disabled>Last</a>\n";
    }
}

function sidebar() {
    require_once TEMPLATE_PATH . 'common/sidebar.php';
}

function html_echo_encode($content) {
    $content = str_replace("&lt;", "<", $content);
    $content = str_replace("&gt;", ">", $content);
    return $content;
}

function currency($amount) {
    return "$" . number_format($amount, 2);
}

?>