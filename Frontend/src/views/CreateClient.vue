<template>
<v-card>
  <v-container fluid>
    <h2>Добавить клиента</h2>
    <v-form ref="form" v-model="valid">
      <v-text-field
        v-model="name"
        :counter="100"
        :rules="nameRules"
        label="Name"
        required
      ></v-text-field>
      <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail"
        required
      ></v-text-field>
      <v-text-field
        v-model="phone"
        :rules="phoneRules"
        label="Phone"
        placeholder="+7(XXX)XXX-XX-XX"
        v-mask="'+7(###)###-##-##'"
        required
      ></v-text-field>
      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="submit"
      >
        Создать
      </v-btn>
    </v-form>
  </v-container>
</v-card>

</template>

<script>
import axios from 'axios';

export default {
  name: "CreateTicketForm",

	data: () => ({
    valid: true,
    name: '',
    nameRules: [
    v => !!v || 'Name is required',
    v => (v && v.length <= 100) || 'Name must be less than 100 characters',
    ],
    email: '',
    emailRules: [
    v => !!v || 'E-mail is required',
    v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    phone: "",
    phoneRules: [
    v => !!v || 'Phone is required',
   // v => /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/.test(v) || 'E-mail must be valid'
    ],
  }),
  
	methods:{
		submit () {
			if (this.valid){
        let bodyFormData = new FormData();

        bodyFormData.append('name', this.name); 
        bodyFormData.append('phone', this.phone); 
        bodyFormData.append('email', this.email); 

				axios.post("/api/client",bodyFormData).then(()=>{
          this.title = "";
          this.content = "";
          this.phone = "";
          this.$router.push({name:"clients"})
				}).catch(()=>{

        });
			}
		},
	}
}
</script>

<style scoped>

</style>