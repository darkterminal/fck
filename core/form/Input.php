<?php

namespace Fckin\core\form;

use Exception;
use Fckin\core\db\Model;

class Input
{
    public Model $model;
    public string $type = 'text';
    public string $name;
    public string $classes;

    public array $types = ['text', 'password', 'email', 'date', 'time'];

    public function __construct(Model $model, string $type, string $name, string $classes)
    {
        if (in_array($type, $this->types)) {
            $this->model = $model;
            $this->type = $type;
            $this->name = $name;
            $this->classes = $classes;
        } else {
            throw new Exception("Error undefined the types of input. The allowed input is ". implode(', ', $this->types) ."", 1);
            
        }
    }

    public function __toString()
    {
        return sprintf(
            '
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">%s</span>
                </div>
                <input type="%s" name="%s" placeholder="Type %s here" value="%s" class="input input-bordered w-full %s %s" />
                <div className="label">
                    <span className="label-text-alt">%s</span>
                </div>
            </label>
        ',
            text_alt_formatter($this->name),
            $this->type,
            $this->name,
            text_alt_formatter($this->name),
            $this->model->{$this->name},
            $this->classes,
            $this->model->hasError($this->name) ? 'input-error' : '',
            $this->model->getFirstError($this->name)
        );
    }
}
