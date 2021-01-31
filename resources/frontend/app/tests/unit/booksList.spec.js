import {createLocalVue, shallowMount} from '@vue/test-utils';
import BooksList from '@/views/BooksList.vue';
import Vuetify from 'vuetify';
import Vuex from 'vuex';
import VueRouter from 'vue-router';

describe('BooksList.vue', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);
  localVue.use(VueRouter);
  const router = new VueRouter();
  
  let vuetify;
  let store;
  let actions;
  
  beforeEach(() => {
    vuetify = new Vuetify();
    actions = {
      'fetchBooks': jest.fn(),
      'deleteBook': jest.fn(),
    };
    store = new Vuex.Store({
      state: {
        books: [{
          "id": 24,
          "title": "Преступление и наказание",
          "isbn": "123412356789",
          "description": "Основой сюжета романа «Преступление и наказание» является убийство, совершенное главным героем. Родион Раскольников – «молодой человек, исключенный из студентов университета» и «живущий в крайней бедности», – за полгода до совершения преступления написал статью, в которой высказал свой принцип разделения людей.",
          "price": 1250,
        }],
        totalBooks: 1,
        total: 1,
      },
      actions
    });
  });

  const mountFunction = (options) => shallowMount(BooksList, {
    localVue,
    vuetify,
    store,
    router,
    data: () => ({
      mainLoading: false,
    }),
    ...options
  });

  it('renders header message', () => {
    const wrapper = mountFunction();

    expect(wrapper.find('h3').text()).toEqual('Books');
  });
  
  it('renders data table', () => {
    const wrapper = mountFunction();
    const table = wrapper.find('.striped');
    console.log(wrapper.text());
    expect(table.exists()).toBe(true);
  });
});
