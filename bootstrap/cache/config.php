<?php return array (
  'app' => 
  array (
    'name' => 'LANMS',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://lanms.dev',
    'timezone' => 'Europe/Oslo',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:ijeGBo3+OEZ9IcN2o1JkYQ==',
    'cipher' => 'AES-128-CBC',
    'log' => 'daily',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      13 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      14 => 'Illuminate\\Queue\\QueueServiceProvider',
      15 => 'Illuminate\\Redis\\RedisServiceProvider',
      16 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      17 => 'Illuminate\\Session\\SessionServiceProvider',
      18 => 'Illuminate\\Translation\\TranslationServiceProvider',
      19 => 'Illuminate\\Validation\\ValidationServiceProvider',
      20 => 'Illuminate\\View\\ViewServiceProvider',
      21 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      22 => 'LANMS\\Providers\\AppServiceProvider',
      23 => 'LANMS\\Providers\\AuthServiceProvider',
      24 => 'LANMS\\Providers\\EventServiceProvider',
      25 => 'LANMS\\Providers\\RouteServiceProvider',
      26 => 'LANMS\\Providers\\BroadcastServiceProvider',
      27 => 'Intervention\\Image\\ImageServiceProvider',
      28 => 'igaster\\laravelTheme\\themeServiceProvider',
      29 => 'LANMS\\Providers\\ThemeSelectServiceProvider',
      30 => 'Cartalyst\\Sentinel\\Laravel\\SentinelServiceProvider',
      31 => 'anlutro\\LaravelSettings\\ServiceProvider',
      32 => 'Liebig\\Cron\\Laravel5ServiceProvider',
      33 => 'Cartalyst\\Stripe\\Laravel\\StripeServiceProvider',
      34 => 'Vsmoraes\\Pdf\\PdfServiceProvider',
      35 => 'Milon\\Barcode\\BarcodeServiceProvider',
      36 => 'Sentry\\SentryLaravel\\SentryLaravelServiceProvider',
      37 => 'Rap2hpoutre\\LaravelLogViewer\\LaravelLogViewerServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'User' => 'LANMS\\User',
      'News' => 'LANMS\\News',
      'NewsCategory' => 'LANMS\\NewsCategory',
      'Address' => 'LANMS\\Address',
      'Seats' => 'LANMS\\Seats',
      'SeatRows' => 'LANMS\\SeatRows',
      'SeatPayment' => 'LANMS\\SeatPayment',
      'SeatReservation' => 'LANMS\\SeatReservation',
      'SeatReservationStatus' => 'LANMS\\SeatReservationStatus',
      'SeatTicket' => 'LANMS\\SeatTicket',
      'Act' => 'LANMS\\Act',
      'Checkin' => 'LANMS\\Checkin',
      'Visitor' => 'LANMS\\Visitor',
      'Crew' => 'LANMS\\Crew',
      'CrewCategory' => 'LANMS\\CrewCategory',
      'CrewSkill' => 'LANMS\\CrewSkill',
      'CrewSkillAttached' => 'LANMS\\CrewSkillAttached',
      'Page' => 'LANMS\\Page',
      'BrokenBand' => 'LANMS\\BrokenBand',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Theme' => 'igaster\\laravelTheme\\Facades\\Theme',
      'Activation' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Activation',
      'Reminder' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Reminder',
      'Sentinel' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Sentinel',
      'Setting' => 'anlutro\\LaravelSettings\\Facade',
      'Stripe' => 'Cartalyst\\Stripe\\Laravel\\Facades\\Stripe',
      'PDF' => 'Vsmoraes\\Pdf\\PdfFacade',
      'DNS1D' => 'Milon\\Barcode\\Facades\\DNS1DFacade',
      'DNS2D' => 'Milon\\Barcode\\Facades\\DNS2DFacade',
      'Sentry' => 'Sentry\\SentryLaravel\\SentryFacade',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'LANMS\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'email' => 'auth.emails.password',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'barcode' => 
  array (
    'store_path' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\public\\/',
  ),
  'broadcasting' => 
  array (
    'default' => 'null',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage/framework/cache',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'cartalyst' => 
  array (
    'sentinel' => 
    array (
      'session' => 'membra_sentinel',
      'cookie' => 'membra_sentinel',
      'users' => 
      array (
        'model' => 'LANMS\\User',
      ),
      'roles' => 
      array (
        'model' => 'Cartalyst\\Sentinel\\Roles\\EloquentRole',
      ),
      'permissions' => 
      array (
        'class' => 'Cartalyst\\Sentinel\\Permissions\\StandardPermissions',
      ),
      'persistences' => 
      array (
        'model' => 'Cartalyst\\Sentinel\\Persistences\\EloquentPersistence',
        'single' => false,
      ),
      'checkpoints' => 
      array (
        0 => 'throttle',
        1 => 'activation',
      ),
      'activations' => 
      array (
        'model' => 'Cartalyst\\Sentinel\\Activations\\EloquentActivation',
        'expires' => 259200,
        'lottery' => 
        array (
          0 => 2,
          1 => 100,
        ),
      ),
      'reminders' => 
      array (
        'model' => 'Cartalyst\\Sentinel\\Reminders\\EloquentReminder',
        'expires' => 14400,
        'lottery' => 
        array (
          0 => 2,
          1 => 100,
        ),
      ),
      'throttling' => 
      array (
        'model' => 'Cartalyst\\Sentinel\\Throttling\\EloquentThrottle',
        'global' => 
        array (
          'interval' => 900,
          'thresholds' => 
          array (
            10 => 1,
            20 => 2,
            30 => 4,
            40 => 8,
            50 => 16,
            60 => 12,
          ),
        ),
        'ip' => 
        array (
          'interval' => 900,
          'thresholds' => 5,
        ),
        'user' => 
        array (
          'interval' => 900,
          'thresholds' => 5,
        ),
      ),
    ),
  ),
  'compile' => 
  array (
    'files' => 
    array (
      0 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\app\\Providers\\AppServiceProvider.php',
      1 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\app\\Providers\\EventServiceProvider.php',
      2 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\app\\Providers\\RouteServiceProvider.php',
    ),
    'providers' => 
    array (
    ),
  ),
  'database' => 
  array (
    'fetch' => 8,
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage/database.sqlite',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'lanms',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'lanms',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'database' => 'lanms',
        'username' => 'root',
        'password' => '',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'cluster' => false,
      'default' => 
      array (
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 0,
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage/app',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'your-key',
        'secret' => 'your-secret',
        'region' => 'your-region',
        'bucket' => 'your-bucket',
      ),
      'rackspace' => 
      array (
        'driver' => 'rackspace',
        'username' => 'your-username',
        'key' => 'your-key',
        'container' => 'your-container',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'region' => 'IAD',
        'url_type' => 'publicURL',
      ),
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'imagecache' => 
  array (
    'route' => NULL,
    'paths' => 
    array (
      0 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\public\\upload',
      1 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\public\\images',
    ),
    'templates' => 
    array (
      'small' => 'Intervention\\Image\\Templates\\Small',
      'medium' => 'Intervention\\Image\\Templates\\Medium',
      'large' => 'Intervention\\Image\\Templates\\Large',
    ),
    'lifetime' => 43200,
  ),
  'liebigCron' => 
  array (
    'runInterval' => 1,
    'laravelLogging' => true,
    'databaseLogging' => true,
    'logOnlyErrorJobsToDatabase' => false,
    'deleteDatabaseEntriesAfter' => 240,
    'preventOverlapping' => true,
    'inTimeCheck' => true,
    'cronKey' => '',
  ),
  'log' => 
  array (
    'developer_name' => 'Developer',
    'full_name_as_name' => true,
    'full_name_last_name_first' => false,
    'auto_set_user_id' => true,
    'action_icon' => 
    array (
      'element' => 'i',
      'class_prefix' => 'fa fa-',
    ),
    'action_icons' => 
    array (
      'x' => 'info-circle',
      'create' => 'plus-circle',
      'update' => 'edit',
      'delete' => 'minus-circle',
      'ban' => 'ban',
      'unban' => 'circle-o',
      'approve' => 'ok-circle',
      'unapprove' => 'ban',
      'activate' => 'ok-circle',
      'deactivate' => 'ban',
      'log_in' => 'sign-in',
      'log_out' => 'sign-out',
      'view' => 'eye',
      'comment' => 'comment',
    ),
    'content_types' => 
    array (
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'mani.infihex.com',
    'port' => '465',
    'from' => 
    array (
      'address' => 'noreply@infihex.net',
      'name' => 'LANMS',
    ),
    'encryption' => 'ssl',
    'username' => 'noreply@infihex.net',
    'password' => 'MailTestErBest2015!',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'expire' => 60,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'ttr' => 60,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'queue' => 'your-queue-url',
        'region' => 'us-east-1',
      ),
      'iron' => 
      array (
        'driver' => 'iron',
        'host' => 'mq-aws-us-east-1.iron.io',
        'token' => 'your-token',
        'project' => 'your-project-id',
        'queue' => 'your-queue-name',
        'encrypt' => true,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'queue' => 'default',
        'expire' => 60,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sentry' => 
  array (
    'dsn' => 'https://9456e021c68245d3a2dab66d95e6cf42:4695df2952c44e698b10e8e225f17e86@sentry.io/131026',
    'breadcrumbs.sql_bindings' => true,
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => '',
      'secret' => '',
    ),
    'mandrill' => 
    array (
      'secret' => '',
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'stripe' => 
    array (
      'secret' => 'sk_test_pOqqSRPoUVK52CFMkg7uLxMm',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
  ),
  'settings' => 
  array (
    'store' => 'database',
    'path' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage/settings.json',
    'table' => 'settings',
    'connection' => NULL,
  ),
  'themes' => 
  array (
    'enabled' => true,
    'asset_not_found' => 'LOG_ERROR',
    'active' => 'frontend',
    'themes' => 
    array (
      0 => 'bootstrapextended',
      1 => 'frontend',
      2 => 'neon-admin',
      3 => 'neon-user',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\resources\\views\\frontend',
      1 => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\resources\\views',
    ),
    'compiled' => 'E:\\Users\\RTRD\\Bitbucket\\lanms\\storage\\framework\\views',
  ),
);
