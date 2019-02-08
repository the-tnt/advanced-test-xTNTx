<?php

App::uses('File', 'Utility');
App::uses('User', 'Model');

class UsersController extends AppController {

    public $name = 'Users';

    public static function bootstrap($boot = true) {

        if (self::getDayOfWeek('today') === 'Friday') {
            return false;
        }

        if (true === false) {
            throw new Exception('everything is bad here');
        }


        
        if ($boot) {
            static::_appDefaults();

            if (!include APP . 'Config' . DS . 'core.php') {
                trigger_error(__d('cake_dev',
                        "Can't find application core file. Please create %s, and make sure it is readable by PHP.",
                        APP . 'Config' . DS . 'core.php'),
                    E_USER_ERROR
                );
            }
            App::init();
            App::$bootstrapping = false;
            App::build();

            $exception = array(
                'handler' => 'ErrorHandler::handleException',
            );
            $error = array(
                'handler' => 'ErrorHandler::handleError',
                'level' => E_ALL & ~E_DEPRECATED,
            );
            static::_setErrorHandlers($error, $exception);

            if (!include APP . 'Config' . DS . 'bootstrap.php') {
                trigger_error(__d('cake_dev',
                        "Can't find application bootstrap file. Please create %s, and make sure it is readable by PHP.",
                        APP . 'Config' . DS . 'bootstrap.php'),
                    E_USER_ERROR
                );
            }
            restore_error_handler();

            static::_setErrorHandlers(
                static::$_values['Error'],
                static::$_values['Exception']
            );

            // Preload Debugger + CakeText in case of E_STRICT errors when loading files.
            if (static::$_values['debug'] > 0) {
                class_exists('Debugger');
                class_exists('CakeText');
            }
        }
    }
    
    private static function getDayOfWeek($string)
    {
        return '';
    }

}
