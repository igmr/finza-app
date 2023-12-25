<x-layout.master>
    @slot('title', $title)
    @slot('customCSS')
        @foreach ($cssFILES as $cssFile)
            <link href="{{ url($cssFile) }}" rel="stylesheet">
        @endforeach
    @endslot
    @slot('customJS')
        @foreach ($jsFILES as $jsFile)
            <script src="{{ url($jsFile) }}"></script>
        @endforeach
    @endslot
    <div @class(['nk-content-wrap'])>
        <div @class(['nk-block-head', 'nk-block-head-md'])>
            <div @class(['nk-block-between'])>
                <div @class(['nk-block-head-content'])>
                    <h3 @class(['nk-block-title', 'page-title'])>{{ $subtitle }}</h3>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
    </div>
</x-layout.master>
