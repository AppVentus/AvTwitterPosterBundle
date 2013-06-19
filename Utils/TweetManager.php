<?php
namespace AppVentus\Awesome\AvTwitterPosterBundle\Utils;


class TweetManager {

protected $twitterOAuth;
  /**
   * construct TweetManager
   */
  function __construct($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL) {
  	$this->twitterOAuth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
  }

  public function shortifyMessage($message){

            $reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
            preg_match_all($reg_exUrl, $message, $matches);
            $usedPatterns = array();
            foreach($matches[0] as $pattern){
                if(!array_key_exists($pattern, $usedPatterns)){
                    $usedPatterns[$pattern]=true;
					$shortenUrl = $this->shortifyUrl($pattern);
                    $message = str_replace  ($pattern, $shortenUrl, $message);
                }
            }
            return $message;
  }
  public function shortifyUrl($url){
		$ch = curl_init();
		    $timeout = 5;
		    curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url='.$url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		    $data = curl_exec($ch);
		    curl_close($ch);
        if($data=="Error"){
          $data = '';
        }
		    return ''.$data.'';
  }

/**
 * Modifies a string to remove al non ASCII characters and spaces.
 */
  static public function hashtagify($text)
  {
      $text = str_replace('-', ' ', $text);
      $text = ucwords($text);
      $text = str_replace(' ', '', $text);
      $text = str_replace(array(',',';','/'), ' #', $text);

      return "#".$text;
  }


  public function tweet($message){
  	// $message = $this->shortifyMessage($message);
  	$this->twitterOAuth->post('statuses/update', array('status' => $message));
  }

}
