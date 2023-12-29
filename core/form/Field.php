<?php

namespace App\core\form;
use App\core\Model;

class Field
{
    public Model $model;
    public string $type = 'text';
    public string $attribute;

    public function __construct(Model $model, string $type, string $attribute)
    {
        $this->model = $model;
        $this->type = $type;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">%s</span>
                </div>
                <input type="%s" name="%s" placeholder="Type %s here" value="%s" class="input input-bordered w-full %s" />
                <div className="label">
                    <span className="label-text-alt">%s</span>
                </div>
            </label>
        ',
            text_alt_formatter($this->attribute),
            $this->type,
            $this->attribute,
            text_alt_formatter($this->attribute),
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'input-error' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
}