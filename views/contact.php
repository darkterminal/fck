<?php

use Fckin\core\form\Form;
use Fckin\core\db\Model;
use Fckin\core\View;

/** @var View $this */
/** @var Model $model */

$this->title = 'Contact | fck.';
?>

<h1 class="text-2xl my-3 text-center">Contact</h1>

<?php
Form::begin('', 'post', ['class' => 'w-1/2 mx-auto', 'autocomplete' => 'off']);

Form::input($model, 'text', 'subject');
Form::input($model, 'email', 'email');

Form::textarea($model, 'message');

Form::checkbox($model,'sendMeMessage', 'Send a message');
Form::checkbox($model, 'agreeTermsAndCondition', 'Agree TOC');

Form::radio($model, 'agreement', 'Agree');
Form::radio($model, 'agreement', 'Disagree');

Form::fileinput($model, 'Upload File');

Form::range($model, 'rateRange', 0, 100);

Form::rating($model, 'review', 5, 'heart', 'bg-red-500');

Form::submit('Send Message', 'btn btn-outline btn-primary btn-block my-3');

Form::end();
?>