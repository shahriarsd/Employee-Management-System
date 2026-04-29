<template>
  <AppLayout title="Attendance">
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Attendance</h2>
        <input v-if="isAdmin" type="date" v-model="selectedDate" @change="changeDate"
          class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <table class="w-full text-sm text-center">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Employee</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Note</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-if="!records.length">
            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
              Your account is not linked to an employee profile. Please contact admin.
            </td>
          </tr>
          <tr v-for="(row, i) in records" :key="row.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ row.name }}</td>
            <td class="px-6 py-4">
              <select v-model="row.status"
                class="border border-gray-200 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500"
                :class="statusClass(row.status)">
                <option value="present">Present</option>
                <option value="absent">Absent</option>
                <option value="late">Late</option>
              </select>
            </td>
            <td class="px-6 py-4">
              <input v-model="row.note" placeholder="Optional note"
                class="border border-gray-200 rounded-lg px-2 py-1 text-xs w-40 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </td>
          </tr>
        </tbody>
      </table>

      <div class="px-6 py-4 border-t flex justify-end">
        <button @click="save"
          class="bg-blue-600 text-white text-sm px-5 py-2 rounded-lg hover:bg-blue-700">
          Save Attendance
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';

export default {
  components: { AppLayout },
  props: { employees: Array, date: String, isAdmin: Boolean },
  data() {
    return {
      selectedDate: this.date,
      records: this.employees.map(e => ({
        id: e.id,
        name: e.name,
        status: e.attendance?.status ?? 'present',
        note: e.attendance?.note ?? '',
      })),
    };
  },
  methods: {
    changeDate() {
      router.get('/attendances', { date: this.selectedDate }, { preserveState: false });
    },
    save() {
      router.post('/attendances', {
        date: this.selectedDate,
        records: this.records.map(r => ({
          employee_id: r.id,
          status: r.status,
          note: r.note,
        })),
      });
    },
    statusClass(s) {
      return {
        present: 'text-green-700 bg-green-50',
        absent:  'text-red-600 bg-red-50',
        late:    'text-yellow-700 bg-yellow-50',
      }[s] ?? '';
    },
  },
};
</script>
