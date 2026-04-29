<template>
  <AppLayout title="Leave Management">
    <div class="flex justify-between items-center mb-6">
      <div></div>
      <Link href="/leaves/create" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700">＋ Apply Leave</Link>
    </div>
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b"><h2 class="font-semibold text-gray-700">Leave Requests</h2></div>
      <table class="w-full text-sm text-center">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Employee</th>
            <th class="px-6 py-3">From</th>
            <th class="px-6 py-3">To</th>
            <th class="px-6 py-3">Reason</th>
            <th class="px-6 py-3">Status</th>
            <th v-if="isAdmin" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-if="!leaves.length">
            <td :colspan="isAdmin ? 7 : 6" class="px-6 py-10 text-center text-gray-400">No leave requests.</td>
          </tr>
          <tr v-for="(leave, i) in leaves" :key="leave.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ leave.employee?.name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ leave.from_date }}</td>
            <td class="px-6 py-4 text-gray-500">{{ leave.to_date }}</td>
            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">{{ leave.reason }}</td>
            <td class="px-6 py-4">
              <span :class="statusClass(leave.status)" class="text-xs px-2 py-1 rounded-full font-medium">{{ leave.status }}</span>
            </td>
            <td v-if="isAdmin" class="px-6 py-4 space-x-2">
              <template v-if="leave.status === 'pending'">
                <button @click="updateStatus(leave.id, 'approved')" class="text-xs bg-green-50 text-green-700 border border-green-200 px-3 py-1.5 rounded-lg hover:bg-green-100">Approve</button>
                <button @click="updateStatus(leave.id, 'rejected')" class="text-xs bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100">Reject</button>
              </template>
              <button @click="destroy(leave.id)" class="text-xs bg-gray-50 text-gray-600 border border-gray-200 px-3 py-1.5 rounded-lg hover:bg-gray-100">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

export default {
  components: { AppLayout, Link },
  props: { leaves: Array, isAdmin: Boolean },
  methods: {
    statusClass(s) {
      return { pending: 'bg-yellow-50 text-yellow-700', approved: 'bg-green-50 text-green-700', rejected: 'bg-red-50 text-red-600' }[s];
    },
    updateStatus(id, status) {
      router.patch(`/leaves/${id}/status`, { status });
    },
    destroy(id) {
      if (confirm('Delete this leave?')) router.delete(`/leaves/${id}`);
    },
  },
};
</script>
