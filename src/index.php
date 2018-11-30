<?php

/**
 * Class IDNentity
 */
class IDNentity
{

    /**
     * @var string
     */
    protected $webRoot;

    /**
     * @var string
     */
    protected $aboveWebRoot;

    /**
     * Possible CMS and Framework files to search for.
     *
     * @var array
     */
    protected $possibleCmsAndFrameworkFiles = array(
        'webroot' => array(
            'typo3conf/localconf.php', // < TYPO3 6.0
            'typo3conf/LocalConfiguration.php', // >= TYPO3 6.0
            'typo3conf/PackageStates.php', // >= TYPO3 6.2
            'config/global.php', // PIWIK
            'wp-includes/version.php', // WordPress
        ),
        'aboveWebroot' => array(
            'composer.json', // Composer powered frameworks
        )
    );

    /**
     * IDNetity constructor.
     */
    public function __construct()
    {
        $this->webRoot = realpath('.') . '/';
        $this->aboveWebRoot = dirname($this->webRoot) . '/';
    }

    /**
     * Identify.
     *
     * @return array
     */
    public function identify()
    {
        echo '<pre>' . print_r($this, 1) . '</pre>';
        die();
        $this->parseComposerJson();
    }

    private function parseComposerJson()
    {
        // Check for composer.json file
        if (file_exists('../composer.json') === true
            && is_readable('../composer.json') === true
        ) {
            $composerJson = json_decode(file_get_contents('../composer.json'));
        }
    }

}

echo json_encode((new IDNentity())->identify());
