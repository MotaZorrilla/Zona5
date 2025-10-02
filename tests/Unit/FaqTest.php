<?php

namespace Tests\Unit;

use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FaqTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_faq()
    {
        $faq = Faq::create([
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ]);

        $this->assertDatabaseHas('faqs', [
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ]);
    }

    public function test_faq_casts_attributes()
    {
        $faq = Faq::create([
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'category' => 'General',
            'is_active' => '1',
            'order' => '2',
        ]);

        $this->assertTrue($faq->is_active);
        $this->assertIsInt($faq->order);
        $this->assertEquals(2, $faq->order);
    }

    public function test_active_scope()
    {
        Faq::create([
            'question' => 'Active Question',
            'answer' => 'Active Answer',
            'category' => 'General',
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Inactive Question',
            'answer' => 'Inactive Answer',
            'category' => 'General',
            'is_active' => false,
        ]);

        $activeFaqs = Faq::active()->get();
        $this->assertCount(1, $activeFaqs);
        $this->assertEquals('Active Question', $activeFaqs->first()->question);
    }

    public function test_ordered_scope()
    {
        Faq::create([
            'question' => 'First Question',
            'answer' => 'First Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 2,
        ]);

        Faq::create([
            'question' => 'Second Question',
            'answer' => 'Second Answer',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ]);

        $orderedFaqs = Faq::ordered()->get();
        $this->assertEquals('Second Question', $orderedFaqs->first()->question);
        $this->assertEquals('First Question', $orderedFaqs->skip(1)->first()->question);
    }

    public function test_get_by_category_method()
    {
        Faq::create([
            'question' => 'Question 1',
            'answer' => 'Answer 1',
            'category' => 'General',
            'is_active' => true,
            'order' => 1,
        ]);

        Faq::create([
            'question' => 'Question 2',
            'answer' => 'Answer 2',
            'category' => 'General',
            'is_active' => true,
            'order' => 2,
        ]);

        Faq::create([
            'question' => 'Question 3',
            'answer' => 'Answer 3',
            'category' => 'Technical',
            'is_active' => true,
            'order' => 1,
        ]);

        $generalFaqs = Faq::getByCategory('General');
        $this->assertCount(2, $generalFaqs);
        $this->assertEquals('General', $generalFaqs->first()->category);
    }

    public function test_get_categories_method()
    {
        Faq::create([
            'question' => 'Question 1',
            'answer' => 'Answer 1',
            'category' => 'Technical',
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Question 2',
            'answer' => 'Answer 2',
            'category' => 'General',
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Question 3',
            'answer' => 'Answer 3',
            'category' => 'Support',
            'is_active' => true,
        ]);

        $categories = Faq::getCategories();
        $this->assertCount(3, $categories);
        $this->assertContains('General', $categories->toArray());
        $this->assertContains('Technical', $categories->toArray());
        $this->assertContains('Support', $categories->toArray());
    }
}