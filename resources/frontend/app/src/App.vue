<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      :clipped="$vuetify.breakpoint.smAndUp"
      :permanent="$vuetify.breakpoint.smAndUp"
    >
      <v-list
        dense
        nav
      >
        <v-list-item
          v-for="item in items"
          :key="item.title"
          :to="item.url"
          :exact="item.exact"
          link
        >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app clipped-left>
      <v-app-bar-nav-icon class="d-sm-none" @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title class="pa-0">Books manager</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container fluid class="pa-8">
        <router-view/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'app',
  components: {
  },
  data: () => ({
    drawer: null,
    items: [
      {
        title: 'Books list',
        url: '/',
        exact: true,
        icon: 'mdi-book-open-variant',
      },
      {
        title: 'Add book',
        url: '/book/add',
        icon: 'mdi-plus-thick',
      },
    ],
  }),
};
</script>
