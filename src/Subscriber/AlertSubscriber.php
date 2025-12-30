<?php declare(strict_types=1);

namespace Rootrifs\CustomAlerts\Subscriber;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\MultiFilter;
use Shopware\Storefront\Page\GenericPageLoadedEvent;
use Shopware\Storefront\Page\PageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AlertSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityRepository $alertRepository
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            GenericPageLoadedEvent::class => 'onPageLoaded',
            PageLoadedEvent::class => 'onPageLoaded'
        ];
    }

    public function onPageLoaded(PageLoadedEvent|GenericPageLoadedEvent $event): void
    {
        $context = $event->getSalesChannelContext();
        $criteria = new Criteria();

        $criteria->addFilter(new EqualsFilter('active', true));

        $criteria->addFilter(new MultiFilter(MultiFilter::CONNECTION_OR, [
            new EqualsFilter('salesChannelId', null),
            new EqualsFilter('salesChannelId', $context->getSalesChannelId()),
        ]));

        $alerts = $this->alertRepository->search($criteria, $context->getContext())->getEntities();

        $activeRuleIds = $context->getRuleIds();
        $filteredAlerts = $alerts->filter(function($alert) use ($activeRuleIds) {
            if (!$alert->getRuleId()) {
                return true;
            }
            return in_array($alert->getRuleId(), $activeRuleIds, true);
        });

        $event->getPage()->addExtension('rootrifs_custom_alerts', $filteredAlerts);
    }
}
