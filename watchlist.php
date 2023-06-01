<?php include('./components/includes.php') ?>
<?php include('./components/api.php') ?>
<?php include('./components/header.php') ?>
<?php include('./components/apiFunction.php') ?>

<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>Your Watch List</h1>
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
                    <h1><i class="icofont icofont-movie"></i> Saved</h1>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                    <ul>
                        <li data-filter="*" class="active">All</li>
                        <li data-filter=".soon">Comming Soon</li>
                        <li data-filter=".Released">Recently Released</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="row portfolio-item">
            <?php
            $final_email = $_SESSION['email'];
            $query = "SELECT * FROM watch_list WHERE email = '$final_email' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $movie_watchlist_id = $row['movie_id'];
                echo test("4a2ff1022de91af3d87295cf25c92b06", $movie_watchlist_id);
            } ?>

        </div>
    </div>
</section><!-- portfolio section end -->
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