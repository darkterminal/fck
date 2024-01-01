<?php

namespace Fckin\core\form;

use Exception;
use Fckin\core\db\Model;

class Range
{
    public Model $model;
    public string $name;
    public int $min;
    public int $max;
    public int $step;
    public string $classes;

    public function __construct(Model $model, string $name, int $min = 0, int $max = 100, int $step = 0, string $classes = '')
    {
        $this->model = $model;
        $this->name = $name;
        $this->min = $min;
        $this->max = $max;
        $this->step = $step;
        $this->classes = $classes;
    }

    public function __toString()
    {
        return sprintf(
            '
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">%s</span>
                </div>
                <input type="range" name="%s" min="%s" max="%s" value="%s" class="range %s" %s />
                %s
            </label>
        ',
            text_alt_formatter($this->name),
            $this->name,
            $this->min,
            $this->max,
            $this->model->{$this->name},
            $this->classes,
            $this->step !== 0 ? 'step="' . $this->step . '"' : '',
            $this->rangeSteps()
        );
    }

    private function rangeSteps()
    {
        if ($this->step !== 0) {
            $steps = $this->max / $this->step;
            $string = '<div class="w-full flex justify-between text-xs px-2">';
            for ($i = 0; $i < $steps; $i++) {
                $string .= '<span>|</span>';
            }
            $string .= '</div>';
            return $string;
        } else {
            $string = '<div class="w-full flex justify-between text-xs px-2">';
            $string .= '<span>'.$this->min.'</span>';
            $string .= '<span>'.$this->max.'</span>';
            $string .= '</div>';
            return $string;
        }
    }
}
