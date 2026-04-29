<template>
  <div>
    <!-- Stats -->
    <div class="grid grid-cols-3 gap-6 mb-8">
      <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">👥</div>
        <div>
          <p class="text-sm text-gray-500">Total Employees</p>
          <p class="text-2xl font-bold text-gray-800">{{ employees.length }}</p>
        </div>
      </div>
      <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-2xl">💰</div>
        <div>
          <p class="text-sm text-gray-500">Total Salary</p>
          <p class="text-2xl font-bold text-gray-800">${{ totalSalary }}</p>
        </div>
      </div>
      <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-2xl">📋</div>
        <div>
          <p class="text-sm text-gray-500">Positions</p>
          <p class="text-2xl font-bold text-gray-800">{{ uniquePositions }}</p>
        </div>
      </div>
    </div>

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-sm">
      <!-- Card Header -->
      <div class="px-6 py-4 border-b flex items-center justify-between">
        <h2 class="text-base font-semibold text-gray-700">Employee List</h2>
        <button @click="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg flex items-center gap-2 transition">
          <span>＋</span> Add Employee
        </button>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
            <tr>
              <th class="px-6 py-3">#</th>
              <th class="px-6 py-3">Name</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Position</th>
              <th class="px-6 py-3">Salary</th>
              <th class="px-6 py-3 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-if="employees.length === 0">
              <td colspan="6" class="px-6 py-10 text-center text-gray-400">No employees yet. Add one!</td>
            </tr>
            <tr v-for="(emp, i) in employees" :key="emp.id" class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 text-gray-400">{{ i + 1 }}</td>
              <td class="px-6 py-4 font-medium text-gray-800">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold">
                    {{ emp.name.charAt(0).toUpperCase() }}
                  </div>
                  {{ emp.name }}
                </div>
              </td>
              <td class="px-6 py-4 text-gray-500">{{ emp.email }}</td>
              <td class="px-6 py-4">
                <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-full">{{ emp.position }}</span>
              </td>
              <td class="px-6 py-4 text-gray-700 font-medium">${{ Number(emp.salary).toLocaleString() }}</td>
              <td class="px-6 py-4 text-right space-x-2">
                <button @click="openModal(emp)" class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-3 py-1.5 rounded-lg hover:bg-yellow-100 transition">Edit</button>
                <button @click="deleteEmployee(emp.id)" class="text-xs bg-red-50 text-red-600 border border-red-200 px-3 py-1.5 rounded-lg hover:bg-red-100 transition">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div v-if="modal" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50">
      <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="text-base font-semibold text-gray-800">{{ editing ? 'Edit Employee' : 'Add New Employee' }}</h3>
          <button @click="closeModal" class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
        </div>
        <div class="space-y-3">
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Full Name</label>
            <input v-model="form.name" placeholder="John Doe" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Email</label>
            <input v-model="form.email" placeholder="john@example.com" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Position</label>
            <input v-model="form.position" placeholder="Software Engineer" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
          <div>
            <label class="text-xs font-medium text-gray-500 mb-1 block">Salary ($)</label>
            <input v-model="form.salary" type="number" placeholder="5000" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
        </div>
        <p v-if="error" class="text-red-500 text-xs mt-3">{{ error }}</p>
        <div class="flex justify-end gap-2 mt-5">
          <button @click="closeModal" class="px-4 py-2 text-sm rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 transition">Cancel</button>
          <button @click="save" class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
            {{ editing ? 'Update' : 'Save' }}
          </button>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'EmployeeCrud',
  data() {
    return {
      employees: [],
      form: { name: '', email: '', position: '', salary: '' },
      editing: null,
      modal: false,
      error: '',
    };
  },
  computed: {
    totalSalary() {
      return this.employees.reduce((s, e) => s + Number(e.salary), 0).toLocaleString();
    },
    uniquePositions() {
      return new Set(this.employees.map(e => e.position)).size;
    },
  },
  mounted() {
    this.fetchEmployees();
  },
  methods: {
    async fetchEmployees() {
      const res = await axios.get('/api/employees');
      this.employees = res.data;
    },
    openModal(emp = null) {
      this.error = '';
      if (emp) {
        this.editing = emp.id;
        this.form = { name: emp.name, email: emp.email, position: emp.position, salary: emp.salary };
      } else {
        this.editing = null;
        this.form = { name: '', email: '', position: '', salary: '' };
      }
      this.modal = true;
    },
    closeModal() {
      this.modal = false;
      this.error = '';
    },
    async save() {
      this.error = '';
      try {
        if (this.editing) {
          await axios.put(`/api/employees/${this.editing}`, this.form);
        } else {
          await axios.post('/api/employees', this.form);
        }
        this.closeModal();
        this.fetchEmployees();
      } catch (e) {
        this.error = Object.values(e.response?.data?.errors || { e: ['Something went wrong'] }).flat().join(', ');
      }
    },
    async deleteEmployee(id) {
      if (!confirm('Are you sure you want to delete this employee?')) return;
      await axios.delete(`/api/employees/${id}`);
      this.fetchEmployees();
    },
  },
};
</script>
