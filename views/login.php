<section id="content">
    <div id="login_card">
        <h3>Please Sign In</h3>
        <form action="/login" method="post">
            <div class="form-group">
                <label for="username">User name:</label>
                <input type="text" name="username" />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" />
            </div>
            <div class="form-group">
                <button type="submit">ENTER</button>
            </div>
        </form>
    </div>
    <div class="error-message">
        <?php
            $usernameErr = isset($_SESSION['response']['err_username']) ? $_SESSION['response']['err_username'] : '';
            $passwordErr = isset($_SESSION['response']['err_password']) ? $_SESSION['response']['err_password'] : '';

            unset($_SESSION['response']);

            echo '
                <p>' . $usernameErr . '</p>
                <p>' . $passwordErr . '</p>
            ';
        ?>
    </div>
</section>