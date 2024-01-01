<?php

namespace Fckin\core\form;

use Fckin\core\db\Model;

class Checkbox
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
                <label class="cursor-pointer label">
                    <span class="label-text">%s</span>
                    <input type="checkbox" name="%s" value="%s" %s class="checkbox %s" />
                </label>
            </div>
        ',
            $this->label ?? text_alt_formatter($this->name),
            $this->name,
            $this->model->{$this->name},
            $this->checked ? 'checked' : '',
            $this->model->hasError($this->name) ? 'checkbox-error' : '',
        );
    }
}
