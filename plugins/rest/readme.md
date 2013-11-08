
CakePHP REST Plugin takes whatever your existing controller actions gather
in viewvars, reformats it in json or xml, and outputs it to the client.
Because you hook it into existing actions, you only have to write your
features once, and this plugin will just unlock them as API.
The plugin knows it's being called by looking at the extension in the url: .json or .xml.

So if you've already coded:

 - /servers/reboot/2

You can have

- /servers/reboot/2.json
- /servers/reboot/2.xml

up & running in no time.

CakePHP REST Plugin can even change the structure of your existing viewvars
using bi-directional xpaths. This way you can extract info using an xpath, and
output it to your API clients using another xpath. If this doesn't make any
sense, please have a look at the examples.

You attach the Rest.Rest component to a controller, but you can limit REST
activity to a single action.

For best results, 2 changes to your application have to be made.

  1 A check for REST in errors & redirects
  2 Resource mapping in your router


Compatible with:

 - CakePHP 1.2
 - CakePHP 1.3

Like this plugin? Consider [a small donation](https://flattr.com/thing/68756/cakephp-rest-plugin)

Based on:

- [Priminister's API presentation during CakeFest #03, Berlin][1]
- [The help of Jonathan Dalrymple][2]
- [REST documentation][3]
- [CakeDC article][4]

  [1]: http://www.cake-toppings.com/2009/07/15/cakefest-berlin/
  [2]: http://github.com/veritech
  [3]: http://book.cakephp.org/view/476/REST
  [4]: http://cakedc.com/eng/developer/mark_story/2008/12/02/nate-abele-restful-cakephp

I held a presentation on this plugin during the first Dutch CakePHP meetup:

- [REST presentation at slideshare][5]

  [5]: http://www.slideshare.net/kevinvz/rest-presentation-2901872


Todo:

 - More testing
 - DONE - Cake 1.3 support
 - DONE - The RestLog model that tracks usage should focus more on IP for rate-limiting
   than account info. This is mostly to defend against denial of server & brute
   force attempts
 - DONE - Maybe some Refactoring. This is pretty much the first attempt at a working plugin
 - DONE (thx to Jonathan Dalrymple) - XML (now only JSON is supported)

License: BSD-style

# Installation

## As a git submodule

    git submodule add git://github.com/kvz/cakephp-rest-plugin.git app/plugins/rest
    git submodule update --init

## Other

Just place the files directly under: `app/plugins/rest`

## .htaccess

Do you run Apache? Make your `app/webroot/.htaccess` look like so:

    <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

	    # Adds AUTH support to Rest Plugin:
        RewriteRule .* - [env=HTTP_AUTHORIZATION:%{HTTP:Authorization},last]
    </IfModule>

In my experience Nginx & FastCGI already make the HTTP_AUTHORIZATION available
which is used to parse credentials for authentication.

# Implementation

## Controller

Beware that you can no longer use ->render() yourself

```php
    <?php
    class ServersController extends AppController {
        public $components = array(
            'RequestHandler',
            'Rest.Rest' => array(
                'debug' => 0,
                'view' => array(
                    'extract' => array('server.Server' => 'servers.0'),
                ),
                'index' => array(
                    'extract' => array('rows.{n}.Server' => 'servers'),
                ),
            ),
        );

        /**
         * Shortcut so you can check in your Controllers wether
         * REST Component is currently active.
         *
         * Use it in your ->redirect() and ->flash() methods
         * to forward errors to REST with e.g. $this->Rest->error()
         *
         * @return boolean
         */
        protected function _isRest() {
            return !empty($this->Rest) && is_object($this->Rest) && $this->Rest->isActive();
        }

        public function redirect($url, $status = null, $exit = true) {
            if ($this->_isRest()) {
                // Just don't redirect.. Let REST die gracefully
                // Do set the HTTP code though
                parent::redirect(null, $status, false);
				$redirect = true;
				$this->Rest->abort(compact('url', 'status', 'exit', 'redirect'));
            }

            parent::redirect($url, $status, $exit);
        }
    }
    ?>
```

`extract` extracts variables you have in: `$this->viewVars`
and makes them available in the resulting XML or JSON under
the name you specify in the value part.

Here's a more simple example of how you would use the viewVar `tweets` **as-is**:

```php
	<?php
	class TweetsController extends AppController {
		public $components = array (
			'Rest.Rest' => array(
				'index' => array(
					'extract' => array('tweets'),
				),
			),
		);

		public function index() {
			$tweets = $this->_getTweets();
			$this->set(compact('tweets'));
		}
    }
```

And when asked for the xml version, Rest Plugin would return this to your clients:

```xml
	<?xml version="1.0" encoding="utf-8"?>
	<tweets_response>
	  <meta>
		<status>ok</status>
		<feedback>
		  <item>
			<message>ok</message>
			<level>info</level>
		  </item>
		</feedback>
		<request>
		  <request_method>GET</request_method>
		  <request_uri>/tweets/index.xml</request_uri>
		  <server_protocol>HTTP/1.1</server_protocol>
		  <remote_addr>123.123.123.123</remote_addr>
		  <server_addr>123.123.123.123</server_addr>
		  <http_host>www.example.com</http_host>
		  <http_user_agent>My API Client 1.0</http_user_agent>
		  <request_time/>
		</request>
		<credentials>
		  <class/>
		  <apikey/>
		  <username/>
		</credentials>
	  </meta>
	  <data>
		<tweets>
		  <item>
			<tweet_id>123</tweet_id>
			<message>looking forward to the finals!</message>
		  </item>
		  <item>
			<tweet_id>123</tweet_id>
			<message>i need a drink</message>
		  </item>
		</tweets>
	  </data>
	</tweets_response>
```

As you can see, the controller name + response is always the root element (for json there is no root element).
Then the content is divived in `meta` & `data`, and the latter is where your actual viewvars are stored.
Meta is there to show any information regarding the validity of the request & response.

## Authorization

Check the HTTP header as shown here: http://docs.amazonwebservices.com/AmazonS3/2006-03-01/index.html?RESTAuthentication.html
You can control the `authKeyword` setting to control what keyword belongs to
your REST API. By default it uses: TRUEREST. Have your users supply a header like:
`Authorization: TRUEREST username=john&password=xxx&apikey=247b5a2f72df375279573f2746686daa`

Now, inside your controller these variables will be available by calling
`$this->Rest->credentials()`.
This plugin only handles the parsing of the header, and passes the info on to your app.
So login anyone with e.g. `$this->Auth->login()` and the information you retrieved from `$this->Rest->credentials()`;

Example:

```php
    public function beforeFilter () {
		if (!$this->Auth->user()) {
			// Try to login user via REST
			if ($this->Rest->isActive()) {
				$this->Auth->autoRedirect = false;
				$data = array(
				    $this->Auth->userModel => array(
				        'username' => $credentials['username'],
				        'password' => $credentials['password'],
				    ),
				);
				$data = $this->Auth->hashPasswords($data);
				if (!$this->Auth->login($data)) {
				    $msg = sprintf('Unable to log you in with the supplied credentials. ');
				    return $this->Rest->abort(array('status' => '403', 'error' => $msg));
				}
			}
		}
		parent::beforeFilter();
	}
```

## Router

```php
    // Add an element for each controller that you want to open up
    // in the REST API
    Router::mapResources(array('servers'));

    // Add XML + JSON to your parseExtensions
    Router::parseExtensions('rss', 'json', 'xml', 'json', 'pdf');
```

## Callbacks

If you're using the built-in ratelimiter, you may still want a little control yourself.
I provide that in the form of 4 callbacks:

```php
    public function restlogBeforeSave ($Rest) {}
    public function restlogAfterSave ($Rest) {}
    public function restlogBeforeFind ($Rest) {}
    public function restlogAfterFind ($Rest) {}
```

That will be called in you AppController if they exists.

You may want to give a specific user a specific ratelimit. In that case you can use
the following callback in your User Model:

```php
    public function restRatelimitMax ($Rest, $credentials = array()) { }
```

And for that user the return value of the callback will be used instead of the general
class limit you could have specified in the settings.

### Customizing callback

You can map callbacks to different places using the `callbacks` setting like so:

```php
    <?php
    class ServersController extends AppController {
        public $components = array(
            'Rest.Rest' => array(
                'callbacks' => array(
                    'cbRestlogBeforeSave' => 'restlogBeforeSave',
                    'cbRestlogAfterSave' => 'restlogAfterSave',
                    'cbRestlogBeforeFind' => 'restlogBeforeFind',
                    'cbRestlogAfterFind' => array('Common', 'setCache'),
                    'cbRestRatelimitMax' => 'restRatelimitMax',
                ),
            ),
        );
    }
```

If the resolved callback is a string we assume it's a method in the calling controller.
