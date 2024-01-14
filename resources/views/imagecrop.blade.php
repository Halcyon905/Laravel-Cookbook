<html>
    <body>
    <h1>Image Cropping with Laravel</h1>
    <br>
    <?php $messages = $errors->all('<p style="color:red">:message</p>') ?>
    <?php
        foreach ($messages as $msg) {
            echo $msg;
        }
    ?>
    <br>
    @if( $message = Session::get('image'))
        <img src='{{ asset($message) }}' title='job image'>
    @endif
    <br>
    <?= Form::open() ?>
        <?= Form::hidden('image', $message) ?>

        <?= Form::label('lc', 'Left corner') ?>
        <?= Form::number('x', '100', array('id' => 'x')) ?>
        <?= Form::number('y', '100', array('id' => 'y')) ?><br>

        <?= Form::label('width', 'width') ?>
        <?= Form::number('w', '100', array('id' => 'w')) ?><br>
        <?= Form::label('height', 'height') ?>
        <?= Form::number('h', '100', array('id' => 'h')) ?><br>
        <?= Form::submit('Crop it!') ?>

    <?= Form::close() ?>
    </body>
</html>