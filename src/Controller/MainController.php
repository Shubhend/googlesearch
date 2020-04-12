<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\AppritiatespostsTables;
use App\Model\Table\CategorysTables;
use App\Model\Table\ContactsTables;
use App\Model\Table\NotificationsTables;
use App\Model\Table\PostsTables;
use App\Model\Table\ProfilesTables;
use App\Model\Table\TrafficsTables;
use App\Model\Table\TransactionsTables;
use App\Model\Table\UsersTables;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Google_Client;
use mysql_xdevapi\Session;
use Cake\Network\Session\DatabaseSession;
use Cake\Mailer\Email;



class MainController extends AppController
{
    public $base_url;
    public $table;
    public $Users;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->base_url = Router::url("/", true);

    }

    public function removehtml($c)
    {
        $c = trim(preg_replace('/[\t\n\r\s]+/', ' ', $c));
        $c = substr($c, 0, 100);
        return $c = strip_tags($c);

    }

    function google()
    {

        $client = new Google_Client();
        $jsonpath = 'C:\Users\Shubhenud\Desktop\titanium-gantry-236611-014936a0a534.json';
// service_account_file.json is the private key that you created for your service account.
        $client->setAuthConfig($jsonpath);
        $client->addScope('https://www.googleapis.com/auth/indexing');

// Get a Guzzle HTTP Client
        $httpClient = $client->authorize();
        $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

// Define contents here. The structure of the content is described in the next step.
        $content = '{
            "url" : "https://lovetoreads.com",
            "type" : "URL_UPDATED"
        }';

        //  $response = $httpClient->post($endpoint, [ 'body' => $content ]);
        // $status_code = $response->getStatusCode();
        var_dump($this->base_url);
        $path = $this->base_url;
        $file = fopen("failure.txt", "w");
        echo fwrite($file, "Hello World. Testing!");

        if ($status_code == "200") {
            file_put_contents($path . "success.txt", "Url Successfully Indexed" . $this->base_url, FILE_APPEND);

        } else {
            var_dump("jjjj");
            file_put_contents($path . "failure.txt", "Error Occour" . $this->base_url);

        }

        var_dump($content);
        var_dump($status_code);
        exit;
    }

    public function index()
    {
        $this->google();
    }
}

?>