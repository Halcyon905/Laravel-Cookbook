<!DOCTYPE html>
<html>
    <body>
    <h1>Laravel Upload and Crop</h1>
    <br>
    <?php $messages = $errors->all('<p style="color:red">:message</p>') ?>
    <?php
        foreach ($messages as $msg) {
            echo $msg;
        }
    ?>
    <br>
    @if( $message = Session::get('upload'))
        <img src='{{ asset($message) }}' title='job image'>
    @endif
    <br>
    <?= Form::open(array('files' => TRUE)) ?>
        <?= Form::file('myimage') ?>
        <br>

        <?= Form::label('action', 'action') ?>
        <?= Form::select('action', array('upload' => 'upload', 'crop' => 'crop')) ?>
        <br>

        <?= Form::submit('Send it!') ?>
    <?= Form::close() ?>
    </body>
</html>