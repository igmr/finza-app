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
                <form id="formDelete">
                    <input type="hidden" id="id" name="id">
                    @csrf
                    <div @class(['nk-block-head-content', 'row'])>
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
                </form>
            </div><!-- .nk-block-between -->

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
                    <div @class(['card', 'card-bordered'])>
                        <div @class(['card-inner'])>
                            <div @class(['team'])>
                                <div @class(['user-card', 'user-card-s2'])>
                                    <div @class(['user-avatar', 'lg', 'bg-primary'])>
                                        <em @class(['icon', 'ni', 'ni-building'])></em>
                                        <div @class(['status', 'dot', 'dot-lg']) id="status"></div>
                                    </div>
                                    <div @class(['user-info'])>
                                        <h6 id="name">name</h6>
                                        <span @class(['sub-text']) id="bank">bank</span>
                                    </div>
                                </div>
                                <div @class(['team-details'])>
                                    <p id="observation">observation</p>
                                </div>
                            </div><!-- .team -->
                        </div><!-- .card-inner -->
                    </div><!-- .card -->
                </div><!-- .col -->
            </div>
        </div><!-- .nk-block -->
    </div>
</x-layout.master>
