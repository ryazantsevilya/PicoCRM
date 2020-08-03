<template>
  <div>
    <v-navigation-drawer app permanent>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title">
            <div><img alt="SD logo" src="../assets/logo.png" width="70" height="70"></div>
            <div>PicoCRM</div>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense nav>
        <v-list-item v-for="item in navItems" :key="item.id" link @click="goRoute(item.route_name)">
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-main>
      <v-container fluid>
        
        <router-view :key="$route.fullPath"></router-view>
      </v-container>
    </v-main>

    <v-footer app>
      <!-- -->
    </v-footer>
  </div>
</template>

<script>


export default {
  name: 'Home',

  data: () => ({
    dialog: false,
    navItems: [
      {
        id: 1,
        title: 'Добавить клиента',
        icon: 'mdi-view-dashboard',
        route_name: "create-client"
      },
      {
        id: 2,
        title: 'Список клиентов',
        icon: 'mdi-image',
        route_name: "clients"
      }
    ],
  }),

  methods:{
    goRoute (routeName) {
      this.$router.push({name: routeName}).catch((err) => {
        if (err.name === 'NavigationDuplicated'){
          this.$router.go(0);
        }
      })
    }
  }
}
</script>
