<?php

namespace Oro\Bundle\CustomerBundle\Tests\Unit\Form\Type;

use Oro\Bundle\CustomerBundle\Form\Type\CustomerVisitorEmailAddressType;
use Oro\Bundle\CustomerBundle\Security\Token\AnonymousCustomerUserToken;
use Oro\Bundle\EmailBundle\Form\Type\EmailAddressType;
use Oro\Component\Testing\Unit\FormIntegrationTestCase;
use Oro\Component\Testing\Unit\PreloadedExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Validator\Validation;

class CustomerVisitorEmailAddressTypeTest extends FormIntegrationTestCase
{
    /**
     * @var TokenStorageInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $tokenStorage;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->tokenStorage = $this->createMock(TokenStorageInterface::class);
        parent::setUp();
    }

    public function testCreateByCustomerVisitor()
    {
        /** @var AnonymousCustomerUserToken|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(AnonymousCustomerUserToken::class);

        $this->tokenStorage->expects($this->once())
            ->method('getToken')
            ->will($this->returnValue($token));

        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $this->assertInstanceOf(EmailAddressType::class, $form->getConfig()->getType()->getParent()->getInnerType());
        $this->assertTrue($form->getConfig()->getRequired());
    }

    public function testFormViewSetRequiredForGuest()
    {
        /** @var AnonymousCustomerUserToken|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(AnonymousCustomerUserToken::class);

        $this->tokenStorage->expects($this->exactly(2))
            ->method('getToken')
            ->will($this->returnValue($token));

        /** @var CustomerVisitorEmailAddressType $formType */
        $formType = new CustomerVisitorEmailAddressType($this->tokenStorage);
        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $formView = new FormView();
        $formView->vars['required'] = false;

        $formType->finishView($formView, $form, []);

        $this->assertTrue($formView->vars['required']);
    }

    public function testFormViewSetNotRequiredForCustomerUser()
    {
        /** @var AnonymousCustomerUserToken|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(TokenInterface::class);

        $this->tokenStorage->expects($this->exactly(2))
            ->method('getToken')
            ->will($this->returnValue($token));

        /** @var CustomerVisitorEmailAddressType $formType */
        $formType = new CustomerVisitorEmailAddressType($this->tokenStorage);
        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $formView = new FormView();
        $formView->vars['required'] = false;

        $formType->finishView($formView, $form, []);

        $this->assertFalse($formView->vars['required']);
    }

    /**
     * @dataProvider getNotValidEmail
     *
     * @param string $submittedData
     * @param string $expectedError
     */
    public function testSubmitNotValidEmailByCustomerVisitor($submittedData, $expectedError)
    {
        /** @var AnonymousCustomerUserToken|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(AnonymousCustomerUserToken::class);

        $this->tokenStorage->expects($this->once())
            ->method('getToken')
            ->will($this->returnValue($token));

        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $form->submit($submittedData);
        $this->assertFalse($form->isValid());
        $this->assertContains($expectedError, (string)$form->getErrors(true, false));
    }

    /**
     * @return array
     */
    public function getNotValidEmail()
    {
        return [
            'empty string' => [
                'submittedData' => '',
                'expectedError' => 'This value should not be blank'
            ],
            'not email string' => [
                'submittedData' => 'email',
                'expectedError' => 'This value is not a valid email address'
            ],
        ];
    }

    public function testCreateByCustomerUser()
    {
        /** @var TokenInterface|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(TokenInterface::class);

        $this->tokenStorage->expects($this->once())
            ->method('getToken')
            ->will($this->returnValue($token));

        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $this->assertInstanceOf(EmailAddressType::class, $form->getConfig()->getType()->getParent()->getInnerType());
    }

    /**
     * @dataProvider getNotValidEmailForCustomerUser
     *
     * @param string $submittedData
     * @param string $expectedError
     */
    public function testSubmitNotValidEmailByCustomerUser($submittedData, $expectedError)
    {
        /** @var TokenInterface|\PHPUnit\Framework\MockObject\MockObject $token */
        $token = $this->createMock(TokenInterface::class);

        $this->tokenStorage->expects($this->once())
            ->method('getToken')
            ->will($this->returnValue($token));

        $form = $this->factory->create(CustomerVisitorEmailAddressType::class);
        $form->submit($submittedData);
        $this->assertFalse($form->isValid());
        $errors = $form->getErrors(true, false);

        $this->assertContains($expectedError, $errors->current()->getMessage());
    }

    /**
     * @return array
     */
    public function getNotValidEmailForCustomerUser()
    {
        return [
            'not email string' => [
                'submittedData' => 'email',
                'expectedError' => 'This value is not a valid email address'
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getExtensions()
    {
        $type = new CustomerVisitorEmailAddressType($this->tokenStorage);

        return [
            new PreloadedExtension([$type], []),
            new ValidatorExtension(Validation::createValidator())
        ];
    }
}
