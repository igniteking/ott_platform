<?php include('./components/includes.php') ?>
<?php include('./components/api.php') ?>
<?php include('./components/header.php') ?>
<?php include('./components/apiFunction.php') ?>
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Movies Page</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- portfolio section start -->
<section class="portfolio-area pt-60">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Trending Today</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="video-slider mt-20">
                    <?php
                    $add_to_watchlist = @$_POST['watchlist'];
                    if (isset($_SESSION['email'])) {
                        $email_id = $_SESSION['email'];
                    } else {
                        $email_id = "";
                    };
                    $movie_id = @$_POST['movie_id'];
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

                    foreach ($data2['results'] as $result) {
                        $id = $result['id'];
                        $network == 'netflix' ? $orignal_title = $result['original_title'] : $orignal_title = $result['original_title'];
                        $network == 'netflix' ? $overview = $result['overview'] : $overview = $result['overview'];
                        $network == 'netflix' ? $poster_path = $result['poster_path'] : $poster_path = $result['poster_path'];
                        $network == 'netflix' ? $backdrop_path = $result['backdrop_path'] : $backdrop_path = $result['backdrop_path'];
                        $network == 'netflix' ? $release_date = $result['release_date'] : $release_date = $result['release_date'];
                        $network == 'netflix' ? $vote_count = $result['vote_count'] : $vote_count = $result['vote_count'];
                        $network == 'netflix' ? $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path : $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                        echo "<div class='single-portfolio'>
                <a href='movie_details.php?id=$id'><div class='single-portfolio-img'>
                  <img src='$final_poster' alt='portfolio' />
                </div>
                <div class='portfolio-content'>
                <br>
                  <h4>$orignal_title</h4>
                  <div class='review'>
                    <h6>$vote_count voters</h6>
                  </div>";
                        if (isset($_SESSION['email'])) {
                            echo "<br>
                    <form action='./index.php' method='post'>
                    <input type='hidden' value='$id' name='movie_id' />
                  <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
                </form>";
                        }
                        echo "
                  </div></a>
                </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- video section end -->
</center>
<!-- portfolio section end -->

<section class="portfolio-area pt-60">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Recommended</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="video-slider mt-20">
                    <?php
                    $add_to_watchlist = @$_POST['watchlist'];
                    if (isset($_SESSION['email'])) {
                        $email_id = $_SESSION['email'];
                    } else {
                        $email_id = "";
                    };
                    $movie_id = @$_POST['movie_id'];
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

                    if (isset($_SESSION['email'])) {
                        $final_email_id = $_SESSION['email'];
                        $query = "SELECT * FROM watch_list WHERE email = '$final_email_id' ORDER BY id DESC LIMIT 1";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $movie_id  = $row['movie_id'];
                        }
                    } else {
                        $movie_id = "507086";
                    };


                    $query = urlencode("trending");
                    $trending = file_get_contents("https://api.themoviedb.org/3/movie/$movie_id/recommendations?api_key=$api_key&language=en-US&page=1");
                    $trending = json_decode($trending, true);
                    foreach ($trending['results'] as $result) {
                        $id = $result['id'];
                        $network == 'netflix' ? $orignal_title = $result['original_title'] : $orignal_title = $result['original_title'];
                        $network == 'netflix' ? $overview = $result['overview'] : $overview = $result['overview'];
                        $network == 'netflix' ? $poster_path = $result['poster_path'] : $poster_path = $result['poster_path'];
                        $network == 'netflix' ? $backdrop_path = $result['backdrop_path'] : $backdrop_path = $result['backdrop_path'];
                        $network == 'netflix' ? $release_date = $result['release_date'] : $release_date = $result['release_date'];
                        $network == 'netflix' ? $vote_count = $result['vote_count'] : $vote_count = $result['vote_count'];
                        $network == 'netflix' ? $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path : $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                        echo "<div class='single-portfolio'>
                        <a href='movie_details.php?id=$id'><div class='single-portfolio-img'>
                          <img src='$final_poster' alt='portfolio' />
                        </div>
                        <div class='portfolio-content'>
                        <br>
                          <h4>$orignal_title</h4>
                          <div class='review'>
                            <h6>$vote_count voters</h6>
                          </div>";
                        if (isset($_SESSION['email'])) {
                            echo "<br>
                            <form action='./index.php' method='post'>
                            <input type='hidden' value='$id' name='movie_id' />
                          <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
                        </form>";
                        }
                        echo "
                          </div></a>
                        </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- video section end -->


<section class="portfolio-area pt-60">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Upcoming Movies</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="video-slider mt-20">
                    <?php
                    $add_to_watchlist = @$_POST['watchlist'];
                    if (isset($_SESSION['email'])) {
                        $email_id = $_SESSION['email'];
                    } else {
                        $email_id = "";
                    };
                    $movie_id = @$_POST['movie_id'];
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

                    $query = urlencode("trending");
                    $trending = file_get_contents("https://api.themoviedb.org/3/movie/upcoming?api_key=$api_key&language=en-US&page=1");
                    $trending = json_decode($trending, true);
                    foreach ($trending['results'] as $result) {
                        $id = $result['id'];
                        $network == 'netflix' ? $orignal_title = $result['original_title'] : $orignal_title = $result['original_title'];
                        $network == 'netflix' ? $overview = $result['overview'] : $overview = $result['overview'];
                        $network == 'netflix' ? $poster_path = $result['poster_path'] : $poster_path = $result['poster_path'];
                        $network == 'netflix' ? $backdrop_path = $result['backdrop_path'] : $backdrop_path = $result['backdrop_path'];
                        $network == 'netflix' ? $release_date = $result['release_date'] : $release_date = $result['release_date'];
                        $network == 'netflix' ? $vote_count = $result['vote_count'] : $vote_count = $result['vote_count'];
                        $network == 'netflix' ? $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path : $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                        echo "<div class='single-portfolio'>
                        <a href='movie_details.php?id=$id'><div class='single-portfolio-img'>
                          <img src='$final_poster' alt='portfolio' />
                        </div>
                        <div class='portfolio-content'>
                        <br>
                          <h4>$orignal_title</h4>
                          <div class='review'>
                            <h6>$vote_count voters</h6>
                          </div>";
                        if (isset($_SESSION['email'])) {
                            echo "<br>
                            <form action='./index.php' method='post'>
                            <input type='hidden' value='$id' name='movie_id' />
                          <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
                        </form>";
                        }
                        echo "
                          </div></a>
                        </div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- video section end -->
</center>
<!-- video section start -->
<section class="video ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-20">
                    <h1><i class="icofont icofont-film"></i> Trailers & Videos</h1>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="video-slider mt-20">
                    <?php
                    $query = "SELECT * FROM trailer ORDER BY id DESC LIMIT 10";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                        $id  = $row['id'];
                        $topic  = $row['topic'];
                        $link  = $row['link'];
                        $image  = $row['image'];
                        $created_at  = $row['created_at'];
                        echo "<div class='video-area'>
                        <img src='$image' alt='video' />
                        <a href='$link' class='popup-youtube'>
                            <i class='icofont icofont-ui-play'></i>
                        </a>
                    </div>";
                    } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</section><!-- video section end -->
<!-- footer section start -->
<?php include('./components/footer.php') ?>