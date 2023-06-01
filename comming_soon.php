<?php include('./components/includes.php') ?>
<?php include('./components/api.php') ?>
<?php include('./components/header.php') ?>
<?php include('./components/apiFunction.php'); ?>

<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Comming Soon</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<section class="portfolio-area pt-60">
    <div class="container">
        <table class="table table-bordered table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Release Date</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
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
                $data2 = file_get_contents("https://api.themoviedb.org/3/movie/upcoming?api_key=$api_key");
                $movie = json_decode($data2, true);
                foreach ($movie['results'] as $result) {
                    $id = $result['id'];
                    $original_title = $result['original_title'];
                    $overview = $result['overview'];
                    $poster_path = $result['poster_path'];
                    $votes = $result['vote_count'];
                    $release_date = $result['release_date'];
                    $date = date_create($release_date);
                    $final = date_format($date, "Y/m/d");
                    $backdrop_path = $result['backdrop_path'];
                    $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                    $final_backdrop = 'https://image.tmdb.org/t/p/w500/' . $backdrop_path;
                    echo "<tr>
                    <th scope='row'>$id</th>
                    <td>$original_title</td>
                    <td>$release_date</td>
                    <td>
                    <form action='./index.php' method='post'>
                    <a href='movie_details.php?id=$id'><input type='button' value='View' class='btn btn-primary' name='movie_id' /></a>
                  <input type='submit' value='+ Add To Watchlist' name='watchlist' class='btn btn-primary'>
                </form></td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</section>
<!-- portfolio section start -->
<section class="portfolio-area pt-60">
    <div class="container">
        <div class="row flexbox-center">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Saved</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                    <ul>
                        <li data-filter=".soon" class="active">Comming Soon</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="row portfolio-item">
            <?php
            $data2 = file_get_contents("https://api.themoviedb.org/3/movie/upcoming?api_key=$api_key&language=en-US&page=1");
            $movie = json_decode($data2, true);
            foreach ($movie['results'] as $result) {
                $id = $result['id'];
                $original_title = $result['original_title'];
                $overview = $result['overview'];
                $poster_path = $result['poster_path'];
                $votes = $result['vote_count'];
                $backdrop_path = $result['backdrop_path'];
                $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;
                $final_backdrop = 'https://image.tmdb.org/t/p/w500/' . $backdrop_path;
                echo "<div class='col-lg-3 col-md-4 col-sm-6'>
                <div class='single-portfolio'>
                <a href='movie_details.php?id=$id'>
                    <div class='single-portfolio-img'>
                        <img src='$final_poster' alt='portfolio' />
                    </div>
                    <div class='portfolio-content'>
                        <h2>$original_title</h2>
                        <div class='review'>
                            <h4>$votes voters</h4>
                        </div>
                    </div>
                </div>
                </a>
            </div>";
            }
            ?>

        </div>
    </div>
</section><!-- portfolio section end -->
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