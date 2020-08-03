<template>
  <v-data-table
    :headers="headers"
    :items="items"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="white">
        <h2>Список клиентов</h2>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon small @click="$emit('delete-client', item)">
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
     <div>Клиенты не найдены</div>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: 'ClientsTable',

  props: ['items'],

  data: () => ({
    headers: [
      {
        text: 'Имя',
        align: 'start',
        value: 'name',
      },
      { text: 'Телефон', value: 'phone' },
      { text: 'E-mail', value: 'email' },
      { text: 'Действия', value: 'actions', sortable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: '',
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
  }),
   methods: {
      /**
       * Filter for dessert names column.
       * @param value Value to be tested.
       * @returns {boolean}
       */
      nameFilter(value) {
        // Check if the current loop value (The dessert name)
        // partially contains the searched word.
        return value.toLowerCase().includes(this.dessertFilterValue.toLowerCase());
      },
      /**
       * Filter for calories column.
       * @param value Value to be tested.
       * @returns {boolean}
       */
      emailFilter(value) {
        // Check if the current loop value (The calories value)
        // equals to the selected value at the <v-select>.
        return value === this.caloriesFilterValue;
      }
    }
}
</script>

<style scoped>

</style>