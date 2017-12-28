<?php
/**
 * Class helloController
 * @see AppController
 * @package app.controllers
 */
class helloController extends AppController
{
    public function index()
    {
        $name = Param::get('name', null);
        $this->set('name', $name);
    }
}