<h2>Регистрация</h2>
<div>
<form method="post" action="/user/signup">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" placeholder="login" value="<?=
        isset($_SESSION['form_data']['login']) ? checkData($_SESSION['form_data']['login']) : ''?>">

    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="password">
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?=
        isset($_SESSION['form_data']['name']) ? checkData($_SESSION['form_data']['name']) : '' ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?=
        isset($_SESSION['form_data']['email']) ? checkData($_SESSION['form_data']['email']) : ''?>">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
</form>
    <?php if(isset($_SESSION['form_data']))  unset($_SESSION['form_data']) ;?>
</div>