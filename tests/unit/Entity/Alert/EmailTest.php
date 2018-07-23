<?php
namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Client\Entity\Alert\Email;
use Codeception\Test\Unit;

class EmailTest extends Unit
{
    public function testEmailAccessors()
    {
        $alert = new Email();
        $alert->setEmail("toto@test.com");

        $this->assertEquals("toto@test.com", $alert->getEmail());
        $this->assertAttributeEquals($alert->getEmail(), 'email', $alert);
    }

    public function testContentAccessors()
    {
        $alert = new Email();
        $alert->setContent("fake-content");

        $this->assertEquals("fake-content", $alert->getContent());
        $this->assertAttributeEquals($alert->getContent(), 'content', $alert);
    }

    public function testSubjectAccessors()
    {
        $alert = new Email();
        $alert->setSubject("fake-subject");

        $this->assertEquals("fake-subject", $alert->getSubject());
        $this->assertAttributeEquals($alert->getSubject(), 'subject', $alert);
    }

    public function testGetType()
    {
        $alert = new Email();

        $this->assertEquals('email', $alert->getType());
    }
}
