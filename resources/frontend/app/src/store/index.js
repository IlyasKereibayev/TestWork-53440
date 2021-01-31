import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    total: 0,
    books: [],
  },
  mutations: {
    setTotal(state, total) {
      state.total = total;
    },
    setBooks(state, books) {
      state.books = books;
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
  },
  modules: {},
});
