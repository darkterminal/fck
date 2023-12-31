<?php
use Fckin\core\form\Form;
?>

<h1 class="text-2xl my-3 text-center">Login</h1>

<?php
echo toast('error');

Form::begin('/login', 'post', ['class' => 'w-1/3 mx-auto', 'autocomplete' => 'off']);
Form::field($model, 'email', 'email');
Form::field($model, 'password', 'password');
Form::submit('Login', 'btn btn-outline btn-primary btn-block my-3');
Form::end();
?>