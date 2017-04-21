<?php  namespace  hi{


    function helloWorld()
    {
        echo __FUNCTION__ ;
    }

    function callHelloWorld()
    {
        \hi\helloWorld() ;
    }

}