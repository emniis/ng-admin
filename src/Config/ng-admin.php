<?php

return [
  'route' =>[
    'prefix'=> 'admin',
  ],
  'developer' =>[
    'name'=> 'Emniis',
    'website'=> 'http://emniis.com',
  ],
  'app' =>[
    'name'=> env('APP_NAME'),
    'version'=> '0.1.0',
    'ng_module' => strtolower(env('APP_NAME', 'admin')), // angularjs module name
  ],

];
