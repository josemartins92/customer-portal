<?php

namespace Oro\Bundle\CustomerBundle\Tests\Functional\Api\Frontend\DataFixtures;

use Oro\Bundle\CustomerBundle\Entity\CustomerUser;
use Oro\Bundle\CustomerBundle\Tests\Functional\Api\DataFixtures\LoadCustomerUserRoles;
use Oro\Bundle\FrontendBundle\Tests\Functional\Api\FrontendRestJsonApiTestCase;

/**
 * Creates the customer user entity with buyer permissions that can be used to test frontend REST API.
 */
class LoadBuyerCustomerUserData extends LoadCustomerUserData
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return array_merge(parent::getDependencies(), [LoadCustomerUserRoles::class]);
    }

    /**
     * @param CustomerUser $customerUser
     */
    protected function initializeCustomerUser(CustomerUser $customerUser)
    {
        $customerUser
            ->setEmail(FrontendRestJsonApiTestCase::USER_NAME)
            ->addRole($this->getReference('buyer'));
    }
}
