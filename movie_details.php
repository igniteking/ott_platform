<?php include("./components/includes.php");
include('./components/api.php');
include('./components/header.php');
$id = $_GET['id'];
$movie = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=$api_key");
$movie = json_decode($movie, true);
$add_to_watchlist = @$_POST['watchlist'];
$email_id = $_SESSION['email'];
$movie_id = $id;
$created_at = date("Y-m-d");
if ($add_to_watchlist) {
    $add_to_watchlist_query = "INSERT INTO `watch_list`(`id`, `email`, `movie_id`, `created_at`) VALUES (NULL,'$email_id', '$movie_id','$created_at')";
    $result_add_to_watchlist = mysqli_query($conn, $add_to_watchlist_query);
    if ($result_add_to_watchlist) {
        echo "<script>
                            $(document).ready(function() {
                                document.getElementById('notification-success-watchlist').click()
                            });
                        </script>";
        echo "<meta http-equiv=\"refresh\" content=\"3; url=index.php\">";
    }
}
?>
<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Movie Detalied Page</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- transformers area start -->
<section class="transformers-area">
    <div class="container">
        <div class="transformers-box">
            <div class="row flexbox-center">
                <div class="col-lg-5 text-lg-left text-center">
                    <div class="transformers-content">
                        <img src="https://image.tmdb.org/t/p/w500<?php $new = json_encode($movie['poster_path']);
                                                                    echo $new = substr($new, 2, -1); ?>" alt="img" width="100%" />
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="transformers-content">
                        <h2><?php $new = json_encode($movie['original_title'], true);
                            echo $new = substr($new, 1, -1); ?></h2>
                        <p><?php foreach ($movie['genres'] as $result) {
                                echo $name = $result['name'] . ' | ';
                            } ?></p>
                        <ul>
                            <li>
                                <div class="transformers-left"> Movie: </div>
                                <div class="transformers-right">
                                    <a href="#"><?php foreach ($movie['genres'] as $result) {
                                                    echo $name = $result['name'] . ' | ';
                                                } ?></a>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Popularity: </div>
                                <div class="transformers-right">
                                    <?php $new = json_encode($movie['popularity'], true);
                                    echo $new = substr($new, 1, -1); ?>
                                </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Production <br> Companies: </div>
                                <div class="transformers-right"> <?php foreach ($movie['production_companies'] as $result) {
                                                                        echo $name = $result['name'] . ' | ';
                                                                    } ?> </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Production <br> Countries: </div>
                                <div class="transformers-right"> <?php foreach ($movie['production_countries'] as $result) {
                                                                        echo $name = $result['name'] . ' | ';
                                                                    } ?> </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Release: </div>
                                <div class="transformers-right"> <?php $new = json_encode($movie['release_date'], true);
                                                                    echo $new = substr($new, 1, -1); ?> </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Language: </div>
                                <div class="transformers-right"> <?php foreach ($movie['spoken_languages'] as $result) {
                                                                        echo $name = $result['english_name'] . ' | ';
                                                                    } ?> </div>
                            </li>
                            <li>
                                <div class="transformers-left"> Status: </div>
                                <div class="transformers-right"><?php $new = json_encode($movie['status'], true);
                                                                echo $new = substr($new, 1, -1); ?></div>
                            </li>
                            <li>
                                <div class="transformers-left"> Share: </div>
                                <div class="transformers-right">
                                    <a href="#"><i class="icofont icofont-social-facebook"></i></a>
                                    <a href="#"><i class="icofont icofont-social-twitter"></i></a>
                                    <a href="#"><i class="icofont icofont-social-google-plus"></i></a>
                                    <a href="#"><i class="icofont icofont-youtube-play"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div><br><br>
                    <form class="row" action='./movie_details.php?id=<?php echo $id; ?>' method='post'>
                        <input type='hidden' value='<?php $id; ?>' name='movie_id' />
                        <input type='submit' value='+ Add To Watchlist' class="theme-btn col-md-12" name='watchlist'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section><!-- transformers area end -->
<!-- details area start -->
<section class="details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="details-content">
                    <div class="details-overview">
                        <h2>Overview</h2>
                        <p><?php $new = json_encode($movie['overview'], true);
                            echo $new = substr($new, 1, -1); ?></p>
                    </div>
                    <?php
                    if (isset($_SESSION['email'])) {
                        if ($user_type == 'user') { ?>
                            <div class="details-reply">
                                <h2>Leave a Reply</h2>
                                <?php
                                $post = @$_POST['post'];
                                $email = $_SESSION['email'];
                                $created_at = date("Y-m-d");
                                $comment = @$_POST['comment'];
                                if ($post) {
                                    if ($comment == "") {
                                        echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-info-post').click()
                                        });
                                    </script>";
                                    } else {
                                        $user_check23 = "SELECT * from users WHERE email='$email'";
                                        $result23 = mysqli_query($conn, $user_check23);
                                        while ($row = mysqli_fetch_array($result23)) {
                                            $user_name = $row['username'];
                                            $user_check2 = "SELECT email from users WHERE email='$email'";
                                            $result2 = mysqli_query($conn, $user_check2);
                                            mysqli_query($conn, "INSERT INTO `review`(`id`, `username`, `email`, `movie_id`, `comment`, `created_at`) 
                                VALUES (NULL,'$user_name','$email','$id','$comment','$created_at')");
                                            echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success-post').click()
                                        });
                                    </script>
                                    <meta http-equiv=\"refresh\" content=\"4; url=movie_details.php?id=$id\">";
                                        }
                                    }
                                }
                                ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];
                                                            echo "?id=" . $id; ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <textarea name="comment" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="details-comment">
                                <input type="submit" class="theme-btn col-md-12 theme-btn2" name="post" value="Post Comment" />
                            </div>
                            </form>
                            <button onclick="Notify('Posted successfully! <br> Redirecting....', null, true, 'success')" hidden id="notification-success-post">success</button>
                            <button onclick="Notify('Empty Comment Cannot be Inserted!', null, true, 'warning')" hidden id="notification-info-post">success</button>

                            <?php } else if ($user_type == 'admin') {
                            $movie = $_GET['id'];
                            $query = "SELECT * FROM admin_review WHERE movie_id = '$movie'";
                            $result = mysqli_query($conn, $query);
                            if ($rowcount = mysqli_num_rows($result) == 1) { ?>
                                <?php
                                $query = "SELECT * FROM admin_review WHERE movie_id = '$movie'";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    $story_about = $row['story_about'];
                                    $analysis = $row['analysis'];
                                    $performances = $row['performances'];
                                    $departments = $row['departments'];
                                    $highlights = $row['highlights'];
                                    $drawbacks = $row['drawbacks'];
                                    $enjoyed_it = $row['enjoyed_it'];
                                    $recomendation = $row['recomendation'];
                                    $star = $row['star'];
                                    $link = $row['link'];
                                    $created_at = $row['created_at'];
                                    echo "<div class='row'>
                                <div class='col-lg-12'>
                                <div class='details-content'>
                                    <h3>What is the story about?</h3><br>
                                    <p>$story_about</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Analysis</h3><br>
                                    <p>$analysis</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Performances</h3><br>
                                    <p>$performances</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Music and other departments</h3><br>
                                    <p>$departments</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Highlights</h3><br>
                                    <p>$highlights</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Drawbacks</h3><br>
                                    <p>$drawbacks</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Did you enjoyed it?</h3><br>
                                    <p>$enjoyed_it</p>
                                </div>
                                <div class='details-content'>
                                    <h3>Do I recomend it?</h3><br>
                                    <p>$recomendation</p>
                                </div>
                                <div class='details-content'>
                                    <h3>View Link</h3><br>
                                    <a href='$link'><button class='btn btn-primary' value='Link'>View Link</button></a>
                                </div>
                                <div class='details-content'>
                                    <h3>Star Rating</h3><br>
                                    ";
                                    for ($i = 1; $i <= $star; $i++) {
                                        echo "<img src='./assets/img/Gold-Star.png' alt='star' width='50'>";
                                    };
                                    echo "</div>
                            </div>
                        </div>";
                                }
                                ?>
                            <?php } else { ?>
                                <?php
                                $movie = $_GET['id'];
                                $post = @$_POST['admin_post'];
                                $story_about = @$_POST['story_about'];
                                $analysis = @$_POST['analysis'];
                                $performances = @$_POST['performances'];
                                $departments = @$_POST['departments'];
                                $highlights = @$_POST['highlights'];
                                $drawbacks = @$_POST['drawbacks'];
                                $enjoyed_it = @$_POST['enjoyed_it'];
                                $recomendation = @$_POST['recomendation'];
                                $star = @$_POST['star'];
                                $link = @$_POST['link'];
                                $created_at = date("Y-m-d");
                                if ($post) {
                                    $final = mysqli_query($conn, "INSERT INTO `admin_review`(`id`, `movie_id`, `story_about`, `analysis`, `performances`, `departments`, `highlights`, `drawbacks`, `enjoyed_it`, `recomendation`, `star`, `link`, `created_at`) 
                                VALUES (NULL,'$movie','$story_about','$analysis','$performances','$departments','$highlights','$drawbacks','$enjoyed_it','$recomendation', '$star', '$link', '$created_at')");
                                    if ($final) {
                                        echo "<script>
                                        $(document).ready(function() {
                                            console.log('ready!');
                                            document.getElementById('notification-success-post').click()
                                        });
                                    </script>
                                    <meta http-equiv=\"refresh\" content=\"4; url=movie_details.php?id=$id\">";
                                    }
                                }

                                ?>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];
                                                            echo "?id=" . $id; ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">What is the story about?</label>
                                                <textarea name="story_about" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Analysis</label>
                                                <textarea name="analysis" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Performances</label>
                                                <textarea name="performances" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Music and other departments</label>
                                                <textarea name="departments" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Highlights</label>
                                                <textarea name="highlights" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Drawbacks</label>
                                                <textarea name="drawbacks" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Did you enjoyed it?</label>
                                                <textarea name="enjoyed_it" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Do I recomend it?</label>
                                                <textarea name="recomendation" placeholder="Type Here Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Star Rating?</label>
                                                <select name="star" class="form-control" id="">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <label for="">Link</label>
                                                <input type="url" name="link" placeholder="Type Link here">
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="details-comment">
                                        <input type="submit" class="theme-btn col-md-12 theme-btn2" name="admin_post" value="Submit" />
                                    </div>
                                </form>
                                <button onclick="Notify('Posted successfully! <br> Redirecting....', null, true, 'success')" hidden id="notification-success-post">success</button>

                    <?php
                            }
                        }
                    }
                    $movie = $_GET['id'];
                    $query = "SELECT * FROM review WHERE id = '$movie'";
                    $result = mysqli_query($conn, $query);
                    if ($rowcount = mysqli_num_rows($result) == 0) {
                        echo "<section class='details-area'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <div class='details-content'>
                                        <div class='details-overview'>
                                            <h4>No Review Yet!</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>";
                    } else {
                        $query = "SELECT * FROM review WHERE movie_id = '$movie'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $user_id = $row['id'];
                            $username = $row['username'];
                            $email = $row['email'];
                            $movie_id = $row['movie_id'];
                            $comment = $row['comment'];
                            $created_at = $row['created_at'];
                            echo "<section class='details-area'>
                        <div class='container'>
                            <div class='row'>
                                <div class='col-lg-12'>
                                    <div class='details-content'>
                                        <div class='details-overview'>
                                            <h4>#$username</h4>
                                            <p>$comment</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>";
                        }
                    } ?>
                    <!-- <div class="details-thumb">
                        <div class="details-thumb-prev">
                            <div class="thumb-icon">
                                <i class="icofont icofont-simple-left"></i>
                            </div>
                            <div class="thumb-text">
                                <h4>Previous Post</h4>
                                <p>Standard Post With Gallery</p>
                            </div>
                        </div>
                        <div class="details-thumb-next">
                            <div class="thumb-text">
                                <h4>Next Post</h4>
                                <p>Standard Post With Preview Image</p>
                            </div>
                            <div class="thumb-icon">
                                <i class="icofont icofont-simple-right"></i>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section><!-- details area end -->
<?php include('./components/footer.php') ?>