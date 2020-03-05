<?php

namespace App\Listener;

use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Logger\LoggerFactory;
use Lengbin\YiiDb\ActiveRecord\AfterSaveEvent;
use Lengbin\YiiDb\ActiveRecord\ModelEvent;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @Listener()
 */
class ActiveRecodeListener implements ListenerInterface
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get(LoggerFactory::class)->get('sql');
    }

    /**
     * @inheritDoc
     */
    public function listen(): array
    {
        return [
            AfterSaveEvent::class,
            ModelEvent::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function process(object $event)
    {
        $this->logger->info('class: ' . get_class($event) . ' eventName: ' . $event->name);
    }
}
