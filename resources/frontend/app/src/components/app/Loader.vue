<template>
  <div class="text-center">
    <v-progress-circular
      indeterminate
      :color="color"
      :size="50"
    ></v-progress-circular>
  </div>

</template>
<script>
export default {
  computed: {
    color() {
      const colors = ['primary', 'red', 'purple', 'green', 'amber'];
      return colors[Math.floor(Math.random() * colors.length)];
    },
  },
};
</script>
