<template>
  <AppLayout title="Payroll">
    <div class="flex justify-end mb-6">
      <Link href="/payrolls/create" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700">＋ Add Payroll</Link>
    </div>
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b"><h2 class="font-semibold text-gray-700">Payroll Records</h2></div>
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Employee</th>
            <th class="px-6 py-3">Month</th>
            <th class="px-6 py-3">Basic</th>
            <th class="px-6 py-3">Bonus</th>
            <th class="px-6 py-3">Deduction</th>
            <th class="px-6 py-3">Net Salary</th>
            <th class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-if="!payrolls.length">
            <td colspan="8" class="px-6 py-10 text-center text-gray-400">No payroll records.</td>
          </tr>
          <tr v-for="(p, i) in payrolls" :key="p.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ p.employee?.name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ p.month }}</td>
            <td class="px-6 py-4">${{ Number(p.basic_salary).toLocaleString() }}</td>
            <td class="px-6 py-4 text-green-600">+${{ Number(p.bonus).toLocaleString() }}</td>
            <td class="px-6 py-4 text-red-500">-${{ Number(p.deduction).toLocaleString() }}</td>
            <td class="px-6 py-4 font-bold text-gray-800">${{ Number(p.net_salary).toLocaleString() }}</td>
            <td class="px-6 py-4 text-right">
              <button @click="destroy(p.id)" class="text-xs bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100">Delete</button>
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
  props: { payrolls: Array },
  methods: {
    destroy(id) {
      if (confirm('Delete this payroll record?')) router.delete(`/payrolls/${id}`);
    },
  },
};
</script>
