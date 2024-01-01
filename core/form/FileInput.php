<?php

namespace Fckin\core\form;

use Fckin\core\db\Model;

class FileInput
{
    public Model $model;
    public string $name;
    public string $classes;

    public function __construct(Model $model, string $name, string $classes = '')
    {
        $this->model = $model;
        $this->name = $name;
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
                <input type="file" name="%s" value="%s" class="file-input file-input-bordered w-full %s %s" />
                <div class="label">
                    <span class="label-text-alt">%s</span>
                </div>
            </label>
        ',
            text_alt_formatter($this->name),
            $this->name,
            $this->model->{$this->name},
            $this->classes,
            $this->model->hasError($this->name) ? 'checkbox-error' : '',
            $this->model->getFirstError($this->name)
        );
    }
}
