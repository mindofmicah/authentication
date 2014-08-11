<?php
namespace MindOfMicah\AuthenticationSystem\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use Illuminate\Support\Pluralizer;

class AuthenticationInstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'wd:auth:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $mustache = new \Mustache_Engine;
        
        $plural = Pluralizer::plural(strtolower($this->option('resource')));
        $controller_name = ucfirst($plural) . 'Controller';

        $template = file_get_contents(__DIR__ . '/../../../templates/controller.template');
        $output = $mustache->render($template, ['controller_name' => $controller_name, 'sign_in_path'=> $plural . '.create']);
        file_put_contents($this->option('controller-path') . '/'.$controller_name.'.php', $output);

        $template = file_get_contents(__DIR__ . '/../../../templates/routes.template');
        $output = $mustache->render(
            $template, 
            ['sign_in'=>'sign/in', 'sign_out'=>'sign/out', 'controller' => $controller_name]
        );
        file_put_contents($this->option('routeFile'), $output, FILE_APPEND);

        $this->info('Successfully installed your authentication');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('routeFile', null, InputOption::VALUE_OPTIONAL, 'An example option.', app_path('routes.php')),
			array('resource', null, InputOption::VALUE_OPTIONAL, 'An example option.', 'session'),
			array('controller-path', null, InputOption::VALUE_OPTIONAL, 'An example option.', app_path('controllers')),
			array('signIn', null, InputOption::VALUE_OPTIONAL, 'An example option.', 'sign-in'),
			array('signOut', null, InputOption::VALUE_OPTIONAL, 'An example option.', 'sign-out'),
		);
	}

}
