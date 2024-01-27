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
            <form id="formDelete">
                <input type="hidden" id="id" name="id">
                @csrf
                <div @class(['nk-block-between'])>
                    <div @class(['nk-block-head-content'])>
                        <h3 @class(['nk-block-title', 'page-title'])>{{ $subtitle }}</h3>
                    </div><!-- .nk-block-head-content -->
                    <div @class(['nk-block-head-content', 'btn-group'])>
                        <button type="button" id="btnBack" @class(['btn', 'btn-sm', 'btn-dim', 'btn-secondary', 'ml-2'])>
                            <em @class(['icon', 'ni', 'ni-chevrons-left'])></em>
                            <span>Back</span>
                        </button>
                        <button type="button" id="btnEdit" @class(['btn', 'btn-sm', 'btn-dim', 'btn-warning', 'ml-2'])>
                            <em @class(['icon', 'ni', 'ni-pen'])></em>
                            <span>Edit</span>
                        </button>
                        <button type="button" id="btnRestore" @class(['btn', 'btn-sm', 'btn-dim', 'btn-primary', 'ml-2', 'd-none'])>
                            <em @class(['icon', 'ni', 'ni-swap-alt-fill'])></em>
                            <span>Restore</span>
                        </button>
                        <button type="submit" id="btnDelete" @class(['btn', 'btn-sm', 'btn-dim', 'btn-danger', 'ml-2', 'd-none'])>
                            <em @class(['icon', 'ni', 'ni-trash-alt'])></em>
                            <span>Delete</span>
                        </button>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </form>

            <div @class(['pt-3', 'd-none']) id="alert-error">
                <div @class(['gy-4'])>
                    <div @class(['example-alert'])>
                        <div @class(['alert', 'alert-danger']) id="list-error">
                        </div>
                    </div>
                </div>
            </div><!-- #alert-success -->

            <div @class(['pt-3', 'd-none']) id="alert-success">
                <div @class(['gy-4'])>
                    <div @class(['example-alert'])>
                        <div @class(['alert', 'alert-success']) id="list-success">
                        </div>
                    </div>
                </div>
            </div><!-- #alert-success -->
        </div><!-- .nk-block-head -->

        <div @class(['nk-block'])>
            <div @class(['row', 'g-gs'])>
                <div @class(['col-12'])>
                    <div @class(['card', 'card-bordered', 'pricing', 'text-center'])>
                        <div @class(['pricing-body'])>
                            <div style="font-size: 80px">
                                <em @class(['icon', 'ni', 'ni-wallet-saving'])></em>
                            </div>
                            <div @class(['pricing-title', 'w-220px', 'mx-auto'])>
                                <h4 class="title" id="name">name</h4>
                                <span class="badge badge-dot badge-primary" id="status">status</span>
                            </div>
                            <div @class(['pricing-amount'])>
                                <div @class(['amount'])>$0 <span>/MXN</span></div>
                            </div>
                        </div>
                    </div><!-- .pricing -->
                </div><!-- .col -->
                <div class="col-md-12">
                    <div @class(['card', 'card-preview'])>
                        <div @class(['card-inner'])>
                            <table @class(['info', 'nowrap', 'table']) data-export-title="Export">
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div><!-- .col -->
            </div>
        </div><!-- .nk-block -->
    </div>

</x-layout.master>
