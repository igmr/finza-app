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

    <form>
        @method('POST')
        @csrf
        <div @class(['nk-block-head', 'nk-block-head-sm'])>
            <div @class(['nk-block-between'])>
                <div @class(['nk-block-head-content'])>
                    <h3 @class(['nk-block-title', 'page-title'])>{{ $subtitle }}</h3>
                </div><!-- .nk-block-head-content -->
                <div @class(['nk-block-head-content'])>
                    <div @class(['toggle-wrap', 'nk-block-tools-toggle'])>
                        <a href="{{ route('app.category.index') }}" @class(['btn', 'btn-sm', 'btn-dim', 'btn-secondary'])>
                            <em @class(['icon', 'ni', 'ni-chevrons-left'])></em>
                            <span>Back</span>
                        </a>
                        <button type="submit" @class(['btn', 'btn-sm', 'btn-dim', 'btn-success'])>
                            <em @class(['icon', 'ni', 'ni-save'])></em>
                            <span>Save</span>
                        </button>
                    </div>
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- ./Subtitle -->

        <div @class(['pt-3', 'd-none']) id="alert-error">
            <div @class(['gy-4'])>
                <div @class(['example-alert'])>
                    <div @class(['alert', 'alert-danger']) id="list-error">
                    </div>
                </div>
            </div>
        </div><!-- #alert-error -->

        <div @class(['nk-block'])>
            <div @class(['row', 'g-gs'])>
                <div @class(['col-lg-8'])>
                    <div @class(['card', 'card-bordered', 'h-100'])>
                        <div @class(['card-inner'])>
                            <div @class(['card-head'])>
                                <h5 @class(['card-title'])>Info general</h5>
                            </div>
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="gender">Gender</label>
                                <div @class(['form-control-wrap'])="">
                                    <select @class(['form-select']) name='gender' id='gender' data-search="on">
                                    </select>
                                </div>
                            </div>
                            <!-- .Gender -->
                            <div @class(['row'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="code">Code</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-code-download'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="code"
                                                placeholder="CAT-0001" name="code">
                                        </div>
                                    </div>
                                </div>
                                <!-- .code -->
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="name">Name</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-list-thumb'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="name"
                                                placeholder="Category-0001" name="name">
                                        </div>
                                    </div>
                                </div>
                                <!-- .name -->
                            </div>
                        </div>
                    </div>
                </div>

                <div @class(['col-lg-4'])>
                    <div @class(['card', 'card-bordered', 'h-100'])>
                        <div @class(['card-inner'])>
                            <div @class(['card-head'])>
                                <h5 @class(['card-title'])>Information Additional</h5>
                            </div>
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="observation">Observation</label>
                                <div @class(['form-control-wrap'])>
                                    <div @class(['form-icon', 'form-icon-left'])>
                                        <em @class(['icon', 'ni', 'ni-comments'])></em>
                                    </div>
                                    <textarea @class(['form-control']) id="observation" placeholder="Observation the category" name="observation"></textarea>
                                </div>
                            </div>
                            <!-- .Observation -->
                        </div>
                    </div>
                </div>
                <!-- .Information additional -->
            </div>
        </div><!-- .nk-block -->
    </form>

</x-layout.master>
