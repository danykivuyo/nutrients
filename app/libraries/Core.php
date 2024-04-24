<?php 

class Core {

    protected $currentController = 'Home';
    protected $currentMethod = 'home';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        if(!isset($url[0]))
        {
            $url[0] = 'Home';
        }
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        require_once('../app/controllers/' . $this->currentController . '.php');
        $this->currentController = new $this->currentController;

        if(isset($url[1]))
        {
            if(method_exists($this->currentController , $url[1]))
            {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $a = 0;
        if(isset($url[2]) & !empty($url[2])){
            unset($url[0]);
            unset($url[1]);
            for($i = 2; $i < 100; $i++){
                if(empty($url)) break;
                $this->params[$a] = $url[$i];
                unset($url[$i]);
                $a++;
            }
        }
        //$this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController , $this->currentMethod] , $this->params);
    }
    public function getUrl ()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'] , '/');
            $url = rtrim($url , '.php');
            $url = rtrim($url , '/');
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode( '/' , $url);
            return $url;
        }
    }
}

?>