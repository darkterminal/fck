<?php

use Fckin\core\form\Form;
?>

<h1 class="text-2xl my-3 text-center">Register</h1>

<?php
echo toast('error');

Form::begin('/register', 'post', ['class' => 'w-1/3 mx-auto', 'autocomplete' => 'off']);
Form::field($model, 'text', 'firstName');
Form::field($model, 'text', 'lastName');
Form::field($model, 'email', 'email');
Form::field($model, 'password', 'password');
Form::field($model, 'password', 'repeatPassword');
Form::submit('Register', 'btn btn-outline btn-primary btn-block my-3');
Form::end();
?>