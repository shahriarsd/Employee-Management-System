<template>
  <AppLayout title="Add Payroll">
    <div class="max-w-lg bg-white rounded-xl shadow-sm p-6">
      <h2 class="font-semibold text-gray-700 mb-5">New Payroll Entry</h2>
      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label class="label">Employee</label>
          <select v-model="form.employee_id" class="input">
            <option value="">— Select Employee —</option>
            <option v-for="e in employees" :key="e.id" :value="e.id">{{ e.name }}</option>
          </select>
          <p v-if="form.errors.employee_id" class="err">{{ form.errors.employee_id }}</p>
        </div>
        <div>
          <label class="label">Month (e.g. 2026-04)</label>
          <input v-model="form.month" class="input" placeholder="2026-04" />
          <p v-if="form.errors.month" class="err">{{ form.errors.month }}</p>
        </div>
        <div class="grid grid-cols-3 gap-4">
          <div>
            <label class="label">Basic Salary</label>
            <input v-model="form.basic_salary" type="number" class="input" placeholder="5000" />
            <p v-if="form.errors.basic_salary" class="err">{{ form.errors.basic_salary }}</p>
          </div>
          <div>
            <label class="label">Bonus</label>
            <input v-model="form.bonus" type="number" class="input" placeholder="0" />
          </div>
          <div>
            <label class="label">Deduction</label>
            <input v-model="form.deduction" type="number" class="input" placeholder="0" />
          </div>
        </div>
        <div class="flex gap-3 pt-2">
          <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 text-sm">Save</button>
          <Link href="/payrolls" class="border border-gray-200 text-gray-600 px-5 py-2 rounded-lg hover:bg-gray-50 text-sm">Cancel</Link>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

export default {
  components: { AppLayout, Link },
  props: { employees: Array },
  setup() {
    const form = useForm({ employee_id: '', basic_salary: '', bonus: 0, deduction: 0, month: '' });
    return { form };
  },
  methods: {
    submit() { this.form.post('/payrolls'); },
  },
};
</script>

<style scoped>
.label { @apply block text-xs font-medium text-gray-500 mb-1; }
.input  { @apply w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500; }
.err    { @apply text-red-500 text-xs mt-1; }
</style>
