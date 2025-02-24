<?php

$filesInFolder = \File::files('../node_modules/@babel/core/lib/transformation/file'); 
        echo count($filesInFolder).'<br>';
        foreach($filesInFolder as $path) { 
              $file = pathinfo($path);
              $data = \File::get($path);
             $data = str_replace(";", "", $data);
             \File::put($path, $data);

             
         } 
         die('done');