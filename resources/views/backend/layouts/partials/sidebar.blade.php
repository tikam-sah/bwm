 <!-- sidebar menu area start -->
 @php
     $usr = Auth::guard('admin')->user();
 @endphp
 <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2> 
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    
                    @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                     @if ($usr->can('groups.create') || $usr->can('groups.view') ||  $usr->can('groups.edit') ||  $usr->can('groups.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-envelope"></i><span>
                             Groups
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.groups.create') || Route::is('admin.groups.index') || Route::is('admin.groups.edit') || Route::is('admin.groups.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('groups.view'))
                                <li class="{{ Route::is('admin.groups.index')  || Route::is('admin.groups.edit') ? 'active' : '' }}"><a href="{{ route('admin.groups.index') }}">Contact Groups</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                     @if ($usr->can('contacts.create') || $usr->can('contacts.view') ||  $usr->can('contacts.edit') ||  $usr->can('contacts.delete') 
                     ||  $usr->can('testcontacts.create') || $usr->can('testcontacts.view') ||  $usr->can('testcontacts.edit') ||  $usr->can('testcontacts.delete')
                     ) 
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-phone"></i><span>
                            Contacts
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.contacts.create') || Route::is('admin.contacts.index') || Route::is('admin.contacts.edit') || Route::is('admin.contacts.show') || Route::is('admin.testcontacts.create') || Route::is('admin.testcontacts.index') || Route::is('admin.testcontacts.edit') || Route::is('admin.testcontacts.show')  ? 'in' : '' }}">
                            
                            @if ($usr->can('contacts.view'))
                                <li class="{{ Route::is('admin.contacts.index')  || Route::is('admin.contacts.edit') ? 'active' : '' }}"><a href="{{ route('admin.contacts.index') }}">Prod Contacts</a></li>
                            @endif

                            @if ($usr->can('testcontacts.view'))
                                <li class="{{ Route::is('admin.testcontacts.index')  || Route::is('admin.testcontacts.edit') ? 'active' : '' }}"><a href="{{ route('admin.testcontacts.index') }}">Test Contacts</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                     @if ($usr->can('whatsappmessage.create') || $usr->can('whatsappmessage.view') ||  $usr->can('whatsappmessage.edit') ||  $usr->can('whatsappmessage.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-envelope"></i><span>
                            Email & Massages
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.whatsappmessage.create') || Route::is('admin.whatsappmessage.index') || Route::is('admin.whatsappmessage.edit') || Route::is('admin.whatsappmessage.show') ? 'in' : '' }}">
                            
                            @if ($usr->can('whatsappmessage.view'))
                                <li class="{{ Route::is('admin.whatsappmessage.index')  || Route::is('admin.whatsappmessage.edit') ? 'active' : '' }}"><a href="{{ route('admin.whatsappmessage.index') }}">WhatsApp Messages</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->