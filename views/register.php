<?php
use Fckin\core\form\Form;
use Fckin\core\db\Model;
use Fckin\core\View;

/** @var View $this */
/** @var Model $model */
$this->title = 'Register | fck.';
?>

<h1 class="text-2xl my-3 text-center">Register</h1>

<?php
echo toast('error');

Form::begin('/register', 'post', ['class' => 'w-1/3 mx-auto', 'autocomplete' => 'off']);
Form::input($model, 'text', 'firstName');
Form::input($model, 'text', 'lastName');
Form::input($model, 'email', 'email');
Form::input($model, 'password', 'password');
Form::input($model, 'password', 'repeatPassword');
Form::submit('Register', 'btn btn-outline btn-primary btn-block my-3');
Form::end();
?>