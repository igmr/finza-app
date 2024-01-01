<div @class(['nk-aside']) data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg"
    data-toggle-body="true">
    <div @class(['nk-sidebar-menu']) data-simplebar>
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
                        <a href="{{ route('app.debt.index') }}" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Debts</span>
                        </a>
                    </li>
                    <li @class(['nk-menu-item'])>
                        <a href="{{ route('app.saving.index') }}" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Savings</span>
                        </a>
                    </li>
                    <li @class(['nk-menu-item'])>
                        <a href="{{ route('app.budget.index') }}" @class(['nk-menu-link'])>
                            <span @class(['nk-menu-text'])>Dudgets</span>
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
        </ul><!-- .nk-menu -->
    </div><!-- .nk-sidebar-menu -->
    <div @class(['nk-aside-close'])>
        <a href="#" class="toggle" data-target="sideNav">
            <em @class(['icon', 'ni', 'ni-cross'])></em>
        </a>
    </div><!-- .nk-aside-close -->
</div><!-- .nk-aside -->
