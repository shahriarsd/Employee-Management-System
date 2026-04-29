<template>
  <AppLayout :title="employee ? 'Edit Employee' : 'Add Employee'">
    <div class="max-w-2xl bg-white rounded-xl shadow-sm p-6">
      <h2 class="font-semibold text-gray-700 mb-5">{{ employee ? 'Edit Employee' : 'New Employee' }}</h2>
      <form @submit.prevent="submit" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="label">Full Name</label>
            <input v-model="form.name" class="input" placeholder="John Doe" />
            <p v-if="form.errors.name" class="err">{{ form.errors.name }}</p>
          </div>
          <div>
            <label class="label">Email</label>
            <input v-model="form.email" type="email" class="input" placeholder="john@example.com" />
            <p v-if="form.errors.email" class="err">{{ form.errors.email }}</p>
          </div>
          <div>
            <label class="label">Phone</label>
            <input v-model="form.phone" class="input" placeholder="+880..." />
          </div>
          <div>
            <label class="label">Department</label>
            <select v-model="form.department_id" class="input">
              <option value="">— Select —</option>
              <option v-for="d in departments" :key="d.id" :value="d.id">{{ d.name }}</option>
            </select>
          </div>
          <div>
            <label class="label">Role</label>
            <input v-model="form.role" class="input" placeholder="Software Engineer" />
            <p v-if="form.errors.role" class="err">{{ form.errors.role }}</p>
          </div>
          <div>
            <label class="label">Salary ($)</label>
            <input v-model="form.salary" type="number" class="input" placeholder="5000" />
            <p v-if="form.errors.salary" class="err">{{ form.errors.salary }}</p>
          </div>
        </div>
        <div class="flex gap-3 pt-2">
          <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 text-sm">
            {{ employee ? 'Update' : 'Save' }}
          </button>
          <Link href="/employees" class="border border-gray-200 text-gray-600 px-5 py-2 rounded-lg hover:bg-gray-50 text-sm">Cancel</Link>
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
  props: { employee: Object, departments: Array },
  setup(props) {
    const form = useForm({
      name:          props.employee?.name          ?? '',
      email:         props.employee?.email         ?? '',
      phone:         props.employee?.phone         ?? '',
      department_id: props.employee?.department_id ?? '',
      role:          props.employee?.role          ?? '',
      salary:        props.employee?.salary        ?? '',
    });
    return { form };
  },
  methods: {
    submit() {
      if (this.employee) {
        this.form.put(`/employees/${this.employee.id}`);
      } else {
        this.form.post('/employees');
      }
    },
  },
};
</script>

<style scoped>
.label { @apply block text-xs font-medium text-gray-500 mb-1; }
.input  { @apply w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500; }
.err    { @apply text-red-500 text-xs mt-1; }
</style>
