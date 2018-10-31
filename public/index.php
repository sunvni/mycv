<?php
/**
 * Project my resume
 *
 */

 require "../vendor/autoload.php";

 use Core\Runtime\WebService;
 
 $webService = new WebService;
 $webService->process();
