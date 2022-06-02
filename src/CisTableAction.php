<?php
namespace CisFoundation\CisTableBuilder;

use CisFoundation\CisTableBuilder\Exception\MethodNotFoundException;
use Illuminate\Support\Facades\Route;

class CisTableAction {

    /**
     * Link name of the action
     *
     * @var string
     */
    public $name;

    /**
     * Route name
     *
     * @var string
     */
    public $route;

    /**
     * Parameters for the route
     *
     * @var array
     */
    public $parameters;

    /**
     * Method of the link [post,get]
     *
     * @var string
     */
    public $method;


    /**
     * Setting default vars
     */
    public function __construct()
    {
        $this->parameters = [];
    }

    /**
     * Returns the final link for the action
     *
     * @param mixed $data
     * @return string
     */
    public function getLink($data) {
        if($this->method == 'get') {
            return '<a href="'.$this->getUrl($data).'">'.$this->name.'</a>';
        }
        elseif($this->method == 'post') {
            return '<form action="'.$this->getUrl($data).'"><a href="#submit" onclick="this.parentNode.submit()">'.$this->name.'</a></form>';
        }
        else {
            throw new MethodNotFoundException('The Url-Method "'.$this->method.'" did not exist.');
        }
    }

    /**
     * Generates the url for the action
     *
     * @param mixed $data
     * @return Route
     */
    private function getUrl($data) {

        if(count($this->parameters)) {
            foreach($this->parameters as $key => $source) {

                /* no source <=> key conneciton */
                if(!$key) {
                    $key = $source;
                }

                if(substr($source,0,5) == "func:") {
                    $methodName =  substr($source,5);
                    $routeParameters[$key] = $data->$methodName();
                }
                else {
                    $routeParameters[$key] = $data->$source;
                }
            }
            return route($this->route,$routeParameters);
        }
        else {
            return route($this->route);
        }
    }

    /**
     * Set the Name
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Set the route
     *
     * @param string $route
     * @return void
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * Set the parameters
     *
     * @param array $parameters
     * @return void
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Set the method
     *
     * @param string $method
     * @return void
     */
    public function setMethod($method) {
        $this->method = $method;
    }

}
