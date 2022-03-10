
@php
    $prefix = Request::route()->getPrefix();
       $route = Route::current()->getname();
       $app = \App\Models\GeneralSettings::find(1);
@endphp

<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{$app->name}}</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header ">Dashboard</li>
            <li class="{{($route == 'dashboard')?'active': ''}}">
                <a href="{{route('dashboard')}}" class="nav-link {{($route == 'dashboard')?'active': ''}}"><span>Dashboard</span></a>

            </li>
            <li class="{{($route == 'general_settings')?'active': ''}}">
                <a href="{{route('general_settings')}}" class="nav-link {{($route == 'general_settings')?'active': ''}}"><span>General Settings</span></a>

            </li>
            <li class="{{($route == 'users')?'active': ''}}">
                <a href="{{route('users')}}" class="nav-link {{($route == 'users')?'active': ''}}"><span>Users</span></a>

            </li>
            <li class="menu-header">Starter</li>
            <li class="nav-item dropdown
                {{($route == 'njangi_groups')?'active': ''}}
                {{($route == 'investment_group')?'active': ''}}
                ">
                <a href="" class="nav-link has-dropdown {{($route == 'njangi_groups')?'open': ''}}{{($route == 'investment_group')?'open': ''}}"><i class="fa fa-users"></i> <span>Groups</span></a>
                <ul class="dropdown-menu">
                    <li class="{{($route == 'njangi_groups')?'active': ''}}"><a class="nav-link {{($route == 'njangi_groups')?'active': ''}}" href="{{route('njangi_groups')}}">Njangi Groups</a></li>
                    <li class="{{($route == 'investment_group')?'active': ''}}"><a class="nav-link {{($route == 'investment_group')?'active': ''}}" href="{{route('investment_group')}}">Investment Groups</a></li>

                </ul>
            </li>
            <li class="nav-item dropdown

{{($route == 'general_settings')?'active': ''}}
            {{($route == 'about')?'active': ''}}
            {{($route == 'social')?'active': ''}}
                ">
                <a href="#" class="nav-link has-dropdown  {{($route == 'general_settings')?'open': ''}}{{($route == 'social')?'open': ''}}
                {{($route == 'about')?'open': ''}}"><i class="fas fa-cogs"></i><span>App details</span></a>
                <ul class="dropdown-menu ">
                    <li class="{{($route == 'about')?'active': ''}}"><a class="nav-link {{($route == 'about')?'active': ''}}" href="{{route('about')}}">App Details</a></li>
                    <li class="{{($route == 'social')?'active': ''}}"><a class="nav-link {{($route == 'social')?'active': ''}}" href="{{route('social')}}">Social Details</a></li>

                </ul>
            </li>

        </ul>

{{--        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">--}}
{{--            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">--}}
{{--                <i class="fas fa-rocket"></i> Documentation--}}
{{--            </a>--}}
{{--        </div>--}}
    </aside>
</div>
