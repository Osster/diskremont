@if(!isset($innerLoop))
<nav class="d-flex flex-wrap footer-nav col-md-12 px-0">
@else
<nav class="dropdown-menu">
@endif

@php

    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }

@endphp

@foreach ($items as $item)
    
    @php
    
        $originalItem = $item;
        if (Voyager::translatable($item)) {
            $item = $item->translate($options->locale);
        }

        $listItemClass = null;
        $linkAttributes =  null;
        $styles = null;
        $icon = null;
        $caret = null;

        // Background Color or Color
        if (isset($options->color) && $options->color == true) {
            $styles = 'color:'.$item->color;
        }
        if (isset($options->background) && $options->background == true) {
            $styles = 'background-color:'.$item->color;
        }

        // With Children Attributes
        if(!$originalItem->children->isEmpty()) {
            $linkAttributes =  'class="dropdown-toggle" data-toggle="dropdown"';
            $caret = '<span class="caret"></span>';

            if(url($item->link()) == url()->current()){
                $listItemClass = 'dropdown active';
            }else{
                $listItemClass = 'dropdown';
            }
        }

        // Set Icon
        if(isset($options->icon) && $options->icon == true){
            $icon = '<i class="' . $item->icon_class . '"></i>';
        }
        
    @endphp

    <li class="footer-nav-li {{ $listItemClass }}">
        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}" class="footer-nav-a {{ $item->icon_class }}" {!! $linkAttributes or '' !!}>
            {!! $icon !!}
            <span>{{ $item->title }}</span>
            {!! $caret !!}
        </a>
        @if(!$originalItem->children->isEmpty())
        @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
        @endif
    </li>
@endforeach

</nav>
