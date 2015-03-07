<?php namespace Atrauzzi\LaravelOauth2Server\Console {

	use Illuminate\Console\Command;
	use Illuminate\Foundation\Inspiring;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Input\InputArgument;


	class CreateScope extends Command {

		/**
		 * The console command name.
		 *
		 * @var string
		 */
		protected $name = 'create-scope';

		/**
		 * The console command description.
		 *
		 * @var string
		 */
		protected $description = 'Create a new scope.';

		/**
		 * Execute the console command.
		 *
		 * @return mixed
		 */
		public function handle() {
			$this->comment(PHP_EOL . Inspiring::quote() . PHP_EOL);
		}

	}

}