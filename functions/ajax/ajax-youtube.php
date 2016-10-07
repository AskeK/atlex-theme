<?php

add_action( 'wp_ajax_video_upload', 'smamo_yt_upload' );

function smamo_yt_upload(){
    $response = array();
    require_once get_template_directory() . '/Google/Client.php';
    require_once get_template_directory() . '/Google/Service/YouTube.php';

    session_start();


    $OAUTH2_CLIENT_ID = '713090362096-tqsc0sardi6tv5vpofd5vggugeclvdap.apps.googleusercontent.com';
    $OAUTH2_CLIENT_SECRET = '64DQ_zBfROG6_2BDid4S7KB3';

    $client = new Google_Client();
    $client->setClientId($OAUTH2_CLIENT_ID);
    $client->setClientSecret($OAUTH2_CLIENT_SECRET);
    $client->setScopes('https://www.googleapis.com/auth/youtube');
    $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
    $client->setRedirectUri($redirect);

    // Define an object that will be used to make all API requests.
    $youtube = new Google_Service_YouTube($client);

    if (isset($_GET['code'])) {
      if (strval($_SESSION['state']) !== strval($_GET['state'])) {
        die('The session state did not match.');
      }

      $client->authenticate($_GET['code']);
      $_SESSION['token'] = $client->getAccessToken();
      header('Location: ' . $redirect);
    }

    if (isset($_SESSION['token'])) {
      $client->setAccessToken($_SESSION['token']);
    }

    // Check to ensure that the access token was successfully acquired.
    if ($client->getAccessToken()) {
      try{
        // REPLACE this value with the path to the file you are uploading.
        $videoPath = "/path/to/file.mp4";

        // Create a snippet with title, description, tags and category ID
        // Create an asset resource and set its snippet metadata and type.
        // This example sets the video's title, description, keyword tags, and
        // video category.
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle("Test title");


        // Set the video's status to "public". Valid statuses are "public",
        // "private" and "unlisted".
        $status = new Google_Service_YouTube_VideoStatus();
        $status->privacyStatus = "unlisted";

        // Associate the snippet and status objects with a new video resource.
        $video = new Google_Service_YouTube_Video();
        $video->setSnippet($snippet);
        $video->setStatus($status);

        // Specify the size of each chunk of data, in bytes. Set a higher value for
        // reliable connection as fewer chunks lead to faster uploads. Set a lower
        // value for better recovery on less reliable connections.
        $chunkSizeBytes = 1 * 1024 * 1024;

        // Setting the defer flag to true tells the client to return a request which can be called
        // with ->execute(); instead of making the API call immediately.
        $client->setDefer(true);

        // Create a request for the API's videos.insert method to create and upload the video.
        $insertRequest = $youtube->videos->insert("status, snippet", $video);

        // Create a MediaFileUpload object for resumable uploads.
        $media = new Google_Http_MediaFileUpload(
            $client,
            $insertRequest,
            'video/*',
            null,
            true,
            $chunkSizeBytes
        );
        $media->setFileSize(filesize($videoPath));


        // Read the media file and upload it chunk by chunk.
        $status = false;
        $handle = fopen($videoPath, "rb");
        while (!$status && !feof($handle)) {
          $chunk = fread($handle, $chunkSizeBytes);
          $status = $media->nextChunk($chunk);
        }

        fclose($handle);

        // If you want to make other calls after the file upload, set setDefer back to false
        $client->setDefer(false);


        $htmlBody .= "<h3>Video Uploaded</h3><ul>";
        $htmlBody .= sprintf('<li>%s (%s)</li>',
            $status['snippet']['title'],
            $status['id']);

        $htmlBody .= '</ul>';

      } catch (Google_Service_Exception $e) {
        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage()));
      } catch (Google_Exception $e) {
        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
            htmlspecialchars($e->getMessage()));
      }

      $_SESSION['token'] = $client->getAccessToken();
    } else {
      // If the user hasn't authorized the app, initiate the OAuth flow
      $state = mt_rand();
      $client->setState($state);
      $_SESSION['state'] = $state;

      $authUrl = $client->createAuthUrl();
      $htmlBody = <<<END
      <h3>Authorization Required</h3>
      <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
    END;
    }
}
