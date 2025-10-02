<?php

namespace Tests\Unit;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_setting()
    {
        $setting = Setting::create([
            'key' => 'test_key',
            'value' => 'test_value',
        ]);

        $this->assertDatabaseHas('settings', [
            'key' => 'test_key',
            'value' => 'test_value',
        ]);
    }

    public function test_get_method()
    {
        Setting::create([
            'key' => 'test_key',
            'value' => 'test_value',
        ]);

        $value = Setting::get('test_key');
        $this->assertEquals('test_value', $value);

        $defaultValue = Setting::get('nonexistent_key', 'default');
        $this->assertEquals('default', $defaultValue);
    }

    public function test_set_method_creates_new_setting()
    {
        Setting::set('new_key', 'new_value');

        $this->assertDatabaseHas('settings', [
            'key' => 'new_key',
            'value' => 'new_value',
        ]);
    }

    public function test_set_method_updates_existing_setting()
    {
        Setting::create([
            'key' => 'existing_key',
            'value' => 'old_value',
        ]);

        Setting::set('existing_key', 'new_value');

        $this->assertDatabaseHas('settings', [
            'key' => 'existing_key',
            'value' => 'new_value',
        ]);
    }

    public function test_json_value_handling()
    {
        $arrayValue = ['name' => 'John', 'age' => 30];
        Setting::set('json_key', $arrayValue);

        $retrievedValue = Setting::get('json_key');
        $this->assertEquals($arrayValue, $retrievedValue);
    }

    public function test_string_value_handling()
    {
        Setting::set('string_key', 'simple_string');

        $retrievedValue = Setting::get('string_key');
        $this->assertEquals('simple_string', $retrievedValue);
    }

    public function test_setting_attributes()
    {
        $setting = Setting::create([
            'key' => 'attribute_test',
            'value' => 'attribute_value',
        ]);

        $this->assertEquals('attribute_test', $setting->key);
        $this->assertEquals('attribute_value', $setting->value);
    }
}