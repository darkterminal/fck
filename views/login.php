<?php
use Fckin\core\form\Form;
use Fckin\core\db\Model;
use Fckin\core\View;

/** @var View $this */
/** @var Model $model */

$this->title = 'Login | fck.';
?>

<h1 class="text-2xl my-3 text-center">Login</h1>

<?php
echo toast('error');

Form::begin('/login', 'post', ['class' => 'w-1/3 mx-auto', 'autocomplete' => 'off']);
Form::input($model, 'email', 'email');
Form::input($model, 'password', 'password');
Form::submit('Login', 'btn btn-outline btn-primary btn-block my-3');
Form::end();
?>