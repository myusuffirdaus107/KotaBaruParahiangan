 @props([
    'icon'     => 'fas fa-circle',
    'label'    => '',
    'title'    => '',
    'subtitle' => '',
    'dark'     => false,
    'center'   => false,
])

<div class="{{ $center ? 'text-center' : '' }} mb-2">
    @if($label)
        <span class="s-label"
            @if($dark) style="background:rgba(255,255,255,.1);border-color:rgba(255,255,255,.2);color:rgba(255,255,255,.7);" @endif>
            <i class="{{ $icon }} fa-xs"></i> {{ $label }}
        </span>
    @endif

    <h2 class="s-title" @if($dark) style="color:#fff;" @endif>
        {!! $title !!}
    </h2>

    @if($subtitle)
        <p class="{{ $dark ? 'text-white-50' : 'text-muted' }}" style="font-size:.9rem;">
            {{ $subtitle }}
        </p>
    @endif

    <div class="s-line"
        @if($dark && $center) style="background:linear-gradient(90deg,var(--gold),var(--gold2));margin-left:auto;margin-right:auto;"
        @elseif($dark)        style="background:linear-gradient(90deg,var(--gold),var(--gold2));"
        @elseif($center)      style="margin-left:auto;margin-right:auto;"
        @endif>
    </div>
</div>