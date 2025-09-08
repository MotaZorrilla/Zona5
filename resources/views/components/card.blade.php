<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-md overflow-hidden h-full flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1 hover:shadow-xl']) }}>
    {{ $slot }}
</div>