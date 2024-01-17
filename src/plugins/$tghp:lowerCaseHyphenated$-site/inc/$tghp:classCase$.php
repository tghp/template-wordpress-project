<?php

namespace TGHP\$tghp:classCase$;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class $tghp:classCase$
{

    /** =====================================================================================================
     * Sub-class properties
     * ======================================================================================================
     */

    /**
     * Definers
     */

    /** @var PostType */
    public $postType;

    /** @var Taxonomy */
    public $taxonomy;

    /** @var Metaboxio\Metabox */
    public $metabox;

    /** @var Metaboxio\Block */
    public $block;

    /** @var Metaboxio\Form */
    public $form;

    /**
     * Theme specific
     */

    /** @var ThemeSupports */
    public $themeSupports;

    /** @var Page */
    public $page;

    /** @var Menu */
    public $menu;

    /** @var Enqueues */
    public $enqueues;

    /**
     * Admin
     */

    /** @var Admin */
    public $admin;

    /**
     * Utilities
     */

    /** @var Asset */
    public $asset;

    /** @var Util */
    public $util;

    /**
     * Development / Workflow
     */

    /** @var Dev */
    public $dev;

    /**
     * $tghp:standard$ Specific
     */

    // Class properties here

    /** =====================================================================================================
     * Class methods and non-sub-class properties
     * ======================================================================================================
     */

    /**
     * $tghp:classCase$ constructor.
     */
    public function __construct()
    {
        /**
         * Setup
         */
        $this->setupLogging();
        spl_autoload_register([$this, 'autoload']);

        /**
         * Class property initialisation
         */
        // Definers
        $this->postType = new PostType($this);
        $this->taxonomy = new Taxonomy($this);
        $this->metabox = new Metaboxio\Metabox($this);
        $this->block = new Metaboxio\Block($this);
        $this->form = new Metaboxio\Form($this);

        // Theme specific
        $this->themeSupports = new ThemeSupports($this);
        $this->page = new Page($this);
        $this->menu = new Menu($this);
        $this->enqueues = new Enqueues($this);

        // Admin
        $this->admin = new Admin($this);

        // Utilities
        $this->asset = new Asset($this);
        $this->util = new Util($this);

        // Development / Workflow
        $this->dev = new Dev($this);

        // $tghp:standard$ Specific
        // Class property initialisation here
    }

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Is logging allowed
     *
     * @var bool
     */
    protected $logging = false;

    /**
     * The single instance of the class.
     *
     * @var $tghp:classCase$
     */
    protected static $_instance = null;

    /**
     * Main $tghp:classCase$ Instance.
     *
     * Ensures only one instance of $tghp:classCase$ is loaded or can be loaded.
     *
     * @return $tghp:classCase$
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();

            do_action('$tghp:lowerCaseHyphenated$-site_init');
        }

        return self::$_instance;
    }

   /**
    * Set up logging
    *
    * @return void
    */
   private function setupLogging(): void
   {
       $loggerFilePath = WP_CONTENT_DIR . '/log/tghp-$tghp:lowerCaseHyphenated$-site/';
       $filename = 'debug.log';

       if (!is_dir($loggerFilePath) && is_writable(WP_CONTENT_DIR)) {
           mkdir($loggerFilePath, 0777, true);
       }

       if (is_dir($loggerFilePath) && is_writable($loggerFilePath)) {
           $this->logging = true;
           $logger = new Logger(self::getPluginName());
           $logger->pushHandler(new StreamHandler($loggerFilePath . $filename));
           $this->logger = $logger;
       }
   }

   /**
    * Add message to log
    *
    * @param int $level
    * @param string $message
    * @param array $context
    * @return void
    */
   public function addLog(int $level, string $message, array $context = []): void
   {
       if ($this->logging) {
           $this->logger->addRecord($level, $message, $context);
       }
   }

   /**
    * Autoload additional classes
    *
    * @param $className
    * @return void
    */
   public function autoload($className): void
   {
       $namespace = __NAMESPACE__;
       $namespaceCount = count(explode('\\', $namespace));

       $classNamespace = array_slice(explode('\\', $className), 0, $namespaceCount);
       $classNamespace = implode('\\', $classNamespace);

       if ($classNamespace !== $namespace) {
           return;
       }

       $className = str_replace($namespace . '\\', '', $className);
       $classParts = explode('\\', $className);
       $file = __DIR__ . '/' . implode('/', $classParts) . '.php';

       if (file_exists($file)) {
           include_once($file);
       } else {
           $this->addLog(Logger::ERROR, 'Unable to include file: ' . $file);
       }
   }

   /**
    * Get plugin name
    *
    * @return string
    */
   public static function getPluginName(): string
   {
       return constant('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_NAME');
   }

   /**
    * Get text domain
    *
    * @return string
    */
   public static function getTextDomain(): string
   {
       return self::getPluginName();
   }

   /**
    * Get plugin path
    *
    * @return string
    */
   public static function getPluginPath(): string
   {
       return constant('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_PATH');
   }

   /**
    * Get plugin url
    *
    * @return string
    */
   public static function getPluginUrl(): string
   {
       return constant('TGHP_$tghp:upperCaseUnderscored$_PLUGIN_URL');
   }

}