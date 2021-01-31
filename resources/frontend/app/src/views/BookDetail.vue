<template>
  <div>
    <v-col
      cols="12"
      v-if="mainLoading"
    >
      <Loader />
    </v-col>
    <v-col v-else
      cols="12"
      sm="6"
    >
      <h3 class="pb-3">Book detail</h3>
      <form>
        <v-text-field
          v-model="book.title"
          :error-messages="titleErrors"
          label="Title"
          required
          @input="$v.book.title.$touch()"
          @blur="$v.book.title.$touch()"
        ></v-text-field>
        <v-text-field
          v-model="book.isbn"
          :error-messages="isbnErrors"
          label="ISBN"
          required
          @input="$v.book.isbn.$touch()"
          @blur="$v.book.isbn.$touch()"
        ></v-text-field>
        <v-textarea
          v-model="book.description"
          :error-messages="descriptionErrors"
          label="Description"
          required
          auto-grow
          @input="$v.book.description.$touch()"
          @blur="$v.book.description.$touch()"
        ></v-textarea>
        <v-text-field
          v-model="book.price"
          :error-messages="priceErrors"
          label="Price"
          required
          @input="$v.book.price.$touch()"
          @blur="$v.book.price.$touch()"
        ></v-text-field>
        <v-btn
          class="mr-4"
          @click="submitHandler"
        >
          submit
        </v-btn>
      </form>
    </v-col>
  </div>
</template>
<script>
import {
  required, maxLength, minValue, integer,
} from 'vuelidate/lib/validators';

export default {
  name: 'bookDetail',
  validations: {
    book: {
      title: { required },
      isbn: { required, maxLength: maxLength(13) },
      description: { required },
      price: { required, minValue: minValue(0), integer },
    },
  },
  data: () => ({
    mainLoading: true,
    book: {
      title: '',
      isbn: '',
      description: '',
      price: '',
    },
  }),
  computed: {
    titleErrors() {
      const errors = [];
      if (!this.$v.book.title.$dirty) return errors;
      if (!this.$v.book.title.required) errors.push('Title is required.');
      return errors;
    },
    isbnErrors() {
      const errors = [];
      if (!this.$v.book.isbn.$dirty) return errors;
      if (!this.$v.book.isbn.required) errors.push('ISBN is required.');
      if (!this.$v.book.isbn.maxLength) {
        const { max } = this.$v.book.isbn.$params.maxLength;
        errors.push(`ISBN can be max of ${max} length`);
      }
      return errors;
    },
    descriptionErrors() {
      const errors = [];
      if (!this.$v.book.description.$dirty) return errors;
      if (!this.$v.book.description.required) errors.push('Description is required.');
      return errors;
    },
    priceErrors() {
      const errors = [];
      if (!this.$v.book.price.$dirty) return errors;
      if (!this.$v.book.price.required) errors.push('Price is required.');
      if (!this.$v.book.price.minValue) errors.push('Price must be positive number.');
      return errors;
    },
  },
  async mounted() {
    const { id } = this.$route.params;
    const response = await this.axios.get(`/api/books/${id}`);
    this.book = response.data.data;
    this.mainLoading = false;
  },
  methods: {
    async submitHandler() {
      if (this.$v.$invalid) {
        this.$v.$touch();
        return null;
      }

      await this.$store.dispatch('updateBook', {
        id: this.book.id,
        title: this.book.title,
        isbn: this.book.isbn,
        description: this.book.description,
        price: this.book.price,
      });
      this.$toasted.show('Book was updated');
      return null;
    },
  },
};
</script>
