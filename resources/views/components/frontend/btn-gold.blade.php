 @props([
    'href'  => '#',
    'icon'  => 'fas fa-arrow-right',
    'label' => 'Selengkapnya',
])

<a href="{{ $href }}" class="btn-gold">
    <i class="{{ $icon }}"></i> {{ $label }}
</a>