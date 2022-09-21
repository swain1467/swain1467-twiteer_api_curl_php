<?php

require_once("utility.php");
require_once("twitter_constants.php");

class TwitterAPI {

    private $curl;

    /**
       Get tweets of a particular user
       Parameters: $handle(String) Twitter User Handle
       Returns: JSON of tweets
    */
    public function getTweets($handle = DEFAULT_HANDLE) {

        $this->initiateCurl();

        $userId = $this->getUserId($handle);
        $userTweets = $this->getUserTweets($userId);

        return $userTweets;
    }

    /**
       Initiate curl object
       Returns: (Object) curl session object
    */
    private function initiateCurl() {

        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . BEARER_TOKEN
        ));
    }

    /**
       Returns Twitter User Id
       Parameters: $curl(Object) curl object, $handle(String) Twitter User Handle
       Returns: (String) Twitter User id
    */
    private function getUserId($handle) {

        $url_name = API_ENDPOINT . "users/by?usernames=".$handle."&user.fields=created_at&expansions=pinned_tweet_id&tweet.fields=author_id,created_at";

        curl_setopt($this->curl, CURLOPT_URL, $url_name);

        $curl_response = curl_exec($this->curl);
        $response_arr = objectToArray(json_decode($curl_response));

        return $response_arr['data']['0']['id'];
    }

    /**
       Get Tweets of a particulate Twitter User
       Parameters: $curl(Object) curl object, $userId(String) Twitter User Handle
       Returns: (Array) User Tweets
    */
    private function getUserTweets($userId) {

        $url_tweet = API_ENDPOINT . "users/".$userId."/tweets";
        curl_setopt($this->curl, CURLOPT_URL, $url_tweet);

        $result_tweet = curl_exec($this->curl);
        $result_tweet_arr = objectToArray(json_decode($result_tweet));

        return $result_tweet_arr;
    }
}

?>