<template>
  <div>
    <div class="page-title pb-2">
      <h3>Books</h3>
    </div>

    <Loader v-if="mainLoading"/>
    <p v-else-if="!books.length" class="center">No books in database.
      <router-link to="/book/add">Add new one</router-link>
    </p>
    <section v-else>
      <v-data-table
        :headers="headers"
        :items="books"
        :page.sync="page"
        :items-per-page="itemsPerPage"
        :options.sync="options"
        :server-items-length="totalBooks"
        :loading="dataTableLoading"
        hide-default-footer
        disable-sort
        @click:row="handleClick"
        class="elevation-1 striped clickable"
      >
        <template v-slot:item.actions="{ item }">
          <v-icon
            small
            @click.stop="deleteItem(item)"
          >
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
      <v-pagination
        v-model="page"
        :length="pagesCount"
        :total-visible="7"
      ></v-pagination>
    </section>
  </div>
</template>
<script>
export default {
  name: 'booksList',
  data: () => ({
    mainLoading: true,
    dataTableLoading: true,
    // data table
    options: {},
    headers: [
      { text: '#', value: 'id' },
      { text: 'Title', value: 'title' },
      { text: 'ISBN', value: 'isbn' },
      { text: 'Price', value: 'price' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    page: 1,
    itemsPerPage: 5,
  }),
  computed: {
    books() {
      return this.$store.state.books;
    },
    totalBooks() {
      return this.$store.state.total;
    },
    pagesCount() {
      return Math.ceil(this.totalBooks / this.itemsPerPage);
    },
  },
  watch: {
    options: {
      handler() {
        this.getBooksFromApi();
      },
      deep: true,
    },
  },
  async mounted() {
    await this.getBooksFromApi();
    this.mainLoading = false;
  },
  methods: {
    async getBooksFromApi() {
      this.dataTableLoading = true;
      const { page } = this.options;
      await this.$store.dispatch('fetchBooks', { page });
      this.dataTableLoading = false;
    },
    handleClick(row) {
      this.$router.push(`/book/${row.id}`);
    },
    async deleteItem(item) {
      const { id } = item;
      await this.$store.dispatch('deleteBook', { id });
      this.$toasted.show('Book was deleted');
      this.getBooksFromApi();
    },
  },
};
</script>
<style lang="css" scoped>
  .clickable >>> tbody tr :hover {
    cursor: pointer;
  }
</style>
