<?php
namespace Fckin\core\form;

use Fckin\core\db\Model;

class Rating
{
    protected Model $model;
    protected string $name;
    protected string $classes;
    protected string $ratingType;
    protected int $stars;

    public function __construct(Model $model, string $name, int $stars, string $ratingType = 'star', string $classes = '')
    {
        $this->model = $model;
        $this->name = $name;
        $this->ratingType = $ratingType;
        $this->classes = $classes;
        $this->stars = $stars;
    }

    public function __toString()
    {
        $html = '<div class="rating">';
        for ($i = 0; $i < $this->stars; $i++) {
            $html .= sprintf('<input type="radio" name="%s" class="mask mask-%s %s" %s />',
                $this->name,
                $this->ratingType,
                $this->classes,
                ($i === 0) ? 'checked' : ''
            );
        }
        $html .= '</div>';

        return $html;
    }
}