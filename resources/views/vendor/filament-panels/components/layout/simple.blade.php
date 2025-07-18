@php
    use Filament\Support\Enums\MaxWidth;

    $livewire ??= null;
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

</x-filament-panels::layout.base>
