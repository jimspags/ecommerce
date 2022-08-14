<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="E-commerce Capstone Project">
        <meta name="author" content="Karen Marie E. Igcasan">
        <link rel="stylesheet" href="<?= base_url() ?>/assets/css/login-register-style.css"/>
    </head>
    <body>
        <div class="error">
            <?= $this->session->flashdata("errors") ?>
        </div>
        <form action="<?= base_url() ?>login/authenticate" method="POST">  
            <h1>Login</h1>
   
            <label for="email">Email address:</label>
            <input type="text" name="email" value="<?= isset($this->session->flashdata("input_fields")['email']) ? $this->session->flashdata("input_fields")['email'] : '' ?>">

            <label for="password">Password:</label>
            <input type="password" name="password">

            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
            <input type="submit" value="Signin">
            <a href="register">Don't have an account? Register</a>
        </form>
        
    </body>
</html>

