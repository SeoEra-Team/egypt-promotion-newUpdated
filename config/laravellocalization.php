<?php return [
  'supportedLocales' => [
    'en' => [
      'name' => 'English',
      'script' => 'Latn',
      'native' => 'English',
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