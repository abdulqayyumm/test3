<template>
  <div>
    <div class="text-right">
      <button class="btn btn-success my-3" v-on:click="exportUsers">Export</button>
    </div>
    
    <UserOverviewTable :items="items" @on-list-end="loadMore"/>
  </div>
</template>

<script>
import UserOverviewTable from "../../components/Users/UserOverviewTable.vue";
import { getUsersList, exportUsers, fetchAndSaveUsers } from "../../services/users/usersService";
import { loadMore } from "../../services/common";
import toastMixin from "../../mixins/toastMixin";


export default {
  name: "UserOverview",
  components: {
    UserOverviewTable
  },
  mixins: [toastMixin],

  data () {
    return {
      page: 1,
      items: [],
      nextPageUrl: null
    };
  },

  mounted () {
    this.init();
  },

  methods: {
    async init () {
      
      await fetchAndSaveUsers();
      const response = await getUsersList(this.page);

      if (response.error) return this.$displayServerResponse(response);

      this.items = response.data;
      this.nextPageUrl = response.next_page_url;
    },

    async loadMore () {
      if (!this.nextPageUrl) return;
      const response = await loadMore(this.nextPageUrl);

      if (response.error) return this.$displayServerResponse(response);

      this.items = [...this.items, ...response.data];
      this.nextPageUrl = response.next_page_url;
    },

    async exportUsers () {
      const response = await exportUsers();

      if (response.error) return this.$displayServerResponse(response);

      return this.$displaySuccessToast(response.message);
    }
  }
};
</script>

<style scoped></style>
