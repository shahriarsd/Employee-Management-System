<template>
  <AppLayout title="User Management">
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b"><h2 class="font-semibold text-gray-700">Users & Roles</h2></div>
      <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3 text-left">#</th>
            <th class="px-6 py-3 text-left">Name</th>
            <th class="px-6 py-3 text-left">Email</th>
            <th class="px-6 py-3 text-left">Role</th>
            <th class="px-6 py-3 text-left">Linked Employee</th>
            <th class="px-6 py-3 text-left">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="(user, i) in localUsers" :key="user.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ user.name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ user.email }}</td>
            <td class="px-6 py-4">
              <select v-model="user.role" class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
              </select>
            </td>
            <td class="px-6 py-4">
              <select v-model="user.employee_id" class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option :value="null">— None —</option>
                <option v-for="e in employees" :key="e.id" :value="e.id">{{ e.name }}</option>
              </select>
            </td>
            <td class="px-6 py-4">
              <button @click="save(user)" class="text-xs bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1.5 rounded-lg hover:bg-blue-100">Save</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

export default {
  components: { AppLayout },
  props: { users: Array, employees: Array },
  data() {
    return { localUsers: this.users.map(u => ({ ...u })) };
  },
  methods: {
    save(user) {
      router.patch(`/users/${user.id}`, { role: user.role, employee_id: user.employee_id });
    },
  },
};
</script>
