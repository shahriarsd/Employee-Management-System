<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col shadow-xl">
      <div class="px-6 py-5 border-b border-gray-700">
        <span class="text-xl font-bold tracking-wide text-white">⚡ EmpManager</span>
      </div>
      <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <Link
          v-for="item in visibleNav"
          :key="item.href"
          :href="item.href"
          class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition"
          :class="isActive(item.href)
            ? 'bg-blue-600 text-white'
            : 'text-gray-400 hover:bg-gray-800 hover:text-white'"
        >
          <span class="text-base">{{ item.icon }}</span>
          {{ item.label }}
        </Link>
      </nav>
      <div class="px-4 py-4 border-t border-gray-700">
        <Link
          href="/logout"
          method="post"
          as="button"
          class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:bg-gray-800 hover:text-white transition"
        >
          <span>🚪</span> Logout
        </Link>
      </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Topbar -->
      <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-semibold text-gray-700">{{ title }}</h1>
        <div class="flex items-center gap-3">
          <span v-if="$page.props.auth.isAdmin" class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">Admin</span>
          <span class="text-sm text-gray-500">{{ $page.props.auth.user?.name }}</span>
          <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
            {{ $page.props.auth.user?.name?.charAt(0)?.toUpperCase() }}
          </div>
        </div>
      </header>

      <!-- Flash -->
      <div v-if="$page.props.flash?.success" class="mx-8 mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
        ✅ {{ $page.props.flash.success }}
      </div>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-8">
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  components: { Link },
  props: { title: { type: String, default: 'Dashboard' } },
  data() {
    return {
      nav: [
        { label: 'Dashboard',   href: '/dashboard',   icon: '🏠', adminOnly: false },
        { label: 'Employees',   href: '/employees',   icon: '👥', adminOnly: true  },
        { label: 'Departments', href: '/departments', icon: '🏢', adminOnly: true  },
        { label: 'Attendance',  href: '/attendances', icon: '🕐', adminOnly: false },
        { label: 'Leaves',      href: '/leaves',      icon: '📅', adminOnly: false },
        { label: 'Payroll',     href: '/payrolls',    icon: '💰', adminOnly: true  },
        { label: 'Users',       href: '/users',       icon: '🔑', adminOnly: true  },
      ],
    };
  },
  computed: {
    visibleNav() {
      const isAdmin = this.$page.props.auth.isAdmin;
      return this.nav.filter(item => !item.adminOnly || isAdmin);
    },
  },
  methods: {
    isActive(href) {
      return window.location.pathname.startsWith(href);
    },
  },
};
</script>
