<?php

include('config.php');

$login_button = '';

$apiKey = 'AIzaSyAwOa4EFQOHL7IGEEyuSoF_Ub9kyL16u50'; // Replace 'YOUR_API_KEY' with your actual API key

$channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw'; // Sample channel ID (OpenAI's YouTube channel)
$maxResults = 0; // Number of videos to retrieve

$apiUrl = 'https://www.googleapis.com/youtube/v3/search?key=' . $apiKey . '&channelId=' . $channelId . '&part=snippet,id&order=date&maxResults=' . $maxResults;

$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

if ($data) {
    foreach ($data['items'] as $item) {
        // Extract video details
        $videoTitle = $item['snippet']['title'];
        $videoId = $item['id']['videoId'];

        // Display video details (you can customize this as needed)
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/lSK7FDZZp4Y?si=1chkQnN0RT_xTvND' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
        echo '<p>Title: ' . $videoTitle . '</p>';
        echo '<hr>';
    }
} else {
    echo 'Error fetching data from the YouTube API.';
}

if(isset($_GET["code"]))
{
  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

  if(!isset($token['error']))
  {
    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();
    
    if(!empty($data['given_name']))
    {
      $_SESSION['user_first_name'] = $data['given_name'];
    }

    if(!empty($data['family_name']))
    {
      $_SESSION['user_last_name'] = $data['family_name'];
    }

    if(!empty($data['email']))
    {
      $_SESSION['user_email_address'] = $data['email'];
    }

    if(!empty($data['gender']))
    {
      $_SESSION['user_gender'] = $data['gender'];
    }

    if(!empty($data['picture']))
    {
      $_SESSION['user_image'] = $data['picture'];
    }
  }
}
if (!isset($_SESSION['access_token'])) {
  header("Location: login.php"); // Redirect to login page if access token is not set
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>News Website</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Custom CSS for navbar */
        .navbar.navbar-default {
            margin-bottom: 0;
            border-radius: 0;
        }
        /* Adjusted video width */
        .yt iframe {
            width: 100%;
            max-width: 100%;
            height: 200px; /* Adjusted height for maintaining aspect ratio */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <!-- Navigation Bar -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <!-- Navbar Header and Brand -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">News Website</a>
                    </div>
                    <!-- Navbar Links -->
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="home.php">Home</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                        <!-- Logout Button -->
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="logout.php">Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <!-- Embedded Videos in Columns -->
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/lSK7FDZZp4Y?si=1chkQnN0RT_xTvND" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/34onUzMUy3A?si=dcKlcrS9NTx5-xfH" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/UWmpLikd88Y?si=53aE5byGhbMFT6BR" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                      <div class="col-xs-12 col-sm-6">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/6o2G7WXM3pc?si=vvxayg4KdbECwIvC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </main>

        <footer>
            <!-- Next Page Link -->
            <ul class="pagination">
                <li class="next">
                    <a href="news.php">Next Page</a>
                </li>
            </ul>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>
