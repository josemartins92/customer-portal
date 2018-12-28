- [CustomerBundle](#customerbundle)
- [FrontendBundle](#frontendbundle)


CustomerBundle
--------------
* The `DeprecatedRestApiRouteOptionsResolver`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Routing/DeprecatedRestApiRouteOptionsResolver.php#L15 "Oro\Bundle\CustomerBundle\Routing\DeprecatedRestApiRouteOptionsResolver")</sup> class was removed.
* The `UniqueCustomerUserNameAndEmailValidator::__construct(EntityRepository $customerUserRepository)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Validator/Constraints/UniqueCustomerUserNameAndEmailValidator.php#L23 "Oro\Bundle\CustomerBundle\Validator\Constraints\UniqueCustomerUserNameAndEmailValidator")</sup> method was changed to `UniqueCustomerUserNameAndEmailValidator::__construct(CustomerUserManager $customerUserManager)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.1.0-beta/src/Oro/Bundle/CustomerBundle/Validator/Constraints/UniqueCustomerUserNameAndEmailValidator.php#L23 "Oro\Bundle\CustomerBundle\Validator\Constraints\UniqueCustomerUserNameAndEmailValidator")</sup>
* The `Processor::sendWelcomeNotification(CustomerUser $customerUser, $password)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Mailer/Processor.php#L55 "Oro\Bundle\CustomerBundle\Mailer\Processor")</sup> method was changed to `Processor::sendWelcomeNotification(CustomerUser $customerUser)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.1.0-beta/src/Oro/Bundle/CustomerBundle/Mailer/Processor.php#L55 "Oro\Bundle\CustomerBundle\Mailer\Processor")</sup>
* The `FrontendCustomerUserRoleSelectType::__construct(TokenAccessorInterface $tokenAccessor, ManagerRegistry $registry, AclHelper $aclHelper)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendCustomerUserRoleSelectType.php#L35 "Oro\Bundle\CustomerBundle\Form\Type\FrontendCustomerUserRoleSelectType")</sup> method was changed to `FrontendCustomerUserRoleSelectType::__construct(TokenAccessorInterface $tokenAccessor, ManagerRegistry $registry)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.1.0-beta/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendCustomerUserRoleSelectType.php#L33 "Oro\Bundle\CustomerBundle\Form\Type\FrontendCustomerUserRoleSelectType")</sup>
* The `FrontendOwnerSelectType::__construct(AclHelper $aclHelper, ManagerRegistry $registry, ConfigProvider $configProvider)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendOwnerSelectType.php#L44 "Oro\Bundle\CustomerBundle\Form\Type\FrontendOwnerSelectType")</sup> method was changed to `FrontendOwnerSelectType::__construct(ManagerRegistry $registry, ConfigProvider $configProvider)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.1.0-beta/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendOwnerSelectType.php#L40 "Oro\Bundle\CustomerBundle\Form\Type\FrontendOwnerSelectType")</sup>
* The `FrontendCustomerUserRoleSelectType::$aclHelper`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendCustomerUserRoleSelectType.php#L28 "Oro\Bundle\CustomerBundle\Form\Type\FrontendCustomerUserRoleSelectType::$aclHelper")</sup> property was removed.
* The `FrontendOwnerSelectType::$aclHelper`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Form/Type/FrontendOwnerSelectType.php#L27 "Oro\Bundle\CustomerBundle\Form\Type\FrontendOwnerSelectType::$aclHelper")</sup> property was removed.
* The `CustomerUserRoleDatagridListener::onBuildAfter`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/EventListener/Datagrid/CustomerUserRoleDatagridListener.php#L29 "Oro\Bundle\CustomerBundle\EventListener\Datagrid\CustomerUserRoleDatagridListener::onBuildAfter")</sup> method was removed.
* The `CustomerUserManager::isSendPasswordInWelcomeEmail`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/CustomerBundle/Entity/CustomerUserManager.php#L167 "Oro\Bundle\CustomerBundle\Entity\CustomerUserManager::isSendPasswordInWelcomeEmail")</sup> method was removed.

FrontendBundle
--------------
* The `RestDocUrlGeneratorCompilerPass`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/FrontendBundle/DependencyInjection/Compiler/RestDocUrlGeneratorCompilerPass.php#L13 "Oro\Bundle\FrontendBundle\DependencyInjection\Compiler\RestDocUrlGeneratorCompilerPass")</sup> class was removed.
* The `ValidateApiDocViewListener::__construct(array $views, array $frontendViews)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.0.0/src/Oro/Bundle/FrontendBundle/EventListener/ValidateApiDocViewListener.php#L21 "Oro\Bundle\FrontendBundle\EventListener\ValidateApiDocViewListener")</sup> method was changed to `ValidateApiDocViewListener::__construct(string $basePath, array $views, $defaultView, array $frontendViews, $frontendDefaultView)`<sup>[[?]](https://github.com/oroinc/customer-portal/tree/3.1.0-beta/src/Oro/Bundle/FrontendBundle/EventListener/ValidateApiDocViewListener.php#L27 "Oro\Bundle\FrontendBundle\EventListener\ValidateApiDocViewListener")</sup>