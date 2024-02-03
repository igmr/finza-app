<!DOCTYPE html>
<html lang="es" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <!-- <link rel="shortcut icon" href="./images/favicon.png"> -->
    <!-- Page Title  -->
    <title>Login | FinzApp</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" rel="stylesheet" href="{{ url('assets/css/dashlite.css?ver=2.7.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ url('assets/css/skins/theme-egyptian.css?ver=2.7.0') }}">
    <!-- Custom CSS -->
    @foreach ($cssFILES as $cssFile)
        <link href="{{ url($cssFile) }}" rel="stylesheet">
    @endforeach
</head>

<body @class(['nk-body', 'bg-white', 'npc-default', 'pg-auth', 'dark-mode'])>
    <div @class(['nk-app-root'])>
        <!-- main @s -->
        <div @class(['nk-main'])>
            <!-- wrap @s -->
            <div @class(['nk-wrap', 'nk-wrap-nosidebar'])>
                <!-- content @s -->
                <div @class(['nk-content'])>
                    <div @class(['nk-split', 'nk-split-page', 'nk-split-md'])>
                        <div @class([
                            'nk-split-content',
                            'nk-block-area',
                            'nk-block-area-column',
                            'nk-auth-container',
                            'bg-white',
                        ])>
                            <div @class(['nk-block', 'nk-block-middle', 'nk-auth-body'])>
                                <div @class(['brand-logo', 'pb-5'])>
                                    <a href="{{ route('authentication') }}" @class(['logo-link'])>
                                        <img @class(['logo-light', 'logo-img', 'logo-img-lg']) src="{{ url('assets/images/logo.png') }}"
                                            srcset="{{ url('assets/images/logo2x.png') }} 2x" alt="logo">

                                        <img @class(['logo-dark', 'logo-img', 'logo-img-lg'])
                                            src="{{ url('assets/images/logo-dark.png') }}"
                                            srcset="{{ url('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div @class(['nk-block-head'])>
                                    <div @class(['nk-block-head-content'])>
                                        <h5 @class(['nk-block-title'])>Sign-In</h5>
                                    </div>
                                    <div @class(['pt-3', 'd-none']) id="alert-error">
                                        <div @class(['gy-4'])>
                                            <div @class(['example-alert'])>
                                                <div @class(['alert', 'alert-danger'])>
                                                    <div id="list-error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- #alert-error -->
                                </div><!-- .nk-block-head -->
                                <form>
                                    @csrf
                                    <div @class(['form-group'])>
                                        <div @class(['form-label-group'])>
                                            <label @class(['form-label']) for="email">Email</label>
                                        </div>
                                        <div @class(['form-control-wrap'])>
                                            <input type="text" @class(['form-control', 'form-control-lg']) id="email"
                                                name="email" placeholder="Enter your email address"
                                                value="demo@demo.com">
                                        </div>
                                    </div><!-- .form-group -->
                                    <div @class(['form-group'])>
                                        <div @class(['form-label-group'])>
                                            <label @class(['form-label']) for="password">Passcode</label>
                                        </div>
                                        <div @class(['form-control-wrap'])>
                                            <a tabindex="-1" href="#" @class(['form-icon', 'form-icon-right', 'passcode-switch', 'lg'])
                                                data-target="password">
                                                <em @class(['passcode-icon', 'icon-show', 'icon', 'ni', 'ni-eye'])></em>
                                                <em @class(['passcode-icon', 'icon-hide', 'icon', 'ni', 'ni-eye-off'])></em>
                                            </a>
                                            <input type="password" @class(['form-control', 'form-control-lg']) id="password"
                                                name="password" placeholder="Enter your passcode" value="gPassword#321">
                                        </div>
                                    </div><!-- .form-group -->
                                    <div @class(['form-group'])>
                                        <button @class(['btn', 'btn-lg', 'btn-primary', 'btn-block'])>Sign in</button>
                                    </div>
                                </form><!-- form -->
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        <div @class(['nk-split-content', 'nk-split-stretch', 'bg-abstract'])></div><!-- .nk-split-content -->
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ url('assets/js/bundle.js?ver=2.7.0') }}"></script>
    <script src="{{ url('assets/js/scripts.js?ver=2.7.0') }}"></script>
    <script src="{{ url('assets/app/tools.js') }}"></script>
    <script src="{{ url('assets/app/services.js') }}"></script>
    <!-- Custom JS -->
    @foreach ($jsFILES as $jsFile)
        <script src="{{ url($jsFile) }}"></script>
    @endforeach
</body>

</html>
