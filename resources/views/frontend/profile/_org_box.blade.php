{{-- Org Chart Node Box --}}
{{-- $node = ['pos'=>'', 'name'=>'', 'photo'=>'', 'level'=>'top|mid|bot'] --}}
{{-- $isTop = bool --}}
<div class="org-box {{ isset($isTop) && $isTop ? 'is-top' : '' }}">
    {{-- Photo --}}
    <div class="org-photo">
        @if(!empty($node['photo']))
            <img src="{{ $node['photo'] }}" alt="{{ $node['name'] }}">
        @else
            <i class="fas fa-user"></i>
        @endif
    </div>
    {{-- Card --}}
    <div class="org-card level-{{ $node['level'] === 'top' ? 'top' : ($node['level'] === 'mid' ? 'mid' : 'bot') }}">
        <div class="pos">{{ $node['pos'] }}</div>
        <div class="name">{{ $node['name'] }}</div>
    </div>
</div>
