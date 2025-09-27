@props(['category' => null])

@php
    use App\Models\Faq;

    try {
        if ($category) {
            $faqs = Faq::getByCategory($category);
        } else {
            $faqs = Faq::active()->ordered()->get();
        }

        $categories = Faq::getCategories();
    } catch (\Exception $e) {
        $faqs = collect();
        $categories = collect();
    }
@endphp

<div class="max-w-4xl mx-auto py-16">
    @if($categories->isNotEmpty())
        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-2 mb-12" data-scroll-reveal>
            <button class="faq-filter px-4 py-2 text-sm font-medium rounded-full transition-colors {{ !$category ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                    data-category="all">
                Todas
            </button>
            @foreach($categories as $cat)
                <button class="faq-filter px-4 py-2 text-sm font-medium rounded-full transition-colors {{ $category == $cat ? 'bg-primary-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                        data-category="{{ $cat }}">
                    {{ $cat }}
                </button>
            @endforeach
        </div>
    @endif

    <!-- FAQ Items -->
    <div class="space-y-4" id="faq-container">
        @forelse($faqs as $faq)
            <div class="faq-item bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden {{ $category ? ($faq->category === $category ? '' : 'hidden') : '' }}"
                 data-category="{{ $faq->category }}">
                <button class="faq-question w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition-colors"
                        onclick="toggleFaq(this)">
                    <span class="text-lg font-semibold text-gray-900">{{ $faq->question }}</span>
                    <i class="ri-add-line text-xl text-primary-600 transition-transform duration-200"></i>
                </button>
                <div class="faq-answer hidden px-6 pb-4">
                    <div class="pt-2 border-t border-gray-200">
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <i class="ri-question-line text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No hay preguntas frecuentes</h3>
                <p class="text-gray-500">
                    @if($category)
                        No se encontraron preguntas en la categoría "{{ $category }}".
                    @else
                        Aún no hay preguntas frecuentes registradas.
                    @endif
                </p>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Filter functionality
    const filterButtons = document.querySelectorAll('.faq-filter');
    const faqItems = document.querySelectorAll('.faq-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');

            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-primary-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            this.classList.remove('bg-gray-200', 'text-gray-700');
            this.classList.add('bg-primary-600', 'text-white');

            // Filter FAQ items
            if (category === 'all') {
                faqItems.forEach(item => {
                    item.style.display = 'block';
                });
            } else {
                faqItems.forEach(item => {
                    if (item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    });
});

function toggleFaq(button) {
    const faqItem = button.closest('.faq-item');
    const answer = faqItem.querySelector('.faq-answer');
    const icon = button.querySelector('i');

    const isOpen = answer.style.display !== 'none';

    // Close all other FAQs
    document.querySelectorAll('.faq-answer').forEach(ans => {
        if (ans !== answer) {
            ans.style.display = 'none';
            const btn = ans.closest('.faq-item').querySelector('.faq-question i');
            if (btn) {
                btn.className = 'ri-add-line text-xl text-primary-600';
            }
        }
    });

    // Toggle current FAQ
    if (isOpen) {
        answer.style.display = 'none';
        icon.className = 'ri-add-line text-xl text-primary-600';
    } else {
        answer.style.display = 'block';
        icon.className = 'ri-subtract-line text-xl text-primary-600';
    }
}
</script>

<style>
.faq-question:hover {
    background-color: #f9fafb;
}

.faq-answer {
    transition: all 0.3s ease;
    overflow: hidden;
}

.faq-item {
    margin-bottom: 1rem;
}
</style>
