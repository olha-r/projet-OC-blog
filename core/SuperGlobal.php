<?php


namespace OC\Blog\Core;


class SuperGlobals
{
    private $_POST;
    private $_GET;
    private $_SESSION;

    public function __construct()
    {
        $this->define_superglobals();
    }

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function get_POST($key = null)
    {
        if (null !== $key) {
            return (isset($this->_POST["$key"])) && !empty($this->_SESSION["$key"]) ? $this->_POST["$key"] : null;
        } else {
            return $this->_POST;
        }
    }

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function get_GET($key = null)
    {
        if (null !== $key) {
            return (isset($this->_GET["$key"])) && !empty($this->_SESSION["$key"]) ? $this->_GET["$key"] : null;
        } else {
            return $this->_GET;
        }
    }

    /**
     * Returns a key from the superglobal,
     * as it was at the time of instantiation.
     *
     * @param $key
     * @return mixed
     */
    public function get_SESSION($key = null)
    {
        if (null !== $key) {
            return (isset($this->_SESSION["$key"])) && !empty($this->_SESSION["$key"]) ? $this->_SESSION["$key"] : null;
        } else {
            return $this->_SESSION;
        }
    }

    /**
     * Function to define superglobals for use locally.
     * We do not automatically unset the superglobals after
     * defining them, since they might be used by other code.
     *
     * @return mixed
     */
    private function define_superglobals()
    {
        // Store a local copy of the PHP superglobals
        // This should avoid dealing with the global scope directly
        // $this->_SERVER = $_SERVER;
        $this->_POST = (isset($_POST)) ? $_POST : null;
        $this->_GET = (isset($_GET)) ? $_GET : null;
        $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null;

    }

    /**
     * You may call this function from your compositioning root,
     * if you are sure superglobals will not be needed by
     * dependencies or outside of your own code.
     *
     * @return void
     */
    public function unset_superglobals()
    {
        unset($this->_POST);
        unset($this->_GET);
        unset($this->_SESSION);
    }
}
