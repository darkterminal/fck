<?php

namespace Fckin\core\form;

use Fckin\core\db\Model;

class Radio
{
    public Model $model;
    public string $name;
    public bool $checked;
    public string $label;

    public function __construct(Model $model, $label = null, string $name, bool $checked = false)
    {
        $this->model = $model;
        $this->name = $name;
        $this->checked = $checked;
        $this->label = $label;
    }

    public function __toString()
    {
        return sprintf(
            '
            <div class="form-control">
                <label class="label cursor-pointer">
                    <span class="label-text">%s</span> 
                    <input type="radio" name="%s" value="%s" class="radio %s" %s />
                </label>
            </div>
        ',
            $this->label ?? text_alt_formatter($this->name),
            $this->name,
            $this->model->{$this->name},
            $this->model->hasError($this->name) ? 'radio-error' : '',
            $this->checked ? 'checked' : '',
        );
    }
}
