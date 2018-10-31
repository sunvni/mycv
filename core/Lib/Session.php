<?php
namespace Core\Lib;


class Session
{
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;
    
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
    
    // THE only instance of the class
    private static $instance;


    public function __construct()
    {
        $this->startSession();
    }


    /**
     * Returns THE instance of 'Session'.
     * The session is automatically initialized if it wasn't.
     *    
     * @return object
     **/

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }

        self::$instance->startSession();

        return self::$instance;
    }


    /**
     * (Re)starts the session.
     *    
     * @return bool TRUE if the session has been initialized, else FALSE.
     **/

    public function startSession()
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }

        return $this->sessionState;
    }


    /**
     * Stores datas in the session.
     * Example: $instance->set(foo,'bar');
     *    
     * @param  name Name of the datas.
     * @param  value Your datas.
     * 
     * @return void
     **/

    public function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }


    /**
     *    Gets datas from the session.
     *    Example: echo $instance->foo;
     *    
     *    @param  name Name of the datas to get.
     *    @return mixed Datas stored in session.
     **/

    public function get($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }


    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }


    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }


    /**
     * Destroys the current session.
     *    
     * @return bool TRUE is session has been deleted, else FALSE.
     **/

    public function destroy()
    {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);

            return !$this->sessionState;
        }

        return false;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }
}
