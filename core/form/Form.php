<?php

namespace App\core\form;

use App\core\Model;

class Form
{
    public static function begin($action, $method = 'post', $otherFormAttributes = [])
    {
        $formAttributes = self::buildFormAttributes($otherFormAttributes);

        echo "<form action=\"$action\" method=\"$method\" $formAttributes>";
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    private static function buildFormAttributes($attributes)
    {
        $attributeString = '';

        foreach ($attributes as $key => $value) {
            $attributeString .= " $key=\"$value\"";
        }

        return $attributeString;
    }

    public static function field(Model $model, $type, $attribute)
    {
        echo new Field($model, $type, $attribute);
    }
    
    public static function submit($text, $class = 'btn btn-outline btn-block my-3') {
        echo sprintf('<button class="%s" type="submit">%s</button>', $class, $text);
    }
}
