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
                        <button type="button" id="btnBack" @class(['btn', 'btn-sm', 'btn-dim', 'btn-secondary'])>
                            <em @class(['icon', 'ni', 'ni-chevrons-left'])></em>
                            <span>Back</span>
                        </button>
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

        <div class="nk-block">
            <div @class(['row', 'g-gs'])>
                <div @class(['col-lg-8'])>
                    <div @class(['card', 'card-bordered', 'h-100'])>
                        <div @class(['card-inner'])>
                            <div @class(['card-head'])>
                                <h5 @class(['card-title'])>Info general</h5>
                            </div>
                            <div @class(['row'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="category">Category</label>
                                        <div @class(['form-control-wrap'])="">
                                            <select @class(['form-select']) name='category' id='category'
                                                data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- .category -->
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="period">Period</label>
                                        <div @class(['form-control-wrap'])="">
                                            <select @class(['form-select']) name='period' id='period'
                                                data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- .period -->
                            </div>
                            <!-- .category | .period -->
                            <div @class(['row'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="name">Name</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-bag-fill'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="name"
                                                placeholder="Debt-0001" name="name">
                                        </div>
                                    </div>
                                </div>
                                <!-- .category -->
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="amount">Amount</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-sign-mxn'])></em>
                                            </div>
                                            <input type="text" @class(['form-control', 'text-right']) id="amount"
                                                placeholder="5000" name="amount">
                                        </div>
                                    </div>
                                </div>
                                <!-- .period -->
                            </div>
                            <!-- .name | .amount -->
                        </div>
                    </div>
                </div>
                <!-- Info general -->
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
                                    <textarea @class(['form-control']) id="observation" placeholder="Observation the debt" name="observation"></textarea>
                                </div>
                            </div>
                            <!-- .observation -->
                        </div>
                    </div>
                </div>
                <!-- .Information additional -->
            </div>
        </div><!-- .nk-block -->
    </form>

</x-layout.master>
