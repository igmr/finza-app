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
            <form>
                @csrf
                <div @class(['nk-block-between'])>
                    <div @class(['nk-block-head-content'])>
                        <h3 @class(['nk-block-title', 'page-title'])>{{ $subtitle }}</h3>
                    </div><!-- .nk-block-head-content -->
                    <div @class(['nk-block-head-content'])>
                        <a href="{{ route('app.budget.index') }}" @class(['btn', 'btn-sm', 'btn-dim', 'btn-secondary'])>
                            <em @class(['icon', 'ni', 'ni-chevrons-left'])></em>
                            <span>Back</span>
                        </a>
                        <button type="submit" @class(['btn', 'btn-sm', 'btn-dim', 'btn-success'])>
                            <em @class(['icon', 'ni', 'ni-save'])></em>
                            <span>Save</span>
                        </button>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->

                <div @class(['pt-3', 'd-none']) id="alert-error">
                    <div @class(['gy-4'])>
                        <div @class(['example-alert'])>
                            <div @class(['alert', 'alert-danger']) id="list-error">
                            </div>
                        </div>
                    </div>
                </div><!-- #alert-error -->

                <div @class(['card', 'card-preview', 'mt-3'])>
                    <div @class(['card-inner'])>
                        <div class="preview-block">
                            <!-- account - name - amount - period - observation -->
                            <span @class(['preview-title-lg', 'overline-title'])></span>
                            <div @class(['row', 'gy-4'])>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="account">Account</label>
                                        <div @class(['form-control-wrap'])>
                                            <select @class(['form-select']) name='account' id='account' data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="period">Period</label>
                                        <div @class(['form-control-wrap'])>
                                            <select @class(['form-select']) name='period' id='period' data-search="on">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="name">Name</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-building'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="name"
                                                placeholder="Budget-001" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div @class(['col-sm-6'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="amount">Amount</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-building'])></em>
                                            </div>
                                            <input type="text" @class(['form-control']) id="amount"
                                                placeholder="100.00" name="amount">
                                        </div>
                                    </div>
                                </div>
                                <div @class(['col-sm-12'])>
                                    <div @class(['form-group'])>
                                        <label @class(['form-label']) for="observation">Observation</label>
                                        <div @class(['form-control-wrap'])>
                                            <div @class(['form-icon', 'form-icon-left'])>
                                                <em @class(['icon', 'ni', 'ni-comments'])></em>
                                            </div>
                                            <textarea @class(['form-control']) id="observation" placeholder="Observation the budget" name="observation"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- .nk-block-head -->
    </div>
</x-layout.master>
