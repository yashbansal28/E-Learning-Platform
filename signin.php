<?php
session_start();
require "header.php";

// Check if the login form has been submitted
if (isset($_POST['login-submit'])) {
    // Retrieve user input
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    // Your login validation logic goes here...
    // For simplicity, let's assume the login is unsuccessful every time.
    // You should replace this with your actual login validation logic.
    $login_success = false;

    // Check if login is successful
    if ($login_success) {
        // Reset login attempts on successful login
        $_SESSION['login_attempts'] = 0;
        // Redirect user to success page
        header("Location: success.php");
        exit();
    } else {
        // Increment login attempts counter or set it to 1 if it doesn't exist
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;

        // Lock account if login attempts exceed 3
        if ($_SESSION['login_attempts'] >= 3) {
            echo '<div class="alert alert-danger" role="alert">Your account has been locked due to too many failed login attempts. Please contact support.</div>';
            // Optionally, you could take further actions here, such as logging the incident or notifying the user.
            // You might also want to unset any session variables related to authentication.
            // For simplicity, let's just exit the script here.
            exit();
        } else {
            // Display error message
            echo '<div class="alert alert-danger" role="alert">Wrong email or password. Please try again.</div>';
        }
    }
}
?>

<main>
    <h1>Signin</h1>
    <form action="includes/login.inc.php" method="post">
        <table>
            <tr>
                <td>E-mail</td>
                <td><input type="email" name="mailuid" placeholder="Username/E-mail"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="pwd" placeholder="Password"></td>
            </tr>
            <tr>
                <td><button style="border-radius: 12px;padding:11px 16px;font-weight:bolder" type="submit" name="login-submit">Sign In</button></td>
            </tr>
        </table>
    </form>
</main>

<?php require "footer.php"; ?>
