<h1>User Info</h1>
<?php $messages = $errors->all('<p style="color:red">:message</p>') ?>
<?php
    foreach ($messages as $msg) {
        echo $msg;
    }
?>

<?= Form::open() ?>
    <?= Form::hidden('honeypot', '') ?>

    <?= Form::label('email', 'Email') ?>
    <?= Form::text('email', old('email')) ?>
    <br>

    <?= Form::label('username', 'Username') ?>
    <?= Form::text('username', old('username')) ?>
    <br>

    <?= Form::label('password', 'Password') ?>
    <?= Form::password('password') ?>
    <br>

    <?= Form::label('password_confirm', 'Password confirm') ?>
    <?= Form::password('password_confirm') ?>
    <br>

    <?= Form::label('color', 'Favorite Color') ?>
    <?= Form::select('color', array('red' => 'red', 'green' => 'green', 'blue' => 'blue')) ?>
    <br>

    <span>{!! captcha_img() !!}</span><br>
    <?= Form::text('captcha') ?>
    <br>

<?= Form::submit('Send it!') ?>
<?= Form::close() ?>