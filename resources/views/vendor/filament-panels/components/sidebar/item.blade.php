@props([
    'active' => false,
    'activeChildItems' => false,
    'activeIcon' => null,
    'badge' => null,
    'badgeColor' => null,
    'badgeTooltip' => null,
    'childItems' => [],
    'first' => false,
    'grouped' => false,
    'icon' => null,
    'last' => false,
    'shouldOpenUrlInNewTab' => false,
    'sidebarCollapsible' => true,
    'subGrouped' => false,
    'url',
])

@php
    $sidebarCollapsible = $sidebarCollapsible && filament()->isSidebarCollapsibleOnDesktop();
@endphp

{{-- {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }} --}}

<li class="nav-item">
    <a {{ \Filament\Support\generate_href_html($url, $shouldOpenUrlInNewTab) }} class="nav-link {{ $active ? 'active' : '' }}">
        {{-- <i class="nav-icon fas {{ $icon }}"></i> --}}

        @svg($icon, 'mr-1', [
            'style' => $active ? 'color: #fff;width: 1.3em; height: 1.3em;' : 'color: #6c757d;width: 1.3em; height: 1.3em;'
        ])

        <p>
            {{ $slot }}
            <span class="right badge badge-danger">New</span>
        </p>
    </a>
</li>
