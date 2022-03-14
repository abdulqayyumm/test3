<template>
    <div>
      <table class="table border bg-white table-responsive">
        <thead class="thead-light">
          <tr>
            <th scope="col">
                Title
            </th>
            <th scope="col">
                First Name
            </th>
            <th scope="col">
                Last Name
            </th>
            <th scope="col">
                Email
            </th>
            <th scope="col">
                Phone Number
            </th>
            <th scope="col">
                Gender
            </th>
            <th scope="col">
                Street
            </th>
            <th scope="col">
                City
            </th>
            <th scope="col">
                State
            </th>
            <th scope="col">
                Country
            </th>
            <th scope="col">
                Postcode
            </th>
            <th scope="col">
                Action
            </th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
              <td>{{ item.title }}</td>
              <td>{{ item.first_name }}</td>
              <td>{{ item.last_name }}</td>
              <td>{{ item.email }}</td>
              <td>{{ item.phone_number }}</td>
              <td>{{ item.gender }}</td>
              <td>{{ item.street }}</td>
              <td>{{ item.city }}</td>
              <td>{{ item.state }}</td>
              <td>{{ item.country }}</td>
              <td>{{ item.postcode }}</td>
              <td>
                  <router-link
                  :to="{ name: 'UserEdit', params: {id: item.id} }"
                  class="mr-2 text-dark"
                  >
                      <bttun class="btn btn-primary btn-sm">Edit</bttun>
                  </router-link>
              </td>
            </tr>
          </tbody>
      </table>
      <Observer
          :on-observed="onListEnd"
          :custom-css="observerCustomCss"
      />
    </div>
</template>

<script>
import Observer from '../../misc/Observer';

export default {
  name: "UserOverviewTable",
  components: {
    Observer
  },

  data () {
    return {
      observerCustomCss:
      "height: 0px; width: 50px; position: relative; bottom: 20px"
    }
  },
  props: {
    items: { type: Array }
  },

  methods: {
    onListEnd () {
      this.$emit('on-list-end')
    }
  }
};
</script>

<style scoped></style>
