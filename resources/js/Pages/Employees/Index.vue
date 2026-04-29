<template>
  <AppLayout title="Employees">
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">All Employees</h2>
        <Link href="/employees/create" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition">＋ Add Employee</Link>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Name</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Phone</th>
              <th class="px-6 py-3">Department</th>
              <th class="px-6 py-3">Role</th>
              <th class="px-6 py-3">Salary</th>
              <th class="px-6 py-3 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-if="!employees.length">
              <td colspan="8" class="px-6 py-10 text-center text-gray-400">No employees found.</td>
            </tr>
            <tr v-for="(emp, i) in employees" :key="emp.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
              <td class="px-6 py-4 font-medium text-gray-800 flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">{{ emp.name.charAt(0) }}</div>
                {{ emp.name }}
              </td>
              <td class="px-6 py-4 text-gray-500">{{ emp.email }}</td>
              <td class="px-6 py-4 text-gray-500">{{ emp.phone || '—' }}</td>
              <td class="px-6 py-4">
                <span class="bg-purple-50 text-purple-700 text-xs px-2 py-1 rounded-full">{{ emp.department?.name || '—' }}</span>
              </td>
              <td class="px-6 py-4">
                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded-full">{{ emp.role }}</span>
              </td>
              <td class="px-6 py-4 font-medium text-gray-700">${{ Number(emp.salary).toLocaleString() }}</td>
              <td class="px-6 py-4 text-right space-x-2">
                <Link :href="`/employees/${emp.id}/edit`" class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-1.5 rounded-lg hover:bg-yellow-100">Edit</Link>
                <button @click="destroy(emp.id)" class="text-xs bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';

export default {
  components: { AppLayout, Link },
  props: { employees: Array },
  methods: {
    destroy(id) {
      if (confirm('Delete this employee?')) router.delete(`/employees/${id}`);
    },
  },
};
</script>
