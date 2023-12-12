<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Articles</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <div class="jumbotron">
        <h1> News Articles</h1>
    </div>

    <div class="container-fluid">
        <?php
        $apiKey = '0d52d5d33fa5407d9a91ee5dfdb25cb7'; // Replace with your actual NewsAPI key

        $url = 'https://newsapi.org/v2/everything?q=tesla&from=2023-11-12&sortBy=publishedAt&apiKey=0d52d5d33fa5407d9a91ee5dfdb25cb7';


        $response = file_get_contents($url);

        if ($response !== false) {
            $newsData = json_decode($response);

            if ($newsData && isset($newsData->articles)) {
                foreach ($newsData->articles as $news) {
        ?>
                    <div class="row NewsGrid">
                        <div class="col-md-3">
                            <img src="<?php echo $news->urlToImage ?>" alt="News thumbnail">
                        </div>
                        <div class="col-md-9">
                            <h2>Title: <?php echo $news->title ?></h2>
                            <h5>Description: <?php echo $news->description ?> </h5>
                            <p>Content: <?php echo $news->content ?> </p>
                            <h6>Author: <?php echo $news->author ?> </h6>
                            <h6>Published At: <?php echo $news->publishedAt ?> </h6>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo 'Failed to fetch news. Response format might be unexpected.';
            }
        } else {
            echo 'Failed to fetch data from the API. Check your API key and request parameters.';
        }
        ?>
    </div>
</body>

</html>
