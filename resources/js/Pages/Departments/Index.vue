<template>
  <AppLayout title="Departments">
    <div class="bg-white rounded-xl shadow-sm">
      <div class="px-6 py-4 border-b flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Departments</h2>
        <button @click="openModal()" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700">＋ Add Department</button>
      </div>
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Name</th>
            <th class="px-6 py-3">Description</th>
            <th class="px-6 py-3">Employees</th>
            <th class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-if="!departments.length">
            <td colspan="5" class="px-6 py-10 text-center text-gray-400">No departments yet.</td>
          </tr>
          <tr v-for="(dept, i) in departments" :key="dept.id" class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ dept.name }}</td>
            <td class="px-6 py-4 text-gray-500">{{ dept.description || '—' }}</td>
            <td class="px-6 py-4"><span class="bg-blue-50 text-blue-700 text-xs px-2 py-1 rounded-full">{{ dept.employees_count }}</span></td>
            <td class="px-6 py-4 text-right space-x-2">
              <button @click="openModal(dept)" class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-1.5 rounded-lg hover:bg-yellow-100">Edit</button>
              <button @click="destroy(dept.id)" class="text-xs bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div v-if="modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="font-semibold text-gray-800">{{ form.id ? 'Edit' : 'Add' }} Department</h3>
          <button @click="modal=false" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
        </div>
        <div class="space-y-3">
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Name</label>
            <input v-model="form.name" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <p v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</p>
          </div>
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Description</label>
            <textarea v-model="form.description" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
          </div>
        </div>
        <div class="flex justify-end gap-2 mt-4">
          <button @click="modal=false" class="px-4 py-2 text-sm border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">Cancel</button>
          <button @click="save" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">{{ form.id ? 'Update' : 'Save' }}</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, router } from '@inertiajs/vue3';

export default {
  components: { AppLayout },
  props: { departments: Array },
  data() { return { modal: false }; },
  setup() {
    const form = useForm({ id: null, name: '', description: '' });
    return { form };
  },
  methods: {
    openModal(dept = null) {
      this.form.reset();
      this.form.clearErrors();
      if (dept) { this.form.id = dept.id; this.form.name = dept.name; this.form.description = dept.description || ''; }
      this.modal = true;
    },
    save() {
      if (this.form.id) {
        this.form.put(`/departments/${this.form.id}`, { onSuccess: () => { this.modal = false; } });
      } else {
        this.form.post('/departments', { onSuccess: () => { this.modal = false; } });
      }
    },
    destroy(id) {
      if (confirm('Delete this department?')) router.delete(`/departments/${id}`);
    },
  },
};
</script>
