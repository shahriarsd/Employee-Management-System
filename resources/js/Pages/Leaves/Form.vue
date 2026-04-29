<template>
  <AppLayout title="Apply Leave">
    <div class="max-w-lg bg-white rounded-xl shadow-sm p-6">
      <h2 class="font-semibold text-gray-700 mb-5">Apply for Leave</h2>
      <form @submit.prevent="submit" class="space-y-4">
        <div v-if="isAdmin">
          <label class="label">Employee</label>
          <select v-model="form.employee_id" class="input">
            <option value="">— Select Employee —</option>
            <option v-for="e in employees" :key="e.id" :value="e.id">{{ e.name }}</option>
          </select>
          <p v-if="form.errors.employee_id" class="err">{{ form.errors.employee_id }}</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="label">From Date</label>
            <input v-model="form.from_date" type="date" class="input" />
            <p v-if="form.errors.from_date" class="err">{{ form.errors.from_date }}</p>
          </div>
          <div>
            <label class="label">To Date</label>
            <input v-model="form.to_date" type="date" class="input" />
            <p v-if="form.errors.to_date" class="err">{{ form.errors.to_date }}</p>
          </div>
        </div>
        <div>
          <label class="label">Reason</label>
          <textarea v-model="form.reason" rows="3" class="input" placeholder="Reason for leave..."></textarea>
          <p v-if="form.errors.reason" class="err">{{ form.errors.reason }}</p>
        </div>
        <div class="flex gap-3">
          <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 text-sm">Submit</button>
          <Link href="/leaves" class="border border-gray-200 text-gray-600 px-5 py-2 rounded-lg hover:bg-gray-50 text-sm">Cancel</Link>
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
  props: { employees: Array, isAdmin: Boolean },
  setup() {
    const form = useForm({ employee_id: '', from_date: '', to_date: '', reason: '' });
    return { form };
  },
  methods: {
    submit() { this.form.post('/leaves'); },
  },
};
</script>

<style scoped>
.label { @apply block text-xs font-medium text-gray-500 mb-1; }
.input  { @apply w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500; }
.err    { @apply text-red-500 text-xs mt-1; }
</style>
