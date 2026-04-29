<template>
  <div class="bg-white rounded-xl shadow-sm p-5 flex items-center gap-4">
    <div :class="`w-12 h-12 rounded-full flex items-center justify-center text-2xl bg-${color}-100 text-${color}-600`">
      {{ icon }}
    </div>
    <div>
      <p class="text-sm text-gray-400">{{ label }}</p>
      <p class="text-2xl font-bold text-gray-800">{{ value }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: { label: String, value: [Number, String], icon: String, color: String },
};
</script>
