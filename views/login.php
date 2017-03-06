<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/5/17
 * Time: 8:15 AM
 */

require '../crud/users.php';

$user = new User();

$csrf_token = $user->generateCSRFToken();


$_SESSION['csrf_token'] = $csrf_token;;

/*
 * validate data
 */
if (isset($_POST['username'], $_POST['password'], $_POST['csrf_token'])) {

    /*
     * check if crsf token matches the one generated to
     * avoid attacks from external form submission
     */

    if ($_SESSION['csrf_token'] == $csrf_token) {
        /*
         * Form is valid then we submit
         */
        /*
         * get data from the form
         */
        $username = $_POST['username'];
        $password = $_POST['password'];

        /*
         * authenticate the user
         */
        $authenticated = $user->authenticate($username, $password);
        if ($authenticated===true) {
            $_SESSION['username'] = $username;
            header("Location: board_list.php");
        } else {

            echo "invalid username/password";

        }
    } else {
        header('Location', 'login.php');
    }
} else {
    echo "all fields required";
}

?>

<?php include 'includes/head.php'; ?>
<?php include 'includes/navbar.php' ?>

<div class="container-fluid">
    <div class="col col-md-4 col-md-offset-4">
        <div class="form-group">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username" class="form-control" id="username">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password" class="form-control" id="password">
                <div class="checkbox">
                    <label><input type="checkbox">Remember me</label>
                </div>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <input type="submit" value="Sign in" class="btn btn-danger col-md-6">
            </form>
        </div>
    </div>
</div>