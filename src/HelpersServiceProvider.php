<?php
namespace Sonar\Common;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    private $filesystem;

    public function __construct($app, Filesystem $file = null)
    {
        parent::__construct($app);

        $this->filesystem = $file ? $file : new Filesystem;
    }
    public function register()
    {
        foreach ($this->filesystem->allFiles(__DIR__ . '/Helpers') as $rec) {
            if (preg_match("/\.php$/", $rec->getFilename())) {
                require_once($rec->getPathname());
            }
        }
    }
}
