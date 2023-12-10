<?php
function validate_message($message)
{
   return strlen(trim($message)) > 10;
}

function validate_username($username)
{
    return ctype_alnum(trim($username));
}

function validate_email($email)
{   
    return strpos(trim($email), "@");
}

$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";

$terms = "";
$username = "";
$email = "";
$message = "";

$form_valid = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $message = isset($_POST['message']) ? $_POST['message'] : "";
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $terms = isset($_POST['terms']) ? $_POST['terms'] : "";

    if(!validate_message($message)){

        $message_error = "message must be at least 10 caracters long";
        $form_valid = false;

    }
    if(!validate_username($username)){

        $user_error = "Username should contains only letters and numbers";
        $form_valid = false;

    }
    if(!validate_email($email)){

        $email_error = "Invalid email";
        $form_valid = false;

    }
    if($terms != "terms"){

        $terms_error = "you must accept the Terms of Service";
        $form_valid = false;

    }

    // Here is the list of error messages that can be displayed:
    //
    // "Message must be at least 10 caracters long"
    // "You must accept the Terms of Service"
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    // "Please enter an email"
    // "email must contain '@'"

}

?>

<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
            <small class="form-text text-danger"> <?php echo htmlspecialchars($user_error); // in ra chuỗi lỗi ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email">
            <small class="form-text text-danger"> <?php echo htmlspecialchars($email_error);// in ra chuỗi  lỗi ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
        <small class="form-text text-danger"> <?php echo htmlspecialchars($message_error);// in ra chuỗi  lỗi ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms"> <label for="terms">Iaccept the Terms of Service</label>
        <small class="form-text text-danger"> <?php echo htmlspecialchars($terms_error); // in ra chuỗi  lỗi?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
?>