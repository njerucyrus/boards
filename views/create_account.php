<?php
session_start();
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/4/17
 * Time: 5:30 PM
 */
require '../connectdb.php';
require '../crud/users.php';

$user = new User();

$csrf_token = $user->generateCSRFToken();

$_SESSION['csrf_token'] = $csrf_token;

/*
 * get the user details from the form
 */
if (isset(
    $_POST['first-name'],
    $_POST['last-name'],
    $_POST['email'],
    $_POST['phone-number'],
    $_POST['company'],
    $_POST['account-type'],
    $_POST['username'],
    $_POST['password'],
    $_POST['csrf_token']
)) {

    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone-number'];
    $accountType = $_POST['account-type'];
    $company = $_POST['company'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if($_SESSION['csrf_token'] == $csrf_token){

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setPhoneNumber($phoneNumber);
        $user->setAccountType($accountType);
        $user->setCompany($company);
        $user->setUsername($username);
        $user->setPassword($password);

        $created = $user->create();
        if($created){
            echo "Account Created Successfully!";
            unset($_SESSION['csrf_token']);
        }
        else{
            echo "Error occurred in creating the account";
        }
    }
    else{
        echo "invalid  csrf_token or token is missing";
    }
}
else{

}


?>

<!DOCTYPE html>

<?php include 'includes/head.php'?>

<body>
<nav>
    <?php include "includes/navbar.php" ?>
</nav>
<div class="container-fluid" style="margin-top: 50px;">

    <div class="row">
        <div class="col col-md-12">
        <div class="col col-md-4 col-md-offset-3">
            <form class="form-group" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="create-account-form">
                <label for="first-name">First Name</label>
                <input type="text" name="first-name" id="first-name" class="form-control">

                <label for="last-name">Last Name</label>
                <input type="text" name="last-name" id="last-name" class="form-control">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">

                <label for="phone-number">Phone Number</label>
                <input type="text" name="phone-number" id="phone-number" class="form-control">

                <label for="company">Company</label>
                <input type="text" name="company" id="company" class="form-control">

                <label for="account-type">Select Account Type</label>
                <select name="account-type" id="account-type" class="form-control">
                    <option value="ordinary">Ordinary</option>
                    <option value="merchant">Merchant</option>
                </select>

                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control">

                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">


                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                <input type="submit" value="Sign up" class="col-md-4 btn btn-danger pull-left" style="margin-top: 10px;">

            </form>
        </div>
    </div>
</div>
</div>
</div>
</body>


