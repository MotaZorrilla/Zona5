<?php

namespace Tests\Unit;

use App\Enums\MessageStatusEnum;
use App\Enums\NewsStatusEnum;
use App\Enums\GradeLevelEnum;
use App\Enums\RoleEnum;
use Tests\TestCase;

class EnumTest extends TestCase
{
    public function test_message_status_enum()
    {
        $this->assertEquals('unread', MessageStatusEnum::UNREAD);
        $this->assertEquals('read', MessageStatusEnum::READ);
        $this->assertEquals('archived', MessageStatusEnum::ARCHIVED);

        $this->assertTrue(MessageStatusEnum::isValid('unread'));
        $this->assertTrue(MessageStatusEnum::isValid('read'));
        $this->assertTrue(MessageStatusEnum::isValid('archived'));
        $this->assertFalse(MessageStatusEnum::isValid('invalid'));
    }

    public function test_news_status_enum()
    {
        $this->assertEquals('draft', NewsStatusEnum::DRAFT);
        $this->assertEquals('published', NewsStatusEnum::PUBLISHED);
        $this->assertEquals('scheduled', NewsStatusEnum::SCHEDULED);

        $this->assertTrue(NewsStatusEnum::isValid('draft'));
        $this->assertTrue(NewsStatusEnum::isValid('published'));
        $this->assertTrue(NewsStatusEnum::isValid('scheduled'));
        $this->assertFalse(NewsStatusEnum::isValid('invalid'));
    }

    public function test_grade_level_enum()
    {
        $this->assertEquals('Aprendiz', GradeLevelEnum::APRENDIZ);
        $this->assertEquals('Compañero', GradeLevelEnum::COMPAÑERO);
        $this->assertEquals('Maestro', GradeLevelEnum::MAESTRO);
        $this->assertEquals('Todos', GradeLevelEnum::TODOS);

        $this->assertTrue(GradeLevelEnum::isValid('Aprendiz'));
        $this->assertTrue(GradeLevelEnum::isValid('Compañero'));
        $this->assertTrue(GradeLevelEnum::isValid('Maestro'));
        $this->assertTrue(GradeLevelEnum::isValid('Todos'));
        $this->assertFalse(GradeLevelEnum::isValid('invalid'));
    }

    public function test_role_enum()
    {
        $this->assertEquals('SuperAdmin', RoleEnum::SUPER_ADMIN);
        $this->assertEquals('Admin', RoleEnum::ADMIN);
        $this->assertEquals('User', RoleEnum::USER);

        $this->assertTrue(RoleEnum::isValid('SuperAdmin'));
        $this->assertTrue(RoleEnum::isValid('Admin'));
        $this->assertTrue(RoleEnum::isValid('User'));
        $this->assertFalse(RoleEnum::isValid('invalid'));
    }

    public function test_enum_descriptions()
    {
        $this->assertEquals('No leído', MessageStatusEnum::getDescription('unread'));
        $this->assertEquals('Leído', MessageStatusEnum::getDescription('read'));
        $this->assertEquals('Archivado', MessageStatusEnum::getDescription('archived'));
        $this->assertNull(MessageStatusEnum::getDescription('invalid'));

        $this->assertEquals('Borrador', NewsStatusEnum::getDescription('draft'));
        $this->assertEquals('Publicado', NewsStatusEnum::getDescription('published'));
        $this->assertEquals('Programado', NewsStatusEnum::getDescription('scheduled'));

        $this->assertEquals('Aprendiz', GradeLevelEnum::getDescription('Aprendiz'));
        $this->assertEquals('Compañero', GradeLevelEnum::getDescription('Compañero'));
        $this->assertEquals('Maestro', GradeLevelEnum::getDescription('Maestro'));
        $this->assertEquals('Todos', GradeLevelEnum::getDescription('Todos'));

        $this->assertEquals('Super Administrador', RoleEnum::getDescription('SuperAdmin'));
        $this->assertEquals('Administrador', RoleEnum::getDescription('Admin'));
        $this->assertEquals('Usuario', RoleEnum::getDescription('User'));
    }

    public function test_enum_values_and_keys()
    {
        $messageStatusValues = MessageStatusEnum::values();
        $this->assertContains('unread', $messageStatusValues);
        $this->assertContains('read', $messageStatusValues);
        $this->assertContains('archived', $messageStatusValues);

        $messageStatusKeys = MessageStatusEnum::keys();
        $this->assertContains('UNREAD', $messageStatusKeys);
        $this->assertContains('READ', $messageStatusKeys);
        $this->assertContains('ARCHIVED', $messageStatusKeys);
    }
}