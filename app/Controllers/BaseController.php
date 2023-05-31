<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\M_Base;
use App\Models\LevelModel;
use App\Models\LevelUpgradeModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\PriceModel;
use App\Models\OrderModel;
use App\Models\TopUpModel;
use App\Models\GameModel;
use App\Models\GamePopulerModel;
use App\Models\MethodModel;
use App\Models\WhatsappModel;
use App\Models\history_model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller {

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['utility'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->agent = $this->request->getUserAgent();

        $this->M_Base = new M_Base;
        $this->MUser = new UserModel;
        $this->MLevel = new LevelModel;
        $this->MLevelUp = new LevelUpgradeModel;
        $this->MProduct = new ProductModel;
        $this->MPrice = new PriceModel;
        $this->MOrder = new OrderModel;
        $this->MTopUp = new TopUpModel;
        $this->MGame = new GameModel;
        $this->MGamePop = new GamePopulerModel;
        $this->MMethod = new MethodModel;
        $this->MWa = new WhatsappModel;
        $this->Mhistory = new history_model;

        $this->tripay_base = 'https://tripay.co.id/api/';
        $this->ipaymu_base = 'https://my.ipaymu.com/';
        $this->ipaymu_notify = base_url() . '/sistem/callback/ipaymu';

        if (preg_match("/webzip|httrack|wget|FlickBot|downloader|production
        bot|superbot|PersonaPilot|NPBot|WebCopier|vayala|imagefetch|
        Microsoft URL Control|mac finder|
        emailreaper|emailsiphon|emailwolf|emailmagnet|emailsweeper|
        Indy Library|FrontPage|cherry picker|WebCopier|netzip|
        Share Program|TurnitinBot|full web bot|zeus/i", $this->agent->getAgentString())) {
            die('- Sttt...');
        }

        $this->admin = false;

        if ($this->session->get('admin')) {
            $admin = $this->M_Base->data_where('admin', 'username', $this->session->get('admin'));

            if (count($admin) == 1) {
                if ($admin[0]['status'] == 'On') {
                    $this->admin = $admin[0];
                }
            }
        }

        $this->users = false;

        if ($this->session->get('username')) {
            $users = $this->M_Base->data_where('users', 'username', $this->session->get('username'));

            if (count($users) == 1) {
                if ($users[0]['status'] == 'On') {
                    $this->users = $users[0];
                }
            }
        }

        $this->base_data = [
            'users' => $this->users,
            'admin' => $this->admin,
            'web' => [
                'title' => $this->M_Base->u_get('web-title'),
                'name' => $this->M_Base->u_get('web-name'),
                'logo' => $this->M_Base->u_get('web-logo'),
                'keywords' => $this->M_Base->u_get('web-keywords'),
                'description' => $this->M_Base->u_get('web-description'),
            ],
            'sm' => [
                'wa' => $this->M_Base->u_get('sm-wa'),
                'yt' => $this->M_Base->u_get('sm-yt'),
                'fb' => $this->M_Base->u_get('sm-fb'),
                'ig' => $this->M_Base->u_get('sm-ig'),
                'tw' => $this->M_Base->u_get('sm-tw'),
            ],
            'menu_active' => 'Home',
            'games_populer' => $this->MGamePop->select('games.games AS name, games.slug, games.image AS image, game_populer.*')->join('games', 'games.id = game_populer.game_id')->findAll(),
            'sosmed' => $this->M_Base->all_data('sosmed'),
        ];
    }
}
