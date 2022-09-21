<?php
require_once("utility.php");

class TwitterAPI{
    
    public function getTweets($handel = "imVkohli"){
        $url_name = "https://api.twitter.com/2/users/by?usernames=".$handel."&user.fields=created_at&expansions=pinned_tweet_id&tweet.fields=author_id,created_at";
        $ch_session = curl_init();
        curl_setopt($ch_session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_session, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer AAAAAAAAAAAAAAAAAAAAAGyRhAEAAAAAWJsG8OJonhgIrPNFaudb%2Fm7PqC0%3DWN77wad5uh5R81n9Cq8LGBpPwncD2haLKfiK4utt3nCSNCSH7P'
        ));
        curl_setopt($ch_session, CURLOPT_URL, $url_name);
        // To get the user id
        $result_url = curl_exec($ch_session);
        $res = objectToArray(json_decode($result_url));
        $id = $res['data']['0']['id'];

        // To get the user tweet data
        $url_tweet = "https://api.twitter.com/2/users/".$id."/tweets";
        curl_setopt($ch_session, CURLOPT_URL, $url_tweet);
        $result_tweet = curl_exec($ch_session);
        $res1 = objectToArray(json_decode($result_tweet));

        return $res1;
    }
}
?>