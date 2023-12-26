<div @class(['nk-header ', 'nk-header-fixed', 'is-light'])>
    <div @class(['container-lg', 'wide-xl'])>
        <div @class(['nk-header-wrap'])>
            <div @class(['nk-header-brand'])>
                <a href="{{ route('dashboard') }}" @class(['logo-link'])>
                    <img @class(['logo-light', 'logo-img', 'logo-img-lg']) src="{{ url('assets/images/logo.png') }}"
                        srcset="{{ url('assets/images/logo2x.png') }} 2x" alt="logo">
                    <img @class(['logo-dark', 'logo-img', 'logo-img-lg']) src="{{ url('assets/images/logo-dark.png') }}"
                        srcset="{{ url('assets/images/logo-dark2x.png') }} 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div @class(['nk-header-menu'])>
                <ul @class(['nk-menu', 'nk-menu-main'])>
                    <li @class(['nk-menu-item'])>
                        <a href="{{ route('dashboard') }}" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li @class(['nk-menu-item'])>
                        <a href="#" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Egress</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li @class(['nk-menu-item'])>
                        <a href="#" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Ingress</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li @class(['nk-menu-item', 'has-sub'])>
                        <a href="#" @class(['nk-menu-link', 'nk-menu-toggle'])>
                            <span @class(['nk-menu-text'])>Operations</span>
                        </a>
                        <ul @class(['nk-menu-sub'])>
                            <li @class(['nk-menu-item'])>
                                <a href="#" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Debts</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="#" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Savings</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="#" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Dudgets</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="#" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Accounts</span>
                                </a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li @class(['nk-menu-item', 'has-sub'])>
                        <a href="#" @class(['nk-menu-link', 'nk-menu-toggle'])>
                            <span @class(['nk-menu-text'])>Catalogs</span>
                        </a>
                        <ul @class(['nk-menu-sub'])>
                            <li @class(['nk-menu-item'])>
                                <a href="{{ route('app.bank.index') }}" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Banks</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="{{ route('app.account.index') }}" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Accounts</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="{{ route('app.gender.index') }}" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Genders</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="{{ route('app.category.index') }}" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Categories</span>
                                </a>
                            </li>
                            <li @class(['nk-menu-item'])>
                                <a href="{{ route('app.classification.index') }}" @class(['nk-menu-link'])>
                                    <span @class(['nk-menu-text'])>Classifications</span>
                                </a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div @class(['nk-header-tools'])>
                <ul @class(['nk-quick-nav'])>
                    <li @class(['dropdown', 'user-dropdown'])>
                        <a href="#" @class(['dropdown-toggle', 'mr-lg-n1']) data-toggle="dropdown">
                            <div @class(['user-toggle'])>
                                <div @class(['user-avatar', 'sm'])>
                                    <em @class(['icon', 'ni', 'ni-user-alt'])></em>
                                </div>
                            </div>
                        </a>
                        <div @class([
                            'dropdown-menu',
                            'dropdown-menu-md',
                            'dropdown-menu-right',
                            'dropdown-menu-s1',
                        ])>
                            <div @class([
                                'dropdown-inner',
                                'user-card-wrap',
                                'bg-lighter',
                                'd-none',
                                'd-md-block',
                            ])>
                                <div @class(['user-card'])>
                                    <div @class(['user-avatar'])>
                                        <span>AB</span>
                                    </div>
                                    <div @class(['user-info'])>
                                        <span @class(['lead-text'])>Abu Bin Ishtiyak</span>
                                        <span @class(['sub-text'])>info@softnio.com</span>
                                    </div>
                                    <div @class(['user-action'])>
                                        <a @class(['btn', 'btn-icon', 'mr-n2']) href="#">
                                            <em @class(['icon', 'ni', 'ni-setting'])></em>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div @class(['dropdown-inner'])>
                                <ul @class(['link-list'])>
                                    <li>
                                        <a href="#">
                                            <em @class(['icon', 'ni', 'ni-user-alt'])></em>
                                            <span>View Profile</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div @class(['dropdown-inner'])>
                                <ul @class(['link-list'])>
                                    <li>
                                        <a href="#">
                                            <em @class(['icon', 'ni', 'ni-signout'])></em>
                                            <span>Sign out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li @class(['d-lg-none'])>
                        <a href="#" @class(['toggle', 'nk-quick-nav-icon', 'mr-n1']) data-target="sideNav">
                            <em @class(['icon', 'ni', 'ni-menu'])></em>
                        </a>
                    </li>
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
