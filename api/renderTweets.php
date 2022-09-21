<?php
    require_once("userTweet.php");

    function renderTweets($handel = "imVkohli", $no_of_tweets = 5) {
        $twitter_api = new TwitterAPI();
        $twitter_response = $twitter_api->getTweets($handel);

        $html = getHTML($twitter_response, $no_of_tweets);

        echo $html;
        echo'<hr>';
    }

    function getHTML($twitter_response, $no_of_tweets) {
        $html = '';

        if($no_of_tweets>10){
            $html .='<h1 style="color:red;">No of tweets shoud be less than 11</h1>';
        } else{
            if($no_of_tweets == 5){
                for($i=0; $i<5; $i++)
                {
                    $html .='<ul><li>'.$twitter_response['data'][$i]['id'].'</li>';
                    $html .='<p>'.$twitter_response['data'][$i]['text'].'</p></ul>';
                }
            } else{
                for($i=0; $i<$no_of_tweets; $i++)
                {
                    $html .='<ul><li>'.$twitter_response['data'][$i]['id'].'</li>';
                    $html .='<p>'.$twitter_response['data'][$i]['text'].'</p></ul>'; 
                }
            }
        }
        return $html;
    }
    ?>