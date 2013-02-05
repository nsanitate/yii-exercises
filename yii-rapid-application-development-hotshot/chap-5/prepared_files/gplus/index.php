<?php 
Yii::import('application.vendors.*');
require_once 'google-api-php-client/src/apiClient.php';
require_once 'google-api-php-client/src/contrib/apiPlusService.php';
$this->breadcrumbs=array(
	'gpf',
);
$session = new CHttpSession;
$session->open();

$client = new apiClient();
$client->setApplicationName("Google+ Comic Book News Feed");
// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
$client->setClientId('CLIENT_ID');
$client->setClientSecret('CLIENT_SECRET');
$client->setRedirectUri('http://localhost/cbdb/index.php/gpf/index');
$client->setDeveloperKey('DEVELOPER_KEY');
$plus = new apiPlusService($client);

if (isset($_REQUEST['logout'])) {
	unset($session['access_token']);
}

if (isset($_GET['code'])) {
	$client->authenticate();
	$session['access_token'] = $client->getAccessToken();
	header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($session['access_token'])) {
	$client->setAccessToken($session['access_token']);
}

if ($client->getAccessToken()) {
	$me = $plus->people->get('me');

	// These fields are currently filtered through the PHP sanitize filters.
	// See http://www.php.net/manual/en/filter.filters.sanitize.php
	$url = filter_var($me['url'], FILTER_VALIDATE_URL);
	$img = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
	$name = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	$optParams = array('maxResults' => 100);
	$activities = $plus->activities->search('#comicbooks');
	$activityMarkup = '';
	foreach($activities['items'] as $activity) {
		// These fields are currently filtered through the PHP sanitize filters.
		// See http://www.php.net/manual/en/filter.filters.sanitize.php
		$url = filter_var($activity['url'], FILTER_VALIDATE_URL);
		$title = filter_var($activity['title'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		//$content = filter_var($activity['object']['content'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$content = $activity['object']['content'];
		$img = '';
		if (isset($activity['object']['attachments'])) {
			foreach($activity['object']['attachments'] as $attachment) {
				if ($attachment['objectType'] === 'photo') {
					$img .= '<img src="' . $attachment['image']['url'] . '">';
				} 
			}
		}	
		$activityMarkup .= "<div class='activity'><a href='$url'>$title</a><div>$content</div><div>$img</div><div><center><img src='" . Yii::app()->request->baseUrl ."/images/hdiv.png' /></center></div>";
	}

	// The access token may have been updated lazily.
	$session['access_token'] = $client->getAccessToken();
} 
else {
	$authUrl = $client->createAuthUrl();
}
?>
<h1>Google+ Comic Book News Feed</h1>
<div class="box">

<?php if(isset($activityMarkup)): ?>
<div class="activities"><h2>Your personal comic book news feed: </h2><?php print $activityMarkup ?></div>
<?php endif ?>

<?php
if(isset($authUrl)) {
	print "<a class='login' href='$authUrl'>Connect Me!</a>";
} 
else {
	print "<a class='logout' href='?logout'>Logout</a>";
}
?>
</div>
