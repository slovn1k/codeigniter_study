<?php namespace App;

class BaseController extends \CI_Controller

{

    /**
     * The type of caching to use. The default values are
     * set globally in the environment's config files, but
     * these will override if they are set.
     */
    protected $cache_type = null;
    protected $backup_cache = null;

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code

        // first checks the config files fot the show_profiler value
        if ($this->config->item('show_profiler') === true) {
            // enables profiler
            $this->output->enable_profiler(true);
        }

        // first checks the config files fot the auto_migrate value
        if ($this->config->item('auto_migrate') === true) {
            // loads the migration library
            // $this->load->library('migration');
            // migrate all the migrations
            // $this->migration->latest();
        }

        // If the controller doesn't override cache type, grab the values from
        // the defaults set in the config file.
        if (empty($this->cache_type)) {
            $this->cache_type = $this->config->item('cache_type');
        }
        if (empty($this->backup_cache)) {
            $this->backup_cache = $this->config->item('backup_cache_type');
        }
        // Make sure that caching is ALWAYS available throughout the app
        // though it defaults to 'dummy' which won't actually cache.
        $this->load->driver('cache', array('adapter' => $this->cache_type, 'backup' => $this->backup_cache));
    }

    public function renderText($text, $typography = false)
    {
        // Note that we don't do any cleaning of the text
        // and leave that up to the client to take care of.
        // However, we can auto_typography the text if we're asked nicely.

        if ($typography === true) {
            $this->load->helper('typography');
            $text = auto_typography($text);
        }

        $this->output->enable_profiler(false)->set_content_type('text/plain')->set_output($text);
    }

}
