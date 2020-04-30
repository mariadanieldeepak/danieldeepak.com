<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'danieldeepak.com');

// Project repository
set('repository', 'git@github.com:mariadanieldeepak/danieldeepak.com.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

set('keep_releases', 3);

// Hosts

host('barman')
	->user('daniel')
	->stage('production')
	->set('deploy_path', '/var/www/{{application}}/')
	->configFile('~/.ssh/config')
	->identityFile('~/.ssh/danieldeepak_id_rsa');


// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'deploy:symlink_wpconfig', // Custom task
    'deploy:symlink_src', // Custom task
    'deploy:symlink_uploads', // Custom task
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Custom tasks.
desc('Copies the src/* to html/ directory');
task('deploy:symlink_wpconfig', function () {
	$dir = get('deploy_path');
	$result = run('cd {{deploy_path}} && 
	ln -s /var/www/{{application}}/config/wp-config.php current/src/wp-config.php;
	');
});

desc('Copies the src/* to html/ directory');
task('deploy:symlink_uploads', function () {
	$dir = get('deploy_path');
	$result = run('cd {{deploy_path}} && 
	ln -sf /var/www/{{application}}/media current/src/wp-content/uploads;
	');
});

desc('Copies the src/* ');
task('deploy:symlink_src', function () {
	$dir = get('deploy_path');
	$result = run('cd {{deploy_path}} && 
	ln -s /var/www/{{application}}/current/src/ html;
	');
});
