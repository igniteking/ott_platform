<?php
function test($api_key, $id)
{
    $data2 = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=$api_key");
    $movie = json_decode($data2, true);
    foreach ($movie['genres'] as $result) {
        $id = json_encode($movie['id']);
        $original_title = json_encode($movie['original_title']);
        $original_title = substr($original_title, 1, -1);
        $poster_path = json_encode($movie['poster_path']);
        $votes = json_encode($movie['vote_count']);
        $status = json_encode($movie['status']);
        $status = substr($status, 1, -1);
        if ($status == 'Released') {
            $status = 'Released';
        } else {
            $status = 'soon';
        }
        $poster_path = substr($poster_path, 2, -1);
        $final_poster = 'https://image.tmdb.org/t/p/w500/' . $poster_path;


        return "<div class='col-lg-3 col-md-4 col-sm-6 $status'>
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
}


function networks($network_id, $api_key)
{
    $network_provider = file_get_contents("https://api.themoviedb.org/3/network/$network_id?api_key=$api_key");
    $network_data = json_decode($network_provider, true);
    $id = json_encode($network_data['id']);
    $logo_path = json_encode($network_data['logo_path']);
    $logo_path = substr($logo_path, 1, -1);

    return "<div class='single-portfolio'>
    <a href='./index.php?network=$id'>
      <div class='single-portfolio-img'>
        <img src='https://image.tmdb.org/t/p/w500/$logo_path' alt='netflix' />
      </div>
    </a>
  </div>";
}


function deleteBlog($conn, $id)
{
    $delete_query = "DELETE FROM `blog` WHERE id = $id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        return "<script>
    $(document).ready(function() {
        console.log('ready!');
        document.getElementById('notification-deleted-blog').click()
    });
    </script>
<meta http-equiv=\"refresh\" content=\"4; url=create_blog.php\">";
    }
}


function deleteTrailer($conn, $id)
{
    $delete_query = "DELETE FROM `trailer` WHERE id = $id";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        return "<script>
    $(document).ready(function() {
        console.log('ready!');
        document.getElementById('notification-deleted-blog').click()
    });
    </script>
<meta http-equiv=\"refresh\" content=\"4; url=create_trailer.php\">";
    }
}
