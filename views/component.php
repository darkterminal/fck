<?php
use Fckin\core\form\Form;
use Fckin\core\db\Model;
use Fckin\core\View;

/** @var Model $model */
/** @var View $this */
$this->title = "Components";
?>
<h1 class="text-2xl font-fold text-center my-3">What The fck. Built With?</h1>
<p>This fck. framework (bruh!) build with of course PHP "duh" with <a href="https://tailwindcss.com" target="_blank" class="font-bold">TaildwinCSS</a> and <a href="https://daisyui.com" target="_blank" class="font-bold">DaisyUI</a>. If you don't want to? Just get the fck. off or broke everything.</p>
<h1 class="text-2xl font-fold text-center my-3">The fck. Form Components</h1>
<p>Forms are quite tedious and time consuming to use; therefore, I made the situation worse by making it more complicated, constantly dealing with PHP code!</p>
<div class="mockup-code">
<pre><code class="language-php">
use Fckin\core\form\Form;
use Fckin\core\db\Model;

/** @var Model $model */

Form::begin('/', 'post', ['class' => 'w-1/3 mx-auto', 'autocomplete' => 'off']);
Form::input(model: $model, type: 'text', name: 'subject', label: 'Subject', placeholder: 'Write your subject here');
Form::textarea(model: $model, name: 'message', label: 'Message Body', placeholder: 'Write your message here');
Form::checkbox(model: $model, name: 'job', value: 'newslatter', checked: false, label: 'Newslatter');
Form::checkbox(model: $model, name: 'job', value: 'marketing', checked: true, label: 'Marketing Email');
Form::radio(model: $model, name: 'job', checked: false, label: 'Urgent');
Form::radio(model: $model, name: 'job', checked: false, label: 'Not Urgent');
Form::fileinput(model: $model, name: 'job');
Form::select(model: $model, name: 'job', options: ['Dancer', 'Storyteller', 'Freestyler'], label: 'Job Preference');
Form::submit('Register', 'btn btn-outline btn-primary btn-block my-3');
Form::end();
</code></pre>
</div>
<div class="divider"></div>
<?php
Form::input(model: $model, type: 'text', name: 'subject', label: 'Subject', placeholder: 'Write your subject here');
Form::textarea(model: $model, name: 'message', label: 'Message Body', placeholder: 'Write your message here');
Form::checkbox(model: $model, name: 'job', value: 'newslatter', checked: false, label: 'Newslatter');
Form::checkbox(model: $model, name: 'job', value: 'marketing', checked: true, label: 'Marketing Email');
Form::radio(model: $model, name: 'job', checked: false, label: 'Urgent');
Form::radio(model: $model, name: 'job', checked: false, label: 'Not Urgent');
Form::fileinput(model: $model, name: 'job');
Form::select(model: $model, name: 'job', options: ['Dancer', 'Storyteller', 'Freestyler'], label: 'Job Preference');
?>
