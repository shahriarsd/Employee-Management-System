<script setup>
defineProps({
  users: Array
});
</script>

<template>
  <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Users</h1>

    <table class="w-full border border-gray-700 text-white">
      <thead class="bg-gray-800">
        <tr>
          <th class="p-2">ID</th>
          <th class="p-2">Name</th>
          <th class="p-2">Email</th>
          <th class="p-2">Roles</th>
          <th class="p-2">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="user in users" :key="user.id" class="border-t border-gray-700">
          <td class="p-2">{{ user.id }}</td>
          <td class="p-2">{{ user.name }}</td>
          <td class="p-2">{{ user.email }}</td>

          <!-- Roles -->
          <td class="p-2">
            <span
              v-for="role in user.roles"
              :key="role.id"
              class="bg-green-600 px-2 py-1 rounded text-sm mr-1"
            >
              {{ role.name }}
            </span>
          </td>

          <!-- Actions -->
          <td class="p-2 space-x-2">
            <button class="bg-gray-600 px-2 py-1 rounded">Show</button>
            <button class="bg-blue-600 px-2 py-1 rounded">Edit</button>
            <button class="bg-red-600 px-2 py-1 rounded">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
