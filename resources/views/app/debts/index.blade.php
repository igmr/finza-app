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
                <div @class(['nk-block-head-content'])>
                    <button id="reload" @class(['btn', 'btn-sm', 'btn-dim', 'btn-outline-warning'])>
                        <em class="icon ni ni-reload-alt"></em>
                    </button>
                    <a href="{{ route('app.debt.create') }}" @class(['btn', 'btn-sm', 'btn-dim', 'btn-outline-primary'])>
                        <em class="icon ni ni-plus"></em>
                        <span>Add debt</span>
                    </a>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div @class(['nk-block'])>
            <div @class(['card', 'card-bordered', 'card-stretch'])>
                <div @class(['card-inner-group'])>
                    <div @class(['card-inner', 'p-1'])>
                        <div @class(['nk-tb-list', 'nk-tb-ulist', 'is-compact']) id="detail-list">
                        </div><!-- .nk-tb-list -->
                    </div><!-- .card-inner -->
                    <div @class(['card-inner'])>
                        <ul @class([
                            'pagination',
                            'justify-content-center',
                            'justify-content-md-start',
                            'reload-pagination',
                        ])>
                        </ul><!-- .pagination -->
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
</x-layout.master>
