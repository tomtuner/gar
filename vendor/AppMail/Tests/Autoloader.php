<?php

/**
 * Description of Autoloader
 *
 * @author http://jes.st/2011/phpunit-bootstrap-and-autoloading-classes/
 */
class AutoLoader
{

    /**
     * Array of Class Names and File Paths
     * @var array 
     */
    static private $classNames = array();

    /**
     * Store the filename (sans extension) & full path of all ".php" files found
     */
    public static function registerDirectory($dirName)
    {
        $di = new DirectoryIterator($dirName);
        foreach($di as $file)
        {
            if($file->isDir() && !$file->isLink() && !$file->isDot())
            {
                // recurse into directories other than a few special ones
                self::registerDirectory($file->getPathname());
            } elseif(substr($file->getFilename(), -4) === '.php')
            {
                // save the class name / path of a .php file found
                $className = substr($file->getFilename(), 0, -4);
                AutoLoader::registerClass($className, $file->getPathname());
            }
        }
    }

    /**
     * Register Class - Adds Class + Filename to $classNames
     * Array
     * 
     * @param string $className
     * @param string $fileName 
     */
    public static function registerClass($className, $fileName)
    {
        AutoLoader::$classNames[$className] = $fileName;
    }

    /**
     * Load Class Function - Compatible With Namespaced and
     * Non-Namespaced Classes
     * 
     * @param string $className 
     */
    public static function loadClass($className)
    {
       /* 
        * parse any class name that is namespaced (non-namespaced) ones
        * will pass without any issues
        */
       $classNamePieces = explode('\\', $className);
       
       //get the last entry on array which is the classname we need
       $newClassName =  end($classNamePieces);
       
       //require class only if the class is registered
       if(isset(AutoLoader::$classNames[$newClassName]))
       {
           //require class
           require_once(AutoLoader::$classNames[$newClassName]);
       }
    }

}

/**
 * Must Register The Autoload Method 
 */
spl_autoload_register(array('AutoLoader', 'loadClass'));

?>
