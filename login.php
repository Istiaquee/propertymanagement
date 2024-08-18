<?php 

session_start();

include('templates/db.php');

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email ='$email' AND password='$password'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        $row =mysqli_fetch_assoc($result);
        if($row['email'] === $email && $row['password'] === $password){
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
        }
        // else{
        //     echo 'error';
        // }
    }
    else {
        echo 'error';
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
                    <p class="fs-3 mb-0">Login</p>
                </div>
                <form class="mb-3" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="useremail" aria-describedby="emailHelp" name="email" value="">
                        <div id="errorEmail" class="text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userpassword" aria-describedby="titlehelp" name="password" value="">
                        <div id="errortitle" class="text-danger"></div>
                    </div>            
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary"name="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('templates/footer.php'); ?>
</html>