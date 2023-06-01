<?php include('./includes/connection.php');
include('./includes/global.php'); ?>
<!-- header section start -->
<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <a href="index-2.html"><img src="assets/img/logo.png" alt="logo" /></a>
            </div>
            <div class="header-right">
                <form action="#">
                    <select>
                        <option value="Movies">Movies</option>
                        <option value="Movies">Tv Series</option>
                    </select>
                    <input type="text" />
                    <button><i class="icofont icofont-search"></i></button>
                </form>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <?php if (isset($_SESSION['email'])) {
                            if ($user_type == 'admin') {
                                echo "<li><a class='active' href='./index.php'>Home</a></li>
                                <li><a href='./movies.php'>Movies</a></li>
                                <li><a href='./comming_soon.php'>Coming Soon</a></li>
                                <li><a href='blog.php'>Blog</a></li>
                                <li><a href='#'>Admin Pages <i class='icofont icofont-simple-down'></i></a>
                                    <ul>
                                        <li><a href='create_blog.php'>Blog Page</a></li>
                                        <li><a href='create_trailer.php'>Trailer Page</a></li>
                                        <li><a href='settings.php'>Addition Settings</a></li>
                                    </ul>
                                </li>";
                            } else {
                                echo "<li><a class='active' href='./index.php'>Home</a></li>
                                <li><a href='./movies.php'>Movies</a></li>
                                <li><a href='./comming_soon.php'>Coming Soon</a></li>
                                <li><a href='./watchlist.php'>Watch List</a></li>
                                <li><a href='blog.php'>Blog</a></li>";
                            }
                        } else {
                            echo "<li><a class='active' href='./index.php'>Home</a></li>
                                <li><a href='./movies.php'>Movies</a></li>
                                <li><a href='./comming_soon.php'>Coming Soon</a></li>
                                <li><a href='blog.php'>Blog</a></li>";
                        } ?>

                        <?php if (isset($_SESSION['email'])) {
                            echo '<li><a class="" href="#">' . $username  . '</a></li>';
                            echo '<li><a class="" href="./logout.php"> Logout </a></li>';
                        } else { ?>
                            <li><a class="reg-popup" href="#">Register</a></li>
                            <li><a class="login-popup" href="#">Login</a></li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</header>
<?php
$reg = @$_GET['status'];
if ($reg == '1') {
    $reg = "style='display: block;'";
} else {
    $reg = "";
}
?>
<?php
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['user_password']);
    //Error Handlers
    //Check if inputs are empty
    if (empty($email) || empty($pwd)) {
        echo "<p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>E-mail and Password are Empty!</p>";
    } else {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            echo "<p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>E-mail is Incorrect!</p>";
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                $id_login = $row['id'];
                $email_login = $row['email'];
                $password_login = $row['password'];
                if ($password_login == false) {
                    echo "<p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Password is Incorrect!!</p>";
                } elseif ($password_login == true) {
                    $session_token = md5(time() . $email_login);
                    $_SESSION['id'] = $id_login;
                    $_SESSION['email'] = $email_login;
                    $_SESSION['password'] = $password_login;

                    //INSERTING SESSION
                    echo "<meta http-equiv=\"refresh\" content=\"2; url=index.php?status=success\">";
                    exit();
                }
            }
        }
    }
}
?>
<div class="login-area" <?php echo $reg; ?>>
    <div class="login-box">
        <a href="#"><i class="icofont icofont-close"></i></a>
        <h2>LOGIN</h2>
        <form action="index.php" method="POST">
            <h6>EMAIL ADDRESS</h6>
            <input type="text" style="color: black;" name="user_email" />
            <h6>PASSWORD</h6>
            <input type="password" style="color: black;" name="user_password" />
            <input type="submit" class="btn-primary col-md-12" name="login" value="Login" />
        </form>
    </div>
</div>

<?php
$submit = @$_POST['register'];
$username = strip_tags(@$_POST['username']);
$email = strip_tags(@$_POST['email']);
$password = strip_tags(@$_POST['password']);
$r_pswd = strip_tags(@$_POST['repeat-password']);
$date = date("Y-m-d");
$usertype = "user";
if ($submit) {
    if ($email && $password && $r_pswd && $username) {
        $user_check2 = "SELECT email from users WHERE email='$email'";
        $result2 = mysqli_query($conn, $user_check2);
        $result_check2 = mysqli_num_rows($result2);
        if (!$result_check2 > 0) {
            if ($password == $r_pswd) {
                if (preg_match("/\d/", $password)) {
                    if (preg_match("/[A-Z]/", $password)) {
                        if (preg_match("/[a-z]/", $password)) {
                            if (preg_match("/\W/", $password)) {
                                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_query($conn, "INSERT INTO `users`(`id`, `username`, `email`, `password`, `user_type`, `created_at`)
                                           VALUES (NULL, '$username','$email','$hashedPwd', '$usertype', '$date')");
                                echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success').click()
                                        });
                                    </script>";
                                echo "<meta http-equiv=\"refresh\" content=\"4; url=index.php?status=1\">";
                            } else {
                                echo "<div class='error-styler'><center>
                                        <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Password should contain at least one special character!</p>;
                                        </center></div>";
                            }
                        } else {
                            echo "<div class='error-styler'><center>
                                    <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Password should contain at least one small Letter</p>
                </center></div>";
                        }
                    } else {
                        echo "<div class='error-styler'><center>
                                <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Password should contain at least one Capital Letter</p>
                </center></div>";
                    }
                } else {
                    echo "<div class='error-styler'><center>
                            <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Password should contain at least one digit</p>
            </center></div>";
                }
            } else {
                echo "<div class='error-styler'><center>
                        <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Both Password's Dont Match!</p>
            </center></div>";
            }
        } else {
            echo "<div class='error-styler'><center>
                    <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>E-mail already exist!</p>
            </center></div>";
        }
    } else {
        echo "<div class='error-styler'><center>
                <p style='padding: 10px; margin: 10px; font-size: 14px; color: #fff; font-weight: 600; border-radius: 8px; text-align: center; background: #ff7474;'>Please Fill In All Fields!</p>
            </center></div>";
    }
}
?>
<div class="reg-area">
    <div class="reg-box">
        <a href="#"><i class="icofont icofont-close"></i></a>
        <h2>REGISTER</h2>

        <form action="index.php" method="POST">
            <h6>USERNAME</h6>
            <input type="text" name="username" style="color: #000" />
            <h6>EMAIL ADDRESS</h6>
            <input type="text" name="email" style="color: #000" />
            <h6>PASSWORD</h6>
            <input type="password" name="password" style="color: #000" />
            <h6>REPEAT PASSWORD</h6>
            <input type="password" name="repeat-password" style="color: #000" />
            <input type="submit" class="btn-primary col-md-12" name="register" value="Register" />
        </form>
        <button onclick="Notify('There was a problem creating your account! <br> Redirecting....', null, true, 'danger')" hidden="hidden" id="notification-danger">danger</button>
        <button onclick="Notify('Your account has been created successfully! <br> Redirecting....', null, true, 'success')" hidden="hidden" id="notification-success">success</button>
        <button onclick="Notify('Added to your watchlist successfully! <br> Redirecting....', null, true, 'success')" hidden="hidden" id="notification-success-watchlist">success</button>
    </div>
</div>