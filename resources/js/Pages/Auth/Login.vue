<template>
  <div class="min-h-screen flex flex-col bg-gray-50">

    <!-- Header -->
    <header class="bg-white border-b border-gray-100 shadow-sm">
      <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <span class="text-xl font-extrabold text-blue-600">⚡ EmpManager</span>
        <div class="flex items-center gap-4 text-sm text-gray-500">
          <span>Don't have an account?</span>
          <a href="/register" class="bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition font-medium">Register</a>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="flex-1 flex items-center justify-center px-4 py-12">
      <div class="w-full max-w-sm bg-white rounded-2xl shadow-md border border-gray-100 p-7">

        <div class="mb-6 text-center">
          <h2 class="text-xl font-bold text-gray-900">Welcome back 👋</h2>
          <p class="text-gray-400 text-sm mt-1">Sign in to your account</p>
        </div>

        <form @submit.prevent="submit" class="space-y-4">
          <!-- Email -->
          <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Email address</label>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">✉</span>
              <input
                v-model="form.email"
                type="email"
                placeholder="admin@example.com"
                class="w-full pl-8 pr-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                :class="form.errors.email ? 'border-red-300 bg-red-50' : 'border-gray-200'"
              />
            </div>
            <p v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</p>
          </div>

          <!-- Password -->
          <div>
            <div class="flex justify-between mb-1">
              <label class="text-xs font-medium text-gray-600">Password</label>
              <a href="/forgot-password" class="text-xs text-blue-600 hover:underline">Forgot?</a>
            </div>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔒</span>
              <input
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                placeholder="••••••••"
                class="w-full pl-8 pr-9 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                :class="form.errors.password ? 'border-red-300 bg-red-50' : 'border-gray-200'"
              />
              <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 text-xs">
                {{ showPassword ? '🙈' : '👁' }}
              </button>
            </div>
            <p v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</p>
          </div>

          <!-- Remember -->
          <div class="flex items-center gap-2">
            <input v-model="form.remember" type="checkbox" id="remember" class="w-4 h-4 rounded border-gray-300 text-blue-600" />
            <label for="remember" class="text-xs text-gray-500">Keep me signed in</label>
          </div>

          <!-- Submit -->
          <button
            type="submit"
            :disabled="form.processing"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-sm transition disabled:opacity-60 flex items-center justify-center gap-2 shadow shadow-blue-200"
          >
            <svg v-if="form.processing" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
            </svg>
            {{ form.processing ? 'Signing in...' : 'Sign In' }}
          </button>
        </form>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-4">
      <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-400">
        <span>© 2026 EmpManager. All rights reserved.</span>
        <div class="flex gap-4">
          <a href="#" class="hover:text-blue-600 transition">Privacy Policy</a>
          <a href="#" class="hover:text-blue-600 transition">Terms of Service</a>
          <a href="#" class="hover:text-blue-600 transition">Support</a>
        </div>
      </div>
    </footer>

  </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
  data() {
    return { showPassword: false };
  },
  setup() {
    const form = useForm({ email: '', password: '', remember: false });
    return { form };
  },
  methods: {
    submit() {
      this.form.post('/login', { onFinish: () => this.form.reset('password') });
    },
  },
};
</script>
