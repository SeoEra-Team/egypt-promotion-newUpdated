<?php return [
  'supportedLocales' => [
    'en' => [
      'name' => 'en',
      'script' => 'Latn',
      'native' => 'en',
      'regional' => 'en_GB',
    ],
    'it' => [
      'name' => 'it',
      'script' => 'it',
      'native' => 'it',
      'regional' => 'it',
    ],
  ],
  'useAcceptLanguageHeader' => true,
  'hideDefaultLocaleInURL' => true,
  'localesOrder' => [
  ],
  'localesMapping' => [
    'en' => 'en',
  ],
  'utf8suffix' => '.UTF-8',
  'urlsIgnored' => [
     '/skipped',
  ],
  'httpMethodsIgnored' => [
     'POST',
     'PUT',
     'PATCH',
     'DELETE',
  ],
];