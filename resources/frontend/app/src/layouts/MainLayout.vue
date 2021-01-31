<template>
  <div>
    <Loader v-if="loading"/>
    <div v-else class="app-main-layout">
      <Navbar @click="isOpen = !isOpen"/>
      <main class="app-content" :class="{full: !isOpen}">
        <div class="app-page">
          <router-view/>
        </div>
      </main>
    </div>
  </div>
</template>
<script>

export default {
  name: 'main-layout',
  data: () => ({
    isOpen: true,
    loading: true,
  }),
};
</script>
