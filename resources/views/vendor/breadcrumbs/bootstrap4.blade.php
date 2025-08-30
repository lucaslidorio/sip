@unless ($breadcrumbs->isEmpty())
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
{{-- 
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif --}}

            @endforeach

            @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item">
              <a href="{{ $breadcrumb->url }}">
                @if (!empty($breadcrumb->data['icon']))
                  <i class="{{ $breadcrumb->data['icon'] }} me-1"></i>
                @endif
                {{ $breadcrumb->title }}
              </a>
            </li>
          @else
            <li class="breadcrumb-item active" aria-current="page">
              @if (!empty($breadcrumb->data['icon']))
                <i class="{{ $breadcrumb->data['icon'] }} me-1"></i>
              @endif
              {{ $breadcrumb->title }}
            </li>
          @endif
        </ol>
    </nav>
@endunless
