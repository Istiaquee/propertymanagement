<?php
include('templates/db.php');

$email = $password = $username = $conNumber = '';
$errors = ['email' => '', 'password' => '', 'username' => '', 'conNumber' => ''];
if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $conNumber = $_POST['conNumber'];
    
    //duplicate email
    $sqlvalidation = "SELECT COUNT(*) as count FROM user WHERE email = '$email'";
    $result = mysqli_query($conn,$sqlvalidation);
    
    if($result){
        $emailAsso = mysqli_fetch_assoc($result);
        if($emailAsso['count']){
            $errors['email'] = "This email is already inserted";
        }
    }

    //duplicate contact
    $sqlvalidation = "SELECT COUNT(*) as count FROM user WHERE contact = '$conNumber'";
    $result = mysqli_query($conn,$sqlvalidation);
    
    if($result){
        $conAsso = mysqli_fetch_assoc($result);
        if($conAsso['count']){
            $errors['conNumber'] = "This number is already inserted";
        }
    }

    //duplicate username
    $sqlvalidation = "SELECT COUNT(*) as count FROM user WHERE username = '$username'";
    $result = mysqli_query($conn,$sqlvalidation);
    
    if($result){
        $userAsso = mysqli_fetch_assoc($result);
        if($userAsso['count']){
            $errors['username'] = "This username is already inserted";
        }
    }

    //email
    if(empty($email)){
        $errors['email'] = 'Email field is empty';
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Emter a valid email';
        }
    }
    //password
    if(empty($password)){
        $errors['password'] = 'Password field is empty';
    }else{
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $hasLetter = preg_match('/[a-zA-Z]/', $password); // At least one letter
        $hasNumber = preg_match('/\d/', $password);       // At least one number
        $hasSpecial = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);

        if(!$hasLetter && !$hasNumber && !$hasSpecial){
            $errors['password'] = 'Enter a valid password';
        }
    }

    //username
    if(empty($username)){
        $errors['username'] = 'Username field is empty';
    }else{
        if(!preg_match("/^[a-zA-Z0-9._-]+$/",$username)){
            $errors['username'] = 'Emter a valid username';
        }
    }

    //contact number
    if(empty($conNumber)){
        $errors['conNumber'] = 'Number field is empty';
    }else{
        if(!ctype_digit($conNumber)){
            $errors['conNumber'] = 'Emter a valid Number';
        }
    }


    //insert data
    if(array_filter($errors)){

    }else {
        $sql = "INSERT INTO user(email, password, username, contact, role) VALUES('$email', '$password', '$username', '$conNumber', 'user')";

        if(mysqli_query($conn,$sql)){
            header('Location: login.php');
        }else{
            echo 'error' . mysqli_connect_error();
        }
       
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<section>

    <div class="container widthsix">
        <div class="row">
            <div class="col-12">
                <div class="text-center mt-3">
                    <p class="fs-3 mb-0">Sign Up</p>
                </div>
                <form class="mb-3" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="useremail" aria-describedby="emailHelp" name="email" value="">
                        <div id="errorEmail" class="text-danger"> <?php echo $errors['email']; ?> </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userpassword" aria-describedby="titlehelp" name="password" value="">
                        <div id="errortitle" class="text-danger"> <?php echo $errors['password']; ?> </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="ingredient" name="username" value="">
                        <div id="erroringre" class="text-danger"> <?php echo $errors['username'] ?> </div>
                    </div> 
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="conNumber" aria-describedby="ingredient" name="conNumber" value="">
                        <div id="erroringre" class="text-danger"> <?php echo $errors['conNumber'] ?></div>
                    </div>                
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary"name="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('templates/footer.php'); ?>
</html>