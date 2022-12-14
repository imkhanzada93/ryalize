<?php
namespace Psalm\Internal\PluginManager\Command;

use function array_keys;
use function array_map;
use function array_values;
use function count;
use const DIRECTORY_SEPARATOR;
use function getcwd;
use function is_string;
use Psalm\Internal\PluginManager\PluginListFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @internal
 */
class ShowCommand extends Command
{
    /** @var PluginListFactory */
    private $plugin_list_factory;

    public function __construct(PluginListFactory $plugin_list_factory)
    {
        $this->plugin_list_factory = $plugin_list_factory;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('show')
            ->setDescription('Lists enabled and available plugins')
            ->addUsage('[-c path/to/psalm.xml]');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $current_dir = (string) getcwd() . DIRECTORY_SEPARATOR;

        $config_file_path = $input->getOption('config');
        if ($config_file_path !== null && !is_string($config_file_path)) {
            throw new \UnexpectedValueException('Config file path should be a string');
        }

        $plugin_list = ($this->plugin_list_factory)($current_dir, $config_file_path);

        $enabled = $plugin_list->getEnabled();
        $available = $plugin_list->getAvailable();

        $formatRow =
            function (string $class, ?string $package): array {
                return [$package, $class];
            };

        $io->section('Enabled');
        if (count($enabled)) {
            $io->table(
                ['Package', 'Class'],
                array_map(
                    $formatRow,
                    array_keys($enabled),
                    array_values($enabled)
                )
            );
        } else {
            $io->location('No plugins enabled');
        }

        $io->section('Available');
        if (count($available)) {
            $io->table(
                ['Package', 'Class'],
                array_map(
                    $formatRow,
                    array_keys($available),
                    array_values($available)
                )
            );
        } else {
            $io->location('No plugins available');
        }

        return 0;
    }
}
