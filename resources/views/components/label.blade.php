@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-gray-500 font-bold upppercase mb-2']) }}>
    {{ $value ?? $slot }}
</label>
