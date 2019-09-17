<?php

define('APPLICATION_ENV', (
!empty($_SERVER['APPLICATION_ENV']) ?
    $_SERVER['APPLICATION_ENV'] : 'pro'
));
