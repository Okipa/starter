<?php

namespace Deployer;

use RuntimeException;

require 'recipe/laravel.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Servers
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$servers = [
    'preprod' => [
        'host' => '<project-preprod-host>', // Todo: to customize.
        'branch' => 'develop',
        'deploy_path' => '/var/www/preprod/web/site',
        'user' => 'preprod',
        'http_user' => 'preprod',
        'http_group' => 'users',
        'private_identity' => '~/.ssh/id_rsa',
    ],
    'production' => [
        'host' => '<project-production-host>', // Todo: to customize.
        'branch' => 'master',
        'deploy_path' => '/var/www/prod/web/site',
        'user' => 'prod',
        'http_user' => 'prod',
        'http_group' => 'users',
        'private_identity' => '~/.ssh/id_rsa',
    ],
];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Servers configuration
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

set('bin/php', '/usr/bin/php8.0');
set('repository', '<project-repository>'); // Todo: to customize.
set('keep_releases', 3);
set('default_stage', 'preprod');
set('allow_anonymous_stats', false);
set('writable_mode', 'chmod');
set('writable_use_sudo', false);
foreach ($servers as $stage => $server) {
    host($stage)->stage($stage)
        ->hostname($server['host'])
        ->user($server['user'])
        ->identityFile($server['private_identity'])
        ->set('branch', $server['branch'])
        ->set('deploy_path', $server['deploy_path'])
        ->set('http_user', $server['http_user'])
        ->set('http_group', $server['http_group']);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Deployment tasks
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'project:dependencies_check',
    'deploy:upload',
    'deploy:shared',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:cache:clear',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:migrate',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'artisan:horizon:terminate',
    'artisan:queue:restart',
    'server:resources:reload',
    'cron:install',
])->desc('Releasing compiled project on server');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Custom tasks chaining
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

task('deploy:upload', function () {
    $toUpload = [
        '.git/', // Required for sentry error catching.
        'app/',
        'bootstrap/',
        'config/',
        'database/',
        'node_modules/', // Required if you have no-dev node dependencies.
        'public/',
        'resources/',
        'routes/',
        'vendor/',
        'artisan',
        'composer.json',
    ];
    $rsyncConfig = ['options' => ['--delete', '-q']];
    foreach ($toUpload as $key => $item) {
        if (isset($key) && is_string($key)) {
            upload($key, '{{release_path}}/' . $item, $rsyncConfig);
        } else {
            upload($item, '{{release_path}}/' . $item, $rsyncConfig);
        }
    }
})->desc('Uploading code to the server');

task('project:dependencies_check', function () {
    $dependencies = [
        'git',
        'nginx',
        'mysql-server',
        'supervisor',
        'redis-server',
        'php-redis',
        'php-imagick',
        'jpegoptim',
        'optipng',
        'pngquant',
        'gifsicle',
        'exif',
        'ghostscript',
        'php8.0',
        'php8.0-cli',
        'php8.0-fpm',
        'php8.0-common',
        'php8.0-bcmath',
        'php8.0-mbstring',
        'php8.0-intl',
        'php8.0-xml',
        'php8.0-mysql',
        'php8.0-opcache',
        'php8.0-gd',
        'php8.0-curl',
        'php8.0-zip',
    ];
    foreach ($dependencies as $dependency) {
        $output = run('dpkg-query --show --showformat=\'${db:Status-Status}\n\' \'' . $dependency . '\'');
        if (mb_stripos($output, 'not-installed') !== false) {
            throw new RuntimeException('Project dependency "' . $dependency . '" is not installed on the server.');
        }
    }
})->desc('Verify that server dependencies are installed');

task('server:resources:reload', function () {
    $output = run('sudo service nginx reload');
    writeln('<info>' . $output . '</info>');
    $output = run('sudo service php8.0-fpm restart');
    writeln('<info>' . $output . '</info>');
})->desc('Reloading the server resources');

task('cron:install', function () {
    run('job="* * * * * {{bin/php}} {{deploy_path}}/current/artisan schedule:run >> /dev/null 2>&1";'
        . 'ct=$(crontab -l |grep -i -v "$job");(echo "$ct" ;echo "$job") |crontab -');
})->desc('Adding the laravel cron to the user crontab');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Custom chaining
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

after('deploy:failed', 'deploy:unlock');
