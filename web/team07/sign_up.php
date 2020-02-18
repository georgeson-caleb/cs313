<!DOCTYPE html>
<html>

<header> 
</header>

<body>
    <h1>Sign Up Here</h1>

    <a href="sign_in.php">Sign In</a>
    <br>
        <?php
            if(issset($warning)) {
                echo $warning;
            }
        ?>
    <form id="signUp" action=create_account.php method="POST">

        <input type="text" id="username" name="username">
        <label for="username">User ID</label>

        <br>

        <input type="password" id="password" name="password">
        <label for="password">Password         
            <?php
                if(issset($warning)) {
                    echo "<span style='color:red'>*</span>";
                }
            ?>
        </label>

        <input type="password" id="passwordVerify" name="passwordVerify">
        <label for="passwordVerify">Verify Password
            <?php
                    if(issset($warning)) {
                        echo "<span style='color:red'>*</span>";
                    }
            ?>
        </label>

        <input type="submit" value="Create Account" />
    </form>


</body>

</html>