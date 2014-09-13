<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		Applications <span class="caret"></span>
	</a>
	<ul class="dropdown-menu" role="menu">
		<li id="navtab-coordinator">{{ link_to('coordinator', 'Seat coordinator') }}</li>
		<li id="navtab-usermgr">{{ link_to('admin/userManager', 'User manager') }}</li>
		<li id="navtab-addmap">{{ link_to('admin/content/addMap', 'Add new maps') }}</li>
		<li id="navtab-printmgmt">{{ link_to('admin/printmgmt', 'Printer Management') }}</li>
	</ul>
</li>