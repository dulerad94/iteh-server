<?php



abstract class BaseController{

    /**
     * BaseController constructor.
     * @param $controller
     */
    protected function __construct()
    {

    }

    public abstract function select();
    public abstract function insert();
    // content type header application/x-www-form-urlencoded je potreban
    public abstract function update();
    public abstract function delete();

    public function action($method,$controller){
        switch($method){
            case 'GET': return $controller->select();
            case 'POST': return $controller->insert();
            case 'PUT': return $controller->update();
            case 'DELETE': return $controller->delete();
            default: return '{"success":"false"}';
        }
    }

}