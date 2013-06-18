AvTwitterPosterBundle
=====================

Description:
=

This bundle allow you to post a twitt each time you want !


Installation :
=

Add this line in your composer.json :

    "appventus/twitter-poster-bundle": "dev-master",

Configuration :
=

    parameters:
        twitter_api.consumer_key: xxx
        twitter_api.consumer_secret: xxx
        twitter_api.oauth_token: xxx
        twitter_api.oauth_token_secret: xxx
        
        
Usage :
=

To tweet, just call the twitter manager and tweet. It's as easy !

    $this->get('twitter_manager')->tweet($message);
    
