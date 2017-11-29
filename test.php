<?php

$route = "{controller}/{action}";
$route = preg_replace("/\//",'\\/',$route);
//echo $result;// posts\/new\/news\/45\/
$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
//$result =preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$result);
$route = '/^' . $route . '$/i';
//$result = '/^'.$result.'$/i';
echo $route;
//$a = "\/";
//$b = "\\/";
//echo ($a===$b)?"Yes":"No";