<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Twiteer API</title>
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once("api/userTweet.php");
    require_once("api/utility.php");

    function renderTweets($handel = "imVkohli", $no_of_tweets = 5){
        $res2 = new TwitterAPI();
        $res3 = $res2->getTweets($handel);
        $res4 = objectToArray(json_decode($res3)); 

        $html = '';

        if($no_of_tweets>10)
        {
            $html .='<h1 style="color:red;">No of tweets shoud be less than 11</h1>';
        }
        else
        {
            if($no_of_tweets == 5)
            {
                for($i=0; $i<5; $i++)
                {
                    $html .='<ul><li>'.$res4['data'][$i]['id'].'</li>';
                    $html .='<p>'.$res4['data'][$i]['text'].'</p></ul>';
                }
            }
            else
            {
                for($i=0; $i<$no_of_tweets; $i++)
                {
                    $html .='<ul><li>'.$res4['data'][$i]['id'].'</li>';
                    $html .='<p>'.$res4['data'][$i]['text'].'</p></ul>'; 
                }
            }
        }
        echo $html;
        echo'<hr>';
    }

    echo renderTweets();
    echo renderTweets("narendramodi",7);
    echo renderTweets("narendramodi",11);
    ?>
</body>
</html>
