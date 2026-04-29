<template>
  <AppLayout title="Dashboard">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <StatCard label="Total Employees"   :value="stats.total_employees"   icon="👥" color="blue"   />
      <StatCard label="On Leave Today"    :value="stats.on_leave_today"    icon="📅" color="yellow" />
      <StatCard label="Total Departments" :value="stats.total_departments" icon="🏢" color="purple" />
      <StatCard label="Pending Approvals" :value="stats.pending_approvals" icon="⏳" color="red"    />
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
      <h2 class="text-base font-semibold text-gray-700 mb-1">Welcome back, {{ $page.props.auth.user?.name }} 👋</h2>
      <p class="text-sm text-gray-400">Here's what's happening with your team today.</p>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import StatCard from '@/Components/StatCard.vue';

export default {
  components: { AppLayout, StatCard },
  props: { stats: Object },
};
</script>
