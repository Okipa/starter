<?php

namespace Deployer;

require 'recipe/laravel.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// servers
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$servers = [
    'preprod'    => [
        'host'             => '<project-preprod-host>', // todo : set project preprod host
        'branch'           => 'develop',
        'deploy_path'      => '/var/www/preprod/web/site',
        'user'             => 'preprod',
        'http_user'        => 'preprod',
        'http_group'       => 'users',
        'private_identity' => '~/.ssh/id_rsa',
    ],
    'production' => [
        'host'             => '<project-production-host>', // todo : set project production host
        'branch'           => 'master',
        'deploy_path'      => '/var/www/prod/web/site',
        'user'             => 'prod',
        'http_user'        => 'prod',
        'http_group'       => 'users',
        'private_identity' => '~/.ssh/id_rsa',
    ],
];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// servers configuration
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
set('repository', '<project-repository>'); // todo : set project repository url
set('keep_releases', 3);
set('default_stage', 'preprod');
set('allow_anonymous_stats', false);
set('writable_mode', 'chmod');
set('writable_use_sudo', false);
foreach ($servers as $stage => $server) {
    host($stage)
        ->stage($stage)
        ->hostname($server['host'])
        ->user($server['user'])
        ->identityFile($server['private_identity'])
        ->set('branch', $server['branch'])
        ->set('deploy_path', $server['deploy_path'])
        ->set('http_user', $server['http_user'])
        ->set('http_group', $server['http_group']);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// deployment tasks
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:upload',
    'project:dependencies_check',
    'deploy:shared',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:cache:clear',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:route:cache',
    'artisan:optimize',
    'artisan:migrate',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'artisan:queue:restart',
    'supervisor:laravel-queue:restart',
    'supervisor:laravel-horizon:restart',
    'server:resources:reload',
    'cron:install',
])->desc('Releasing compiled project on server');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// custom tasks chaining
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

task('deploy:upload', function () {
    $toUpload = [
        '.utils/', '.utils.custom/', 'app/', 'bootstrap/', 'config/', 'database/', 'node_modules/', 'public/',
        'resources/', 'routes/', 'vendor/', 'artisan', 'composer.json',
    ];
    $rsyncConfig = ['--delete'];
    foreach ($toUpload as $key => $item) {
        if (isset($key) && is_string($key)) {
            upload($key, '{{release_path}}/' . $item, $rsyncConfig);
        } else {
            upload($item, '{{release_path}}/' . $item, $rsyncConfig);
        }
    }
})->desc('Uploading code to the server');

task('project:dependencies_check', function () {
    within(get('release_path'), function () {
        $result = run('./.utils/server/configCheck.sh');
        if (strpos(strtolower($result), 'are missing from your server') !== false) {
            throw new \RuntimeException("Project dependencies are missing from the server");
        }
    });
})->desc('Checking server dependencies');

task('supervisor:laravel-queue:restart', function () {
    within(get('release_path'), function () {
        $result = run('./.utils/supervisor/laravelQueueRestart.sh');
        if (strpos(strtolower($result), 'file has not been found') !== false) {
            throw new \RuntimeException("The project laravel-queue supervisor config does not exist");
        }
    });
})->desc('Restarting the project laravel-queue supervisor task');

task('supervisor:laravel-horizon:restart', function () {
    within(get('release_path'), function () {
        run('./.utils/supervisor/laravelHorizonRestart.sh');
    });
})->desc('Restarting the project laravel-horizon supervisor task');

task('server:resources:reload', function () {
    $output = run('sudo service nginx reload');
    writeln('<info>' . $output . '</info>');
    $output = run('sudo service php7.3-fpm restart');
    writeln('<info>' . $output . '</info>');
})->desc('Reloading the server resources');

task('cron:install', function () {
    run('job="* * * * * {{bin/php}} {{deploy_path}}/current/artisan schedule:run >> /dev/null 2>&1";'
        . 'ct=$(crontab -l |grep -i -v "$job");(echo "$ct" ;echo "$job") |crontab -');
})->desc('Adding the laravel cron to the user crontab');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// custom chainings
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
after('deploy:failed', 'deploy:unlock');
