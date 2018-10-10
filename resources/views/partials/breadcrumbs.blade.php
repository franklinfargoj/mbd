@if (count($breadcrumbs))

    <ol class="breadcrumb">
        @php 
            $i=0;
        @endphp
        @foreach ($breadcrumbs as $breadcrumb)
            @if($i==0)
            <li class="breadcrumb-item">
                <a href="{{ $breadcrumb->url }}" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon fa fa-home"></i>
                </a>
            </li>
            @else

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif

            @endif
            @php  $i++;  @endphp 
        @endforeach
    </ol>

@endif