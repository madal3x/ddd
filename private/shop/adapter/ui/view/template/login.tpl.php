<?php /** @var $request \common\adapter\http\HttpRequest */ ?>
<?php if ($msg = $request->get('msg')): ?>
    <span><b><?= $msg ?></b></span>
<?php endif; ?>

<form method="POST">
    <input type="text" name="username"/>
    <input type="password" name="password"/>
    <input type="submit" value="Submit"/>
</form>