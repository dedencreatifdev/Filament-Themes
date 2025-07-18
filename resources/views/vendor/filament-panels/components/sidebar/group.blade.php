@props([
    'active' => false,
    'collapsible' => true,
    'icon' => null,
    'items' => [],
    'label' => null,
    'sidebarCollapsible' => true,
    'subNavigation' => false,
])

@php
    $sidebarCollapsible = $sidebarCollapsible && filament()->isSidebarCollapsibleOnDesktop();
    $hasDropdown = filled($label) && filled($icon) && $sidebarCollapsible;
@endphp

@if ($label)
    <li class="nav-item {{ $active ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $active ? 'active' : '' }}">
            @if ($icon)
                @svg($icon, 'mr-1', [
                    'style' => $active ? 'color: #fff;width: 1.3em; height: 1.3em;' : 'color: #6c757d;width: 1.3em; height: 1.3em;',
                ])
            @else
                @svg('heroicon-o-rectangle-stack', 'mr-1', [
                    'style' => $active ? 'color: #fff;width: 1.3em; height: 1.3em;' : 'color: #6c757d;width: 1.3em; height: 1.3em;',
                ])
            @endif

            {{-- <i class="nav-icon fas fa-tachometer-alt"></i> --}}
            <p>
                {{ $label }}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                @foreach ($items as $item)
                    <a {{ \Filament\Support\generate_href_html($item->getUrl(), $item->shouldOpenUrlInNewTab()) }}
                        class="nav-link {{ $active ? 'active' : '' }}">
                        {{-- <i class="far fa-circle nav-icon"></i> --}}

                        @svg('heroicon-o-check-circle', 'mr-1', [
                            'style' => $active ? 'color: #6c757d;width: 1.3em; height: 1.3em;' : 'color: #6c757d;width: 1.3em; height: 1.3em;',
                        ])

                        <p>{{ $item->getLabel() }}</p>
                    </a>
                @endforeach
            </li>
        </ul>
    </li>
@else
    @foreach ($items as $item)
        @php
            $itemIcon = $item->getIcon();
            $itemActiveIcon = $item->getActiveIcon();

            if ($icon) {
                if ($hasDropdown || (blank($itemIcon) && blank($itemActiveIcon))) {
                    $itemIcon = null;
                    $itemActiveIcon = null;
                } else {
                    throw new \Exception(
                        'Navigation group [' .
                            $label .
                            '] has an icon but one or more of its items also have icons. Either the group or its items can have icons, but not both. This is to ensure a proper user experience.',
                    );
                }
            }
        @endphp

        <x-filament-panels::sidebar.item :active="$item->isActive()" :active-child-items="$item->isChildItemsActive()" :active-icon="$itemActiveIcon" :badge="$item->getBadge()"
            :badge-color="$item->getBadgeColor()" :badge-tooltip="$item->getBadgeTooltip()" :child-items="$item->getChildItems()" :first="$loop->first" :grouped="filled($label)" :icon="$itemIcon"
            :last="$loop->last" :should-open-url-in-new-tab="$item->shouldOpenUrlInNewTab()" :sidebar-collapsible="$sidebarCollapsible" :url="$item->getUrl()">
            {{ $item->getLabel() }}

            @if ($itemIcon instanceof \Illuminate\Contracts\Support\Htmlable)
                <x-slot name="icon">
                    {{ $itemIcon }}
                </x-slot>
            @endif

            @if ($itemActiveIcon instanceof \Illuminate\Contracts\Support\Htmlable)
                <x-slot name="activeIcon">
                    {{ $itemActiveIcon }}
                </x-slot>
            @endif
        </x-filament-panels::sidebar.item>
    @endforeach
@endif
