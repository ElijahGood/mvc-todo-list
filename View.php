<?php

class View {

    public function __construct($viewName, $mainData) {
        // echo "View was constructed! ".$viewName;
        include(ROOT.'/views/'.$viewName);
    }

}