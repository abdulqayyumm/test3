<template>
  <div class="row">
    <div class="offset-md-2 col-md-8 col-sm-12">
      <h3 class="text-center m-3">User - Edit</h3>
      <UserEditForm v-if="hasInit" :user="user" @on-save="updateUser" />
    </div>
  </div>
</template>

<script>
import UserEditForm from "../../components/Users/UserEditForm.vue";
import { getUser, updateUser } from "../../services/users/usersService";
import toastMixin from "../../mixins/toastMixin";


export default {
  name: "UserEdit",
  components: {
    UserEditForm
  },
  mixins: [toastMixin],

  data () {
    return {
      user: {},
      hasInit: false
    };
  },

  async mounted () {
    await this.init();
    this.hasInit = true;
  },

  methods: {
    async init () {
      let response = await getUser(this.$route.params.id);

      if (response.error) return this.$displayServerResponse(response);

      this.user = response;
    },
    async updateUser (formData) {
      const userId = this.$route.params.id;
      const response = await updateUser(userId, formData);

      if (response.error) return this.$displayError(response);

      return this.$displaySuccessToast(response.message);
    }
  }
};
</script>

<style scoped></style>