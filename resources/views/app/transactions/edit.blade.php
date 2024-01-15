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
                        <a href="{{ route('app.transaction.index') }}" @class(['btn', 'btn-sm', 'btn-dim', 'btn-secondary'])>
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

        <div class="nk-block">
            <div @class(['row', 'g-gs'])>
                <div @class(['col-lg-8'])>
                    <div @class(['card', 'card-bordered', 'h-100'])>
                        <div @class(['card-inner'])>
                            <div @class(['card-head'])>
                                <h5 @class(['card-title'])> {{ $subtitle }}</h5>
                            </div>
                            <div @class(['row'])>
                                <div @class(['col-sm-12'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="amount">Amount</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-sign-mxn'])></em>
                                            </div>
                                            <input type="text" @class(['form-control', 'text-right']) id="amount"
                                                placeholder="100.00" name="amount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .Amount -->
                            <div @class(['row'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="concept">Concept</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-link-group'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="concept"
                                                placeholder="Transaction" name="concept">
                                        </div>
                                    </div>
                                </div>
                                <!-- .Concept -->
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="reference">Reference</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-report-profit'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="reference"
                                                placeholder="0000-00-00" name="reference">
                                        </div>
                                    </div>
                                </div>
                                <!-- .Reference -->
                            </div>
                            <div @class(['row'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="account_from">Account from</label>
                                        <div @class(['form-control-wrap'])>
                                            <select @class(['form-select']) name='account_from' id='account_from'
                                                data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- .Classification -->
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="account_to">Account to</label>
                                        <div @class(['form-control-wrap'])>
                                            <select @class(['form-select']) name='account_to' id='account_to'
                                                data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- .Account -->
                            </div>
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="description">Description</label>
                                <div @class(['form-control-wrap'])>
                                    <div @class(['form-icon', 'form-icon-left'])>
                                        <em @class(['icon', 'ni', 'ni-panel'])></em>
                                    </div>
                                    <textarea @class(['form-control']) id="description" placeholder="Description of transaction" name="description"></textarea>
                                </div>
                            </div>
                            <!-- .Description -->
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
                                <label @class(['form-label']) for="classification">Classification</label>
                                <div @class(['form-control-wrap'])>
                                    <select @class(['form-select']) name='classification' id='classification'
                                        data-search="on">
                                    </select>
                                </div>
                            </div>
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="category">Category</label>
                                <div @class(['form-control-wrap'])>
                                    <select @class(['form-select']) name='category' id='category'
                                        data-search="on">
                                    </select>
                                </div>
                            </div>
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="saving">Saving</label>
                                <div @class(['form-control-wrap'])>
                                    <select @class(['form-select']) name='saving' id='saving'
                                        data-search="on">
                                    </select>
                                </div>
                            </div>
                            <!-- .Saving -->
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="debt">Debt</label>
                                <div @class(['form-control-wrap'])>
                                    <select @class(['form-select']) name='debt' id='debt'
                                        data-search="on">
                                    </select>
                                </div>
                            </div>
                            <!-- .Debt -->
                            <div @class(['form-group'])>
                                <label @class(['form-label']) for="observation">Observation</label>
                                <div @class(['form-control-wrap'])>
                                    <div @class(['form-icon', 'form-icon-left'])>
                                        <em @class(['icon', 'ni', 'ni-comments'])></em>
                                    </div>
                                    <textarea @class(['form-control']) id="observation" placeholder="Observation of transaction" name="observation"></textarea>
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
