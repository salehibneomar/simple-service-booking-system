export const drawerLinks = {
	customer: [
		{
			label: 'Dashboard',
			route: '/',
			icon: 'dashboard',
			slug: 'dashboard'
		},
		{
			label: 'Services',
			route: '/services',
			icon: 'category',
			slug: 'services'
		},
		{
			label: 'My Bookings',
			route: '/bookings',
			icon: 'view_list',
			slug: 'bookings'
		}
	],
	admin: [
		{
			label: 'Dashboard',
			route: '/admin',
			icon: 'dashboard',
			slug: 'admin-dashboard'
		},
		{
			label: 'Manage Services',
			route: '/admin/manage/services',
			icon: 'inventory_2',
			slug: 'manage-services'
		},
		{
			label: 'Manage Bookings',
			route: '/admin/manage/bookings',
			icon: 'shopping_cart',
			slug: 'manage-bookings'
		}
	]
}
