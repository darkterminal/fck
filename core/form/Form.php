<?php

namespace Fckin\core\form;

use Fckin\core\Model;

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
    
    /**
     * Create Input Field
     *
     * @param  Model $model the fck core model that load the value of the input
     * @param  string $type set the input field type
     * @param  string $attribute set the input field name and attribute
     * @param  string $classes add extra Tailwind CSS classes
     * @return string HTML Input Field
     */
    public static function field(Model $model, string $type, string $attribute, string $classes = '')
    {
        echo new Field($model, $type, $attribute, $classes);
    }
        
    /**
     * Create Submit Button
     *
     * @param  string $text display text button 
     * @param  string $class string classes using Tailwind CSS
     * @return string HTML Submit Button
     */
    public static function submit(string $text, string $class = 'btn btn-outline btn-block my-3') {
        echo sprintf('<button class="%s" type="submit">%s</button>', $class, $text);
    }
}
