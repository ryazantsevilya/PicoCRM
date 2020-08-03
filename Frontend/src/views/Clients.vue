<template>
<div>
  <v-card>
    <v-container fluid>
      <h2>Фильтры</h2>
      <v-form ref="form">
        <v-text-field
          v-model="name"
          label="Имя"
          required
        ></v-text-field>
        <v-text-field
          v-model="email"
          label="E-mail"
        ></v-text-field>
        <v-text-field
          v-model="phone"
          label="Телефон"
          placeholder="+7(XXX)XXX-XX-XX"
          v-mask="'+7(###)###-##-##'"
        ></v-text-field>
        <v-btn
          color="success"
          class="mr-4"
          @click="getClients"
        >
          Применить
        </v-btn>
        <v-btn
          color="primary"
          class="mr-4"
          @click="clearFilters"
        >
          Сбросить фильтры
        </v-btn>
      </v-form>
    </v-container>
  </v-card>
  <clients-table class="mt-5" :items="clients" @delete-client="deleteClient($event)"></clients-table>
</div>

</template>

<script>
import ClientsTable from '../components/ClientsTable';
import axios from 'axios';

export default {
  created: function() {
    const { getClients } = this;
    getClients();
  },
  components: {
    ClientsTable
  },

  data: () => ({
    clients: [],
    name: null,
    email: null,
    phone: null
  }),

  methods: {
    clearFilters(){
      this.name = null;
      this.phone= null;
      this.email = null;
      this.getClients();
    },

    getClients() {
      const {name, email, phone} = this;

      let params = {}
      if (name)
        params['name'] = name;
      if (email)
        params['email'] = email;
      if (phone)
        params['phone'] = phone;

      console.log(params);

      axios.get('/api/client',{params}).then((response)=>{
        this.clients = response.data.data;
      })
    },
    
    deleteClient(client){
      let isDelete = confirm(`Удалить клиента ${client.name}?`);
      if (isDelete){
        const { getClients } = this;
      
        axios.delete(`/api/client/${client.id}`).then(()=>{
          getClients();
        })
      }

    }
  }
}
</script>