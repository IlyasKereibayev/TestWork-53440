import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    total: 0,
    books: [],
    book: {},
  },
  mutations: {
    setTotal(state, total) {
      state.total = total;
    },
    setBooks(state, books) {
      state.books = books;
    },
    setBook(state, book) {
      state.book = book;
    },
  },
  actions: {
    async fetchBooks({ commit }, { page }) {
      try {
        const response = await Vue.axios.get(`/api/books${page ? `?page=${page}` : ''}`);
        commit('setBooks', response.data.data);
        commit('setTotal', response.data.pagination.total);
        return null;
      } catch (e) {
        commit('setError', e);
        console.log(e);
        return null;
      }
    },
    async updateBook({ commit }, {
      id, title, isbn, description, price,
    }) {
      try {
        const payload = {
          title, isbn, description, price,
        };
        await Vue.axios.put(`/api/books/${id}`, payload);
        return null;
      } catch (e) {
        commit('setError', e);
        console.log(e);
        return null;
      }
    },
  },
  modules: {},
});
