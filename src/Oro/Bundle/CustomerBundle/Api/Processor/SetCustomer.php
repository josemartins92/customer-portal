<?php

namespace Oro\Bundle\CustomerBundle\Api\Processor;

use Oro\Bundle\ApiBundle\Form\FormUtil;
use Oro\Bundle\ApiBundle\Processor\CustomizeFormData\CustomizeFormDataContext;
use Oro\Bundle\CustomerBundle\Entity\Customer;
use Oro\Bundle\CustomerBundle\Entity\CustomerUser;
use Oro\Bundle\SecurityBundle\Authentication\TokenAccessorInterface;
use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * Assigns an entity to the current customer.
 */
class SetCustomer implements ProcessorInterface
{
    /** @var PropertyAccessorInterface */
    private $propertyAccessor;

    /** @var TokenAccessorInterface */
    private $tokenAccessor;

    /** @var string */
    private $customerFieldName;

    /**
     * @param PropertyAccessorInterface $propertyAccessor
     * @param TokenAccessorInterface    $tokenAccessor
     * @param string                    $customerFieldName
     */
    public function __construct(
        PropertyAccessorInterface $propertyAccessor,
        TokenAccessorInterface $tokenAccessor,
        string $customerFieldName = 'customer'
    ) {
        $this->propertyAccessor = $propertyAccessor;
        $this->tokenAccessor = $tokenAccessor;
        $this->customerFieldName = $customerFieldName;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context)
    {
        /** @var CustomizeFormDataContext $context */

        $customerUserFormField = FormUtil::findFormFieldByPropertyPath(
            $context->getForm(),
            $this->customerFieldName
        );
        if (null === $customerUserFormField || !$customerUserFormField->isSubmitted()) {
            $this->setCustomer($context->getData());
        }
    }

    /**
     * Returns a customer a processing entity should be assigned to.
     *
     * @return Customer|null
     */
    private function getCustomer(): ?Customer
    {
        $user = $this->tokenAccessor->getUser();
        if (!$user instanceof CustomerUser) {
            return null;
        }

        return $user->getCustomer();
    }

    /**
     * Assigns the given entity to a customer returned by getCustomer() method.
     * The entity's customer property will not be changed if the getCustomer() method returns NULL
     * or the entity is already assigned to a customer.
     *
     * @param object $entity
     */
    private function setCustomer($entity): void
    {
        $entityCustomer = $this->propertyAccessor->getValue($entity, $this->customerFieldName);
        if (null === $entityCustomer) {
            $customer = $this->getCustomer();
            if (null !== $customer) {
                $this->propertyAccessor->setValue($entity, $this->customerFieldName, $customer);
            }
        }
    }
}
