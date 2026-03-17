 @props(['status' => 'available'])

@php
    $map = [
        'available' => ['class' => 'avail', 'label' => 'Tersedia'],
        'sold'      => ['class' => 'sold',  'label' => 'Sold Out'],
        'soon'      => ['class' => 'soon',  'label' => 'Coming Soon'],
        'active'    => ['class' => 'aktif', 'label' => 'Tersedia'],
    ];
    $cfg = $map[$status] ?? $map['available'];
@endphp

<span class="pill {{ $cfg['class'] }}">{{ $cfg['label'] }}</span>