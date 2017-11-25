<?php

namespace Deployer;

require 'recipe/symfony3.php';
require 'vendor/deployer/recipes/recipe/npm.php';

// Configuration

set('repository', 'git@github.com:Cryde/cr.git');

set('git_tty', true); // [Optional] Allocate tty for git on first deployment
set('keep_releases', 2);
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
inventory('hosts.yml');

// Tasks
desc('Build Brunch assets');
task('assets:build', function() {
    run("cd {{release_path}} && {{bin/npm}} run build");
});
after('npm:install', 'assets:build');

desc('Restart PHP-FPM service');
task('php-fpm:restart', function() {
    run('sudo service php7.1-fpm reload');
});
after('deploy:symlink', 'php-fpm:restart');

desc('Remove node_modules folder');
task('assets:clean', function() {
    run('cd {{release_path}} && rm -rf node_modules');
});
after('deploy:symlink', 'assets:clean');

after('deploy:update_code', 'npm:install');


